<?php

namespace SharePoint\PHP\Client;

require_once('utilities/Enum.php');
require_once('runtime/ClientActionType.php');
require_once('runtime/ClientRequest.php');
require_once('ClientObject.php');
require_once('File.php');
require_once('Folder.php');
require_once('Web.php');
require_once('Site.php');
require_once('Field.php');
require_once('User.php');
require_once('Group.php');
require_once('RoleAssignment.php');
require_once('ClientObjectCollection.php');
require_once('FieldCollection.php');
require_once('List.php');
require_once('ListCollection.php');
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
require_once('Change.php');
require_once('ChangeFile.php');
require_once('ChangeCollection.php');
require_once('runtime/ClientQuery.php');
require_once('ClientValueObject.php');
require_once('ClientValueObjectCollection.php');
require_once('ChangeQuery.php');
require_once('ChangeType.php');
require_once('ChangeLogItemQuery.php');
require_once('BasePermissions.php');
require_once('WebCreationInformation.php');
require_once('GroupCreationInformation.php');
require_once('ListCreationInformation.php');
require_once('ListTemplateType.php');


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

    public function load($clientObject,$retrievals=null)
    {
        if(!is_null($retrievals)){
            //todo...
        }
        $qry = new ClientQuery($clientObject->getUrl());
        $qry->addResultObject($clientObject);
        $this->addQuery($qry);
    }

    public function executeQuery()
    {
        foreach ($this->queries as $qry) {
            $data = $this->getPendingRequest()->executeQuery($qry);
            if (!empty($data) && !is_null($qry->getResultObject())){
                $qry->initClientObjectFromJson($data->d);
            }
        }
        $this->queries = array();
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

    public function addQuery($query)
    {
        $this->queries[] = $query;
    }
    
    
    public function getUrl()
    {
        return $this->baseUrl;
    }
    
}