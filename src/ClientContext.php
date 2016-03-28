<?php

namespace SharePoint\PHP\Client;

require_once('ClientOperationType.php');
require_once('ClientRequest.php');
require_once('ClientObject.php');
require_once('File.php');
require_once('Folder.php');
require_once('Web.php');
require_once('Site.php');
require_once('ClientObjectCollection.php');
require_once('List.php');
require_once('ListCollection.php');
require_once('ListItem.php');
require_once('ListItemCollection.php');
require_once('WebCollection.php');
require_once('FileCollection.php');
require_once('ClientQuery.php');


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

    private $web;

    private $site;

    private $queries = array();


    /**
     * Class constructor
     * @param mixed $service
     * @param string $name
     */
    public function __construct($url, AuthenticationContext $authContext)
    {
		$this->baseUrl = $url;
		$this->authContext = $authContext;
    }

    public function load($clientObject,$retrievals=null)
    {
        $qry = new ClientQuery($clientObject);
        $this->addQuery($qry);
    }

    public function executeQuery()
    {
        foreach ($this->queries as $qry) {
            $data = $this->getPendingRequest()->executeQuery($qry);
            if (!empty($data)){
                $qry->initClientObjectFromJson($data->d);
            }
        }
        $this->queries = array();
    }


    public function getWeb()
    {
        if(!isset($this->web)){
            $this->web = new Web($this,"/_api/web");
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