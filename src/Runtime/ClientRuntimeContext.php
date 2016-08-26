<?php

namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\OData\ODataFormat;
use Office365\PHP\Client\Runtime\OData\ODataPayload;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

require_once('Utilities/EnumType.php');
require_once('Utilities/Guid.php');
require_once('OData/ODataPayloadKind.php');
require_once('OData/ODataPayload.php');
require_once('ClientActionType.php');
require_once('ClientRequest.php');
require_once('OData/ODataQueryOptions.php');
require_once('OData/ODataPathParser.php');
require_once('OData/ODataPrimitiveTypeKind.php');
require_once('OData/JsonPayloadSerializer.php');
require_once('ResourcePath.php');
require_once('ResourcePathEntity.php');
require_once('ResourcePathServiceOperation.php');
require_once('ClientAction.php');
require_once('ClientActionInvokeMethod.php');
require_once('ClientActionReadEntity.php');
require_once('ClientActionInvokePostMethod.php');
require_once('ClientActionInvokeGetMethod.php');
require_once('ClientActionDeleteEntity.php');
require_once('ClientActionUpdateEntity.php');
require_once('ClientActionCreateEntity.php');
require_once('ClientResult.php');
require_once('ClientObject.php');
require_once('ClientValueObject.php');
require_once('ClientValueObjectCollection.php');
require_once('ClientObjectCollection.php');
require_once('Auth/IAuthenticationContext.php');
require_once('OData/ODataMetadataLevel.php');
require_once('OData/ODataFormat.php');
require_once('OData/JsonFormat.php');
require_once('OData/JsonLightFormat.php');
require_once('OData/AtomFormat.php');
require_once('Utilities/JsonConvert.php');

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
     */
    public function load(ClientObject $clientObject)
    {
        $this->getPendingRequest()->addQueryAndResultObject($clientObject);
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