<?php


namespace Office365\Runtime\OData;

use Exception;
use Generator;
use Office365\Runtime\ClientAction;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ClientRequest;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ClientValueObject;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Response;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\InvokeMethodQuery;
use Office365\Runtime\InvokePostMethodQuery;


/**
 * OData request (for V3/v4)
 */
class ODataRequest extends ClientRequest
{

    /**
     * @param ClientRuntimeContext $context
     * @param ODataFormat $format
     */
    public function __construct(ClientRuntimeContext $context, ODataFormat $format)
    {
        parent::__construct($context);
        $this->format = $format;
    }


    /**
     * @return RequestOptions
     */
    protected function buildRequest(){
        $this->currentQuery = array_shift($this->queries);
        return $this->buildSingleRequest($this->currentQuery);
    }

    /**
     * @param ClientAction $qry
     * @return RequestOptions
     */
    protected function buildSingleRequest($qry)
    {
        $resourceUrl = $qry->BindingType->getResourceUrl();
        $request = new RequestOptions($resourceUrl);
        if($qry instanceof InvokeMethodQuery){

            if(!is_null($qry->getMethodPath())) {
                $request->Url = $this->context->getServiceRootUrl() . $qry->getMethodPath()->toUrl();
            }

            if($this->format instanceof JsonLightFormat){
                $this->format->FunctionTag = $qry->ReturnType instanceof ClientResult ? $qry->MethodName : null;
            }

            if ($qry instanceof InvokePostMethodQuery) {
                if($this->format instanceof JsonLightFormat && !is_null($qry->ParameterName)) {
                    $this->format->FunctionTag = $qry->ParameterName;
                }

                $request->Method = HttpMethod::Post;
                $payload = $qry->ParameterType;
                if ($payload) {
                    if (is_string($payload))
                        $request->Data = $payload;
                    else {
                        $payload = $this->normalizePayload($payload,$this->getFormat());
                        $request->Data = json_encode($payload);
                    }
                }
            }
        }

        return $request;
    }


    /**
     * @param ClientObject|ClientValueObject|array $value
     * @param ODataFormat $format
     * @return array
     */
    protected function normalizePayload($value,ODataFormat $format)
    {
        if ($value instanceof ClientObject || $value instanceof ClientValueObject) {
            $json = array_map(function ($property) use($format){
                return $this->normalizePayload($property,$format);
            }, $value->toJson($format));

            $this->ensureAnnotation($value,$json,$format);
            return $json;
        } else if (is_array($value)) {
            return array_map(function ($item) use($format){
                return $this->normalizePayload($item,$format);
            }, $value);
        }
        return $value;
    }

    /**
     * @param ClientObject|ClientValueObject $type
     * @param array $json
     * @param ODataFormat $format
     */
    protected function ensureAnnotation($type, &$json,$format)
    {
        $typeName = $type->getTypeName();
        if ($format instanceof JsonLightFormat && $format->MetadataLevel == ODataMetadataLevel::Verbose) {

            if (substr($typeName, 0, 3) !== "SP.")
                $typeName = "SP." . $typeName;
            $json[$format->MetadataTag] = array("type" => $typeName);

            if($format->FunctionTag){
                $json = array($format->FunctionTag => $json);
            }
        }
        elseif ($format instanceof JsonFormat){
            $json[$format->TypeTag] = "$format->NamespaceTag.$typeName";
        }
    }



    function executeQueryDirect(RequestOptions $request)
    {
        $request->addCustomHeader("Accept", $this->getFormat()->getMediaType());
        $request->addCustomHeader("Content-Type", $this->getFormat()->getMediaType());
        return parent::executeQueryDirect($request);
    }

    /**
     * @param Response $response
     * @throws Exception
     */
    public function processResponse($response)
    {
        $payload = $response->getContent();
        if (empty($payload)) {
            return;
        }

        $resultObject = $this->currentQuery->ReturnType;
        if (is_null($resultObject)) {
            return;
        }

        $payload = json_decode($response->getContent(), true);
        $this->mapJson($payload, $resultObject, $this->getFormat());
    }


    /**
     * Maps response payload to client object
     * @param array $payload
     * @param $resultType ClientObject|ClientValueObject|ClientResult
     * @param $format ODataFormat
     */
    public function mapJson($payload, $resultType, $format)
    {
        if($resultType instanceof ClientObjectCollection){
            $resultType->clearData();
        }
        foreach ($this->extractProperty($payload, $format) as $key => $value) {
            $resultType->setProperty($key, $value, false);
        }
    }



    /**
     * Process Xml response from SharePoint REST service
     * @param $payload string
     * @return array
     */
    protected function transformXml($payload)
    {
        $json = array();
        $xml = simplexml_load_string($payload);
        $xml->registerXPathNamespace('z', '#RowsetSchema');
        $rows = $xml->xpath("//z:row");
        foreach ($rows as $row) {
            $item = null;
            foreach ($row->attributes() as $k => $v) {
                $normalizedFieldName = str_replace('ows_', '', $k);
                $item[$normalizedFieldName] = (string)$v;
            }
            $json[] = $item;
        }
        return $json;
    }


    /**
     * @param array $json
     * @param ODataFormat $format
     * @return Generator
     */
    private function extractProperty($json, $format)
    {
        if ($format instanceof JsonLightFormat) {
            if (isset($json[$format->SecurityTag]))
                $json = $json[$format->SecurityTag];
            if (isset($json[$format->FunctionTag]))
                $json = $json[$format->FunctionTag];
        }
        if(!is_array($json))
            yield $json;

        if (isset($json[$format->CollectionTag])) {
            $json = $json[$format->CollectionTag];
            foreach ($json as $index => $item) {
                if(is_array($item)){
                    $item = array_map(function ($v){ return $v;},
                        iterator_to_array($this->extractProperty($item,$format)));
                }
                yield $index => $item;
            }
        }
        else if (is_array($json)){
            foreach ($json as $key => $value) {
                if($this->isValidProperty($key, $value, $format)){
                    if(is_array($value)){
                        $value = array_map(function ($v){ return $v;},
                            iterator_to_array($this->extractProperty($value,$format)));
                    }
                    yield $key => $value;
                }
            }
        }
    }


    /**
     * @param string $key
     * @param array $value
     * @param ODataFormat $format
     * @return bool
     */
    private function isValidProperty($key,$value,$format)
    {
        if ($format instanceof JsonLightFormat) {
            if (is_array($value) && array_key_exists($format->DeferredTag, $value))
                return false;
            $propsToExclude = array(
                $format->MetadataTag
            );
            return !in_array($key, $propsToExclude);
        } else if ($format instanceof JsonFormat) {
            return fnmatch("$format->ControlFamilyTag.*", $key) !== true
                && fnmatch("*$format->ControlFamilyTag.*", $key) !== true
                && fnmatch("$format->TypeTag.*", $key) !== true;

        }
        return true;
    }


    /**
     * Extract error from JSON payload response
     * @param $payload array
     * @return string|null
     */
    private function parseError($payload)
    {
        foreach ($payload as $key=> $value){
            if(is_array($value)){
                return $this->parseError($value);
            }
            if($key === "message" || $key === "value")
                return $value;
        }
        return null;
    }


    /**
     * @return ClientAction
     */
    public function getCurrentQuery()
    {
        return $this->currentQuery;
    }


    /**
     * @return ODataFormat
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @var ODataFormat
     */
    private $format;


    /**
     * @var ClientAction
     */
    protected $currentQuery = array();

}
