<?php

namespace Office365\PHP\Client\Runtime;

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
     * @var string
     */
	private $serviceRootUrl;

    /**
     * Authentication context
     * @var IAuthenticationContext
     */
    private $authContext;

    /**
     * @var ClientRequest
     */
    private $pendingRequest;


    /**
     * Client application name
     * @var string
     */
    private static $ApplicationName;


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
    public function __construct($serviceUrl, IAuthenticationContext $authContext,ODataFormat $format)
    {
		$this->serviceRootUrl = $serviceUrl;
		$this->authContext = $authContext;
        self::$ApplicationName = "Office 365 PHP Client";
        $this->format = $format;
    }


    /**
     * @param RequestOptions $options
     */
    public function authenticateRequest(RequestOptions $options){
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
     */
    public function load(ClientObject $clientObject,array $selectProperties=null)
    {
        $this->getPendingRequest()->addQueryAndResultObject($clientObject,$selectProperties);
    }

    /**
     * Submit client request to SharePoint OData/SOAP service
     */
    public function executeQuery()
    {
        $this->getPendingRequest()->executeQuery();
    }


    /**
     * @param RequestOptions $options
     * @return ODataPayload
     */
    public function executeQueryDirect(RequestOptions $options)
    {
        return $this->getPendingRequest()->executeQueryDirect($options);
    }

    public function populateObject($response,$resultObject)
    {
        $this->getPendingRequest()->populateObject($response,$resultObject);
    }

    /**
     * @param ClientAction $query
     * @param ClientObject $resultObject
     */
    public function addQuery(ClientAction $query, $resultObject=null)
    {
        $this->getPendingRequest()->addQuery($query,$resultObject);
    }

    /**
     * @return ClientRequest
     */
    public function getPendingRequest()
    {
        if(!isset($this->pendingRequest)){
            $this->pendingRequest = new ClientRequest($this,$this->format);
        }
        return $this->pendingRequest;
    }

}
