<?php


namespace Office365\Runtime\OData;

use Exception;
use Generator;
use Office365\GraphServiceClient;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ClientRequest;
use Office365\Runtime\ClientResult;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ClientValue;
use Office365\Runtime\ClientValueCollection;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\Http\Response;
use Office365\Runtime\Http\HttpMethod;
use Office365\Runtime\Actions\InvokeMethodQuery;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\SharePoint\ClientContext;


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
    public function buildRequest(){
        $qry = $this->currentQuery;
        $url = $qry->getActionUrl();
        $request = new RequestOptions($url);
        if($qry instanceof InvokeMethodQuery){
            if($this->format instanceof JsonLightFormat){
                $this->format->FunctionTag = $qry->MethodName;
            }

            if ($qry instanceof InvokePostMethodQuery) {
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
     * @param ClientObject|ClientValue $type
     * @return string
     */
    public function normalizeTypeName($type)
    {
        $collection = false;
        $typeName = $type->getServerTypeName();
        if (is_null($typeName)) {

            if ($type instanceof ClientValueCollection) {
                $collection = true;
                $typeInfo = explode("\\", $type->getItemTypeName());
            }
            else{
                $typeInfo = explode("\\", get_class($type));
            }
            $typeName = end($typeInfo);

            //if ($this->context instanceof OutlookClient)
            //    $typeName = "#Microsoft.OutlookServices.$typeName";
            if ($this->context instanceof ClientContext)
                $typeName = "SP.$typeName";
            else if ($this->context instanceof GraphServiceClient) {
                $typeName = lcfirst($typeName);
                $typeName = "microsoft.graph.$typeName";
            }
            return $collection ? "Collection($typeName)" : $typeName;
        }
        return $typeName;
    }


    /**
     * @param ClientObject|ClientValue|array $value
     * @param ODataFormat $format
     * @return array
     */
    protected function normalizePayload($value,ODataFormat $format)
    {
        if($value instanceof ClientObjectCollection){
            return array_map(function ($item) use($format){
                return $this->normalizePayload($item,$format);
            }, $value->getData());
        }
        else if ($value instanceof ClientObject || $value instanceof ClientValue) {
            $json = array_map(function ($property) use($format){
                return $this->normalizePayload($property,$format);
            }, $value->toJson(true));

            if(!($value instanceof ClientValueCollection || $value instanceof ClientObjectCollection))
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
     * @param ClientObject|ClientValue $type
     * @param array $json
     * @param ODataFormat $format
     */
    protected function ensureAnnotation($type, &$json,$format)
    {
        $qry = $this->context->getCurrentQuery();
        $typeName = $this->normalizeTypeName($type);
        if ($format instanceof JsonLightFormat && $format->MetadataLevel == ODataMetadataLevel::Verbose) {

            $json[$format->MetadataTag] = array("type" => $typeName);
            if($qry instanceof InvokePostMethodQuery && !is_null($qry->ParameterName)) {
                 $json = array($qry->ParameterName => $json);
            }
        }
        elseif ($format instanceof JsonFormat){
            $json[$format->TypeTag] = "$typeName";
        }
    }


    /**
     * @param RequestOptions $request
     * @return Response
     * @throws Exception
     */
    function executeQueryDirect(RequestOptions $request)
    {
        $this->ensureMediaType($request);
        return parent::executeQueryDirect($request);
    }


    /**
     * @param RequestOptions $request
     */
    protected function ensureMediaType(RequestOptions $request){
        $request->ensureHeader("Accept", strtolower($this->getFormat()->getMediaType()));
        $request->ensureHeader("Content-Type", $this->getFormat()->getMediaType());
    }

    /**
     * @param Response $response
     * @throws Exception
     */
    public function processResponse($response)
    {
        $currentQry = $this->context->getCurrentQuery();

        $content = $response->getContent();
        if (empty($content)) {
            return;
        }

        $resultObject = $currentQry->ReturnType;
        if (is_null($resultObject)) {
            return;
        }

        $payloadJson = json_decode($content, true);
        if(!is_null($payloadJson)) {
            $this->mapJson($payloadJson, $resultObject, $this->getFormat());
        }
        elseif ($resultObject instanceof ClientResult){
            $resultObject->setProperty(null,$content);
        }
    }


    /**
     * Maps response payload to client object
     * @param array $json
     * @param $resultType ClientObject|ClientValue|ClientResult
     * @param $format ODataFormat
     */
    public function mapJson($json, $resultType, $format)
    {
        if($resultType instanceof ClientObjectCollection){
            $resultType->clearData();
        }
        foreach ($this->nextProperty($json, $format) as $key => $value) {
            if($resultType instanceof ClientObjectCollection
                && $format instanceof JsonLightFormat && $key === $format->NextCollectionTag){
                $resultType->NextRequestUrl = $value;
            }
            else{
                $resultType->setProperty($key, $value, false);
            }
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
    private function nextProperty($json, $format)
    {
        if ($format instanceof JsonLightFormat) {
            if (isset($json[$format->SecurityTag]))
                $json = $json[$format->SecurityTag];
            if (isset($json[$format->FunctionTag]))
                $json = $json[$format->FunctionTag];
        }
        if (!is_array($json))
            yield "value" => $json;


        if (isset($json[$format->CollectionTag])) {
            if (isset($json[$format->NextCollectionTag])) {
                yield $format->NextCollectionTag => $json[$format->NextCollectionTag];
            }

            $json = $json[$format->CollectionTag];
            foreach ($json as $index => $item) {
                if (is_array($item)) {
                    $item = array_map(function ($v) {
                        return $v;
                    },
                        iterator_to_array($this->nextProperty($item, $format)));
                }
                yield $index => $item;
            }
        } else if (is_array($json)) {
            foreach ($json as $key => $value) {
                if ($this->isValidProperty($key, $value, $format)) {
                    if (is_array($value)) {
                        $value = array_map(function ($v) {
                            return $v;
                        },
                            iterator_to_array($this->nextProperty($value, $format)));
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
}
