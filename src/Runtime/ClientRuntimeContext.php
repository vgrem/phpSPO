<?php

namespace Office365\PHP\Client\Runtime;

use Sabre\Uri;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\OData\ODataFormat;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

/**
 * OData Runtime context for Office365 APIs
 */
class ClientRuntimeContext
{
    /**
     * Service Root url
     * @var Url
     */
    private $serviceRootUrl;

    /**
     * @var IAuthenticationContext
     */
    private $authContext;

    /**
     * @var ClientRequest
     */
    private $pendingRequest;

    /**
     * @var ODataFormat
     */
    protected $format;

    /**
     * REST client context ctor
     * @param string $serviceUrl
     * @param IAuthenticationContext $authContext
     * @param ODataFormat $format
     */
    public function __construct($serviceUrl, IAuthenticationContext $authContext, ODataFormat $format)
    {
        $this->serviceRootUrl = Uri\normalize($serviceUrl.'/_api/');
        $this->authContext = $authContext;
        $this->format = $format;
    }

    /**
     * @param RequestOptions $options
     */
    public function authenticateRequest(RequestOptions $options)
    {
        $this->authContext->authenticateRequest($options);
    }

    /**
     * Gets the service root URL that identifies the root of an OData service
     * @return string
     */
    public function getServiceRootUrl()
    {
        return $this->serviceRootUrl;
    }

    /**
     * Prepare to load resource
     * @param ClientObject $clientObject
     * @param array $selectProperties
     *
     * @return self
     */
    public function load(ClientObject $clientObject, array $selectProperties = null)
    {
        $this->getPendingRequest()->addQueryAndResultObject($clientObject, $selectProperties);
        return $this;
    }

    /**
     * Submit client request to SharePoint OData/SOAP service
     *
     * @return self
     */
    public function executeQuery()
    {
        $this->getPendingRequest()->executeQuery();
        return $this;
    }

    /**
     * @param RequestOptions $options
     * @return ODataPayload
     */
    public function executeQueryDirect(RequestOptions $options)
    {
        return $this->getPendingRequest()->executeQueryDirect($options);
    }

    /**
     * @param $response
     * @param $resultObject
     * @return self
     */
    public function populateObject($response, $resultObject)
    {
        $this->getPendingRequest()->populateObject($response, $resultObject);
        return $this;
    }

    /**
     * @param ClientAction $query
     * @param ClientObject $resultObject
     * @return self
     */
    public function addQuery(ClientAction $query, $resultObject = null)
    {
        $this->getPendingRequest()->addQuery($query, $resultObject);
        return $this;
    }

    /**
     * @return ClientRequest
     */
    public function getPendingRequest()
    {
        if (!isset($this->pendingRequest)) {
            $this->pendingRequest = new ClientRequest($this, $this->format);
        }
        return $this->pendingRequest;
    }

}
