<?php

namespace SharePoint\PHP\Client;

require_once('runtime/utilities/EnumType.php');
require_once('runtime/ClientActionType.php');
require_once('runtime/ClientRequest.php');
require_once('runtime/ContextWebInformation.php');
require_once('runtime/ODataQueryOptions.php');
require_once('ClientObject.php');
require_once('SecurableObject.php');
require_once('File.php');
require_once('Folder.php');
require_once('Web.php');
require_once('Site.php');
require_once('FieldType.php');
require_once('Field.php');
require_once('FieldLookup.php');
require_once('FieldText.php');
require_once('taxonomy/TaxonomyField.php');
require_once('FieldNumber.php');
require_once('FieldDateTime.php');
require_once('FieldGuid.php');
require_once('FieldUser.php');
require_once('FieldComputed.php');
require_once('FieldMultiLineText.php');
require_once('FieldUrl.php');
require_once('FieldChoice.php');
require_once('FieldCalculated.php');
require_once('FieldMultiChoice.php');
require_once('FieldGeolocation.php');
require_once('PrincipalType.php');
require_once('Principal.php');
require_once('User.php');
require_once('Group.php');
require_once('RoleAssignment.php');
require_once('ClientObjectCollection.php');
require_once('FieldCollection.php');
require_once('List.php');
require_once('ListCollection.php');
require_once('InformationRightsManagementSettings.php');
require_once('View.php');
require_once('ViewCollection.php');
require_once('ViewFieldCollection.php');
require_once('ListItem.php');
require_once('ListItemCollection.php');
require_once('WebCollection.php');
require_once('FileCollection.php');
require_once('FolderCollection.php');
require_once('UserCollection.php');
require_once('GroupCollection.php');
require_once('RoleAssignmentCollection.php');
require_once('RoleDefinition.php');
require_once('RoleDefinitionCollection.php');
require_once('UserCustomAction.php');
require_once('UserCustomActionCollection.php');
require_once('RecycleBinItem.php');
require_once('RecycleBinItemCollection.php');
require_once('FileVersion.php');
require_once('FileVersionCollection.php');
require_once('Change.php');
require_once('ChangeFile.php');
require_once('ChangeItem.php');
require_once('ChangeCollection.php');
require_once('runtime/ClientQuery.php');
require_once('ClientValueObject.php');
require_once('ClientValueObjectCollection.php');
require_once('ChangeQuery.php');
require_once('ChangeType.php');
require_once('ChangeLogItemQuery.php');
require_once('PermissionKind.php');
require_once('BasePermissions.php');
require_once('WebCreationInformation.php');
require_once('GroupCreationInformation.php');
require_once('ListCreationInformation.php');
require_once('ListTemplateType.php');
require_once('ListItemCollectionPosition.php');
require_once('CamlQuery.php');
require_once('FieldCreationInformation.php');
require_once('FieldLookupValue.php');
require_once('FieldUrlValue.php');
require_once('FieldUserValue.php');
require_once('FieldGeolocationValue.php');
require_once('webparts/LimitedWebPartManager.php');

/**
 * Client context
 */
class ClientContext
{
    /**
     * Web site url
     * @var string
     */
	private $baseUrl;

    private $authContext;

    private $pendingRequest;

    private $site;

    private $web;

    private $queries = array();

    private $resultObjects = array();

    public static $ServicePath = "/_api/";


    /**
     * REST client context
     * @param $url
     * @param AuthenticationContext $authContext
     */
    public function __construct($url, AuthenticationContext $authContext)
    {
		$this->baseUrl = $url;
		$this->authContext = $authContext;
    }

    public function load(ClientObject $clientObject)
    {
        if( !in_array( $clientObject ,$this->resultObjects ) ) {
            $qry = new ClientQuery($clientObject->getUrl());
            $this->addQuery($qry,$clientObject);
        }
    }

    public function executeQuery()
    {
        foreach ($this->queries as $qry) {
            $data = $this->getPendingRequest()->executeQuery($qry);
            $resultObject = $this->getResultObjectByQuery($qry);
            if (!empty($data) && !is_null($resultObject)){
                if($resultObject instanceof ClientObject) {
                    $resultObject->fromJson($data->d);
                }
                else if($resultObject instanceof ClientValueObject){
                    $resultObject->fromJson($data->d);
                }
            }
        }
        $this->queries = array();
    }


    private function getResultObjectByQuery(ClientQuery $query){
        if(array_key_exists($query->getId(),$this->resultObjects))
            return $this->resultObjects[$query->getId()];
        return null;
    }


    public function getWeb()
    {
        if(!isset($this->web)){
            $this->web = new Web($this);
        }
        return $this->web;
    }


    public function getSite()
    {
        if(!isset($this->site)){
            $this->site = new Site($this);
        }
        return $this->site;
    }

  
    public function getPendingRequest()
    {
        if(!isset($this->pendingRequest)){
            $this->pendingRequest = new ClientRequest($this->baseUrl,$this->authContext);
        }
        return $this->pendingRequest;
    }

    public function addQuery(ClientQuery $query,$resultObject=null)
    {
        if(isset($resultObject)){
            $queryId = $query->getId();
            $this->resultObjects[$queryId] = $resultObject;
        }
        $this->queries[] = $query;
    }
    
    
    public function getUrl()
    {
        return $this->baseUrl;
    }
    
}