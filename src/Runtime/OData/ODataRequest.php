<?php


namespace Office365\PHP\Client\Runtime\OData;


use Exception;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\IEntityType;
use Office365\PHP\Client\Runtime\InvokeMethodQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientRequest;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\CamlQuery;
use Office365\PHP\Client\SharePoint\ChangeLogItemQuery;
use Office365\PHP\Client\SharePoint\ChangeQuery;
use Office365\PHP\Client\SharePoint\WebCreationInformation;


/**
 * Client Request for OData provider.
 */
class ODataRequest extends ClientRequest
{


    public function __construct(ClientRuntimeContext $context)
    {
        parent::__construct($context);
    }

    /**
     * Submit query to OData service
     * @throws Exception
     */
    public function executeQuery()
    {
        $request = $this->buildRequest();
        if (is_callable($this->eventsList["BeforeExecuteQuery"])) {
            call_user_func_array($this->eventsList["BeforeExecuteQuery"], array(
                $request,
                $this->getCurrentAction()
            ));
        }
        $responseInfo = array();
        $response = $this->executeQueryDirect($request, $responseInfo);
        if (!empty($response)) {
            $this->processResponse($response);
        }
        array_shift($this->queries);
    }


    /**
     * @param string $response
     * @throws Exception
     */
    public function processResponse($response)
    {
        if (!array_key_exists($this->getCurrentAction()->getId(), $this->resultObjects)) {
            return;
        }

        $resultObject = $this->resultObjects[$this->getCurrentAction()->getId()];
        if ($this->getCurrentAction() instanceof InvokePostMethodQuery && $this->getCurrentAction()->MethodPayload instanceof ChangeLogItemQuery) {
            $payload = $this->parseXmlResponse($response);
        } else {
            $payload = $this->parseJsonResponse($response);
        }

        if ($resultObject instanceof ClientResult) {
            if ($this->getCurrentAction() instanceof InvokeMethodQuery){
                $this->getSerializationContext()->RootElement = $this->getCurrentAction()->MethodName;
            }
            $resultObject->fromJson($payload,$this->getSerializationContext());
        } else if($resultObject instanceof IEntityType) {
            $this->getSerializationContext()->map($payload,$resultObject);
        }
        unset($this->resultObjects[$this->getCurrentAction()->getId()]);
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
     * @return array
     */
    private function parseXmlResponse($response)
    {
        $payload = array();
        $xml = simplexml_load_string($response);
        $xml->registerXPathNamespace('z', '#RowsetSchema');
        $rows = $xml->xpath("//z:row");
        foreach ($rows as $row) {
            $item = null;
            foreach ($row->attributes() as $k => $v) {
                $normalizedFieldName = str_replace('ows_', '', $k);
                $item[$normalizedFieldName] = (string)$v;
            }
            $payload[] = $item;
        }
        return $payload;
    }


    /**
     * Validate payload response for errors
     * @param mixed $payload
     * @param array $error
     * @return bool
     * @throws Exception
     */
    private function validateResponse($payload, &$error = array())
    {
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
        $request->addCustomHeader("Accept", $this->getSerializationContext()->getMediaType());
        $request->addCustomHeader("content-type", $this->getSerializationContext()->getMediaType());
    }


    /**
     * @return RequestOptions
     */
    public function buildRequest()
    {
        $resourceUrl = $this->context->getServiceRootUrl() . $this->getCurrentAction()->ResourcePath->toUrl();
        if (!is_null($this->getCurrentAction()->QueryOptions)) {
            $resourceUrl .= '?' . $this->getCurrentAction()->QueryOptions->toUrl();
        }
        $request = new RequestOptions($resourceUrl);
        if ($this->getCurrentAction() instanceof InvokePostMethodQuery) {
            $request->Method = HttpMethod::Post;
            if (is_string($this->getCurrentAction()->MethodPayload))
                $request->Data = $this->getCurrentAction()->MethodPayload;
            if (is_array($this->getCurrentAction()->MethodPayload))
                $request->Data = json_encode($this->getCurrentAction()->MethodPayload);
            else if ($this->getCurrentAction()->MethodPayload instanceof IEntityType) {
                //build request payload
                $payload = $this->normalizePayload($this->getCurrentAction()->MethodPayload);
                $request->Data = json_encode($payload);
            }
        }
        return $request;
    }


    /**
     * Normalize request payload
     * @param IEntityType|array $value
     * @return array
     */
    protected function normalizePayload($value)
    {
        if ($value instanceof IEntityType) {
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
     * @param IEntityType $value
     * @param $payload
     */
    private function ensureContainer(IEntityType $value, &$payload)
    {
        if ($value instanceof CamlQuery || $value instanceof ChangeQuery || $value instanceof ChangeLogItemQuery)
            $payload = array("query" => $payload);
        else if ($value instanceof WebCreationInformation)
            $payload = array("parameters" => $payload);
    }

    /**
     * @param IEntityType $value
     * @param $payload
     */
    private function ensureMetadata(IEntityType $value, &$payload)
    {
        if ($this->getSerializationContext() instanceof JsonLightSerializerContext && $this->getSerializationContext()->MetadataLevel == ODataMetadataLevel::Verbose) {
            $metadataTypeName = $value->getTypeName();
            if (substr($metadataTypeName, 0, 3) !== "SP.")
                $metadataTypeName = "SP." . $metadataTypeName;
            $payload["__metadata"] = array("type" => $metadataTypeName);
        }
    }


    /**
     * @return ODataSerializerContext
     */
    protected function getSerializationContext()
    {
        return $this->context->getSerializerContext();
    }

    protected function getCurrentAction(){
        return current($this->getActions());
    }



    /**
     * @param string $key
     * @return bool
     */
    protected function isMetadataProperty($key)
    {
        return ($key === JsonLightSerializerContext::MetadataTag);
    }

    protected function isDeferredProperty($value)
    {
        if (isset($value->__deferred))
            return true;
        return false;
    }

}