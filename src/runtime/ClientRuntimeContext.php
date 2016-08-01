<?php

namespace SharePoint\PHP\Client;

use SharePoint\PHP\Client\Runtime\ODataJsonFormat;

require_once('utilities/EnumType.php');
require_once('utilities/Guid.php');
require_once('ClientActionType.php');
require_once('ClientRequest.php');
require_once('ContextWebInformation.php');
require_once('odata/ODataQueryOptions.php');
require_once('odata/ODataPathParser.php');
require_once('odata/ODataPrimitiveTypeKind.php');
require_once('ResourcePath.php');
require_once('ResourcePathEntry.php');
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
require_once('auth/IAuthenticationContext.php');
require_once('odata/ODataJsonFormat.php');

/**
 * Client runtime context for Office365 APIs
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
    private $ApplicationName;


    /**
     * @var ODataJsonFormat
     */
    public $JsonFormat;


    /**
     * REST client context ctor
     * @param string $url
     * @param IAuthenticationContext $authContext
     */
    public function __construct($url, IAuthenticationContext $authContext)
    {
		$this->serviceRootUrl = $url;
		$this->authContext = $authContext;
        $this->ApplicationName = ".PHP Client Library";
        $this->JsonFormat = new ODataJsonFormat("verbose");
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
     * @return mixed
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
            $this->pendingRequest = new ClientRequest($this);
        }
        return $this->pendingRequest;
    }
}