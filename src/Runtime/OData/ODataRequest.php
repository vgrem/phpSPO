<?php


namespace Office365\PHP\Client\Runtime\OData;


use Exception;
use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientResult;
use Office365\PHP\Client\Runtime\IEntityType;
use Office365\PHP\Client\Runtime\InvokeMethodQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ClientRequest;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;
use Office365\PHP\Client\SharePoint\ChangeLogItemQuery;


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
        if ($this->getCurrentAction() instanceof InvokePostMethodQuery && $this->getCurrentAction()->MethodBody instanceof ChangeLogItemQuery) {
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
            if (is_string($this->getCurrentAction()->MethodBody))
                $request->Data = $this->getCurrentAction()->MethodBody;
            else if ($this->getCurrentAction()->MethodBody instanceof IEntityType) {
                //build request payload
                $payload = $this->getSerializationContext()->normalize($this->getCurrentAction()->MethodBody);
                $request->Data = json_encode($payload);
            }
        }
        return $request;
    }


    /**
     * @return ODataSerializerContext
     */
    protected function getSerializationContext()
    {
        return $this->context->getSerializerContext();
    }


    /**
     * @return ClientAction|InvokePostMethodQuery
     */
    protected function getCurrentAction(){
        return current($this->getActions());
    }

}