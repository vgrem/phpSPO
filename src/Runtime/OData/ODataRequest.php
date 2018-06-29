<?php


namespace Office365\PHP\Client\Runtime\OData;


use Exception;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\FormatType;
use Office365\PHP\Client\Runtime\ISchemaType;
use Office365\PHP\Client\Runtime\ISchemaTypeCollection;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientRequest;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\CamlQuery;
use Office365\PHP\Client\SharePoint\ChangeLogItemQuery;
use Office365\PHP\Client\SharePoint\ChangeQuery;
use Office365\PHP\Client\SharePoint\WebCreationInformation;
use stdClass;

/**
 * Client Request for OData provider.
 */
class ODataRequest extends ClientRequest
{

    /**
     * @var ODataFormat
     */
    private $format;

    /**
     * @var int $responsePayloadFormat
     */
    private $responsePayloadFormat;

    public function __construct(ClientRuntimeContext $context, ODataFormat $format)
    {
        $this->format = $format;
        parent::__construct($context);
    }


    /**
     * Submit query to OData service
     * @throws Exception
     */
    public function executeQuery()
    {
        while (($qry = array_shift($this->queries)) !== null) {
            $request = $this->buildRequest($qry);
            if (is_callable($this->eventsList["BeforeExecuteQuery"])) {
                call_user_func_array($this->eventsList["BeforeExecuteQuery"], array(
                    $request,
                    $qry
                ));
            }
            $responseInfo = array();
            $response = $this->executeQueryDirect($request, $responseInfo);
            if (empty($response)) {
                continue;
            }

            $this->responsePayloadFormat = FormatType::Json;
            if ($qry instanceof InvokePostMethodQuery && $qry->MethodPayload instanceof ChangeLogItemQuery)
                $this->responsePayloadFormat = FormatType::Xml;

            if (array_key_exists($qry->getId(), $this->resultObjects)) { //initialize result object from a queue?
                $resultObject = $this->resultObjects[$qry->getId()];
                $this->processResponse($response, $resultObject);
                unset($this->resultObjects[$qry->getId()]);
            }
        }
    }


    /**
     * @param string $response
     * @param ISchemaType|ClientResult $resultObject
     * @throws Exception
     */
    public function processResponse($response, $resultObject)
    {
        if ($this->responsePayloadFormat == FormatType::Xml) {
            $payload = $this->parseXmlResponse($response);
        } else {
            $payload = $this->parseJsonResponse($response);
        }

        if ($resultObject instanceof ClientResult) {
            $this->mapResult($payload, $resultObject);
        } else {
            $this->mapType($payload, $resultObject);
        }
    }


    /**
     * @param string $response
     * @return mixed
     * @throws Exception
     */
    private function parseJsonResponse($response)
    {
        $error = array();
        $payload = json_decode($response);
        if ($this->validateResponse($payload, $error) == false) {
            throw new Exception($error['Message']);
        }
        return $payload;
    }


    /**
     * Process Xml response from SharePoint REST service
     * @param string $response
     * @return stdClass
     */
    private function parseXmlResponse($response)
    {
        $items = array();
        $xml = simplexml_load_string($response);
        $xml->registerXPathNamespace('z', '#RowsetSchema');
        $rows = $xml->xpath("//z:row");
        foreach ($rows as $row) {
            $item = null;
            foreach ($row->attributes() as $k => $v) {
                $normalizedFieldName = str_replace('ows_', '', $k);
                $item[$normalizedFieldName] = (string)$v;
            }
            $items[] = $item;
        }
        $payload = new stdClass();
        $payload->{$this->format->getCollectionTagName()} = $items;
        return $payload;
    }


    /**
     * Maps response payload to client object
     * @param mixed $json
     * @param ISchemaType $resultObject
     */
    private function mapType($json, ISchemaType $resultObject)
    {
        if ($this->format instanceof JsonLightFormat) {
            if ($this->format->MetadataLevel == ODataMetadataLevel::Verbose) {
                if (property_exists($json, JsonLightFormat::SecurityTag)) {
                    $json = $json->{JsonLightFormat::SecurityTag};
                }
            }
        }

        if ($resultObject instanceof ISchemaTypeCollection) {
            $this->mapTypeCollection($json, $resultObject);
        } else {
            foreach ($json as $key => $value) {
                if ($this->isMetadataProperty($key)) { //skip metadata tag
                    continue;
                }

                if (is_object($value)) {
                    if ($this->isDeferredProperty($value)) {
                        $resultObject->setProperty($key, null, false);
                    } else {
                        $property = $resultObject->getProperty($key);
                        if ($property instanceof ISchemaType) {
                            $this->mapType($value, $property);
                        } else {
                            $tagName = $this->format->getCollectionTagName();
                            if (property_exists($value, $tagName)) {
                                $value = $value->{$tagName};
                            }
                            $resultObject->setProperty($key, $value, false);
                        }
                    }
                } else { //Primitive property?
                    $resultObject->setProperty($key, $value, false);
                }
            }
        }
    }


    function mapTypeCollection($json, ISchemaTypeCollection $resultObject)
    {
        $tagName = $this->format->getCollectionTagName();
        if (property_exists($json, $tagName)) {
            $json = $json->{$tagName};
        }
        $resultObject->clearData();
        foreach ($json as $item) {
            $type = $resultObject->createType();
            $this->mapType($item, $type);
            $resultObject->addChild($type);
        }
    }

    public function mapResult($json, ClientResult $resultObject)
    {
        if ($this->format->MetadataLevel == ODataMetadataLevel::Verbose) {
            $json = $json->{JsonLightFormat::SecurityTag};
            $json = $json->{$resultObject->FunctionName};
        }
        if ($resultObject->Value instanceof ISchemaType)
            $this->mapType($json, $resultObject->Value);
        else {
            $resultObject->Value = $json;
        }
    }

    /**
     * @param mixed $payload
     * @param array $error
     * @return bool
     * @throws Exception
     */
    private function validateResponse($payload, &$error = array())
    {
        //extract error
        if (property_exists($payload, 'error')) {
            if (is_string($payload->error->message)) {
                $message = $payload->error->message;
            } elseif (is_object($payload->error->message)) {
                $message = $payload->error->message->value;
            } else {
                $message = "Unknown error";
            }
            $error['Message'] = $message;
            return false;
        }
        return true;
    }

    /**
     * @param RequestOptions $request
     */
    protected function setRequestHeaders(RequestOptions $request)
    {
        $request->addCustomHeader("Accept", $this->format->getMediaType());
        $request->addCustomHeader("content-type", $this->format->getMediaType());
    }


    /**
     * @param ClientAction $query
     * @return RequestOptions
     */
    public function buildRequest(ClientAction $query)
    {
        $resourceUrl = $this->context->getServiceRootUrl() . $query->ResourcePath->toUrl();
        if (!is_null($query->QueryOptions)) {
            $resourceUrl .= '?' . $query->QueryOptions->toUrl();
        }
        $request = new RequestOptions($resourceUrl);
        if ($query instanceof InvokePostMethodQuery) {
            $request->Method = HttpMethod::Post;
            if (is_string($query->MethodPayload))
                $request->Data = $query->MethodPayload;
            if (is_array($query->MethodPayload))
                $request->Data = json_encode($query->MethodPayload);
            else if ($query->MethodPayload instanceof ISchemaType) {
                //build request payload
                $payload = $this->normalizePayload($query->MethodPayload);
                $request->Data = json_encode($payload);
            }
        }
        return $request;
    }


    /**
     * Normalize request payload
     * @param ISchemaType|array $value
     * @return array
     */
    protected function normalizePayload($value)
    {
        if ($value instanceof ISchemaType) {
            $payload = array_map(function ($property) {
                return $this->normalizePayload($property);
            }, $value->getProperties(SCHEMA_SERIALIZABLE_PROPERTIES));

            $this->ensureMetadata($value, $payload); //ensure metadata
            $this->ensureContainer($value, $payload); //ensure parent container
            return $payload;
        } else if (is_array($value)) {
            return array_map(function ($item) {
                return $this->normalizePayload($item);
            }, $value);
        }
        return $value;
    }


    /**
     * @param ISchemaType $value
     * @param $payload
     */
    private function ensureContainer(ISchemaType $value, &$payload)
    {
        if ($value instanceof CamlQuery || $value instanceof ChangeQuery || $value instanceof ChangeLogItemQuery)
            $payload = array("query" => $payload);
        else if ($value instanceof WebCreationInformation)
            $payload = array("parameters" => $payload);
    }

    /**
     * @param ISchemaType $value
     * @param $payload
     */
    private function ensureMetadata(ISchemaType $value, &$payload)
    {
        if ($this->format instanceof JsonLightFormat && $this->format->MetadataLevel == ODataMetadataLevel::Verbose) {
            $metadataTypeName = $value->getTypeName();
            if (substr($metadataTypeName, 0, 3) !== "SP.")
                $metadataTypeName = "SP." . $metadataTypeName;
            $payload["__metadata"] = array("type" => $metadataTypeName);
        }
    }


    /**
     * @param string $key
     * @return bool
     */
    protected function isMetadataProperty($key)
    {
        return ($key === JsonLightFormat::MetadataTag);
    }

    protected function isDeferredProperty($value)
    {
        if (isset($value->__deferred))
            return true;
        return false;
    }

}