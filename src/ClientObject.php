<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataQueryOptions;

/**
 * Base client object 
 */
abstract class ClientObject
{
    private $ctx;

    private $serviceRootUrl;

    protected $resourcePath;

    protected $parentResourcePath;

    protected $queryOptions;
    
    private $properties = array();

	public function __construct(ClientContext $ctx,$parentResourcePath=null,$resourcePath=null)
    {
		$this->ctx = $ctx;
        $this->resourcePath = $resourcePath;
        $this->parentResourcePath = $parentResourcePath;
        $this->queryOptions = new ODataQueryOptions();
    }

    public function getContext()
    {
        return $this->ctx;
    }


    /**
     * Gets the service root URL that identifies the root of an OData service
     * @return string
     */
    protected function getServiceRootUrl()
    {
        if(!isset($this->serviceRootUrl)){
            $this->serviceRootUrl = $this->getContext()->getUrl() . ClientContext::$ServicePath;
        }
        return $this->serviceRootUrl;
    }


    /**
     * Resolve the resource path
     * @return string
     */
    public function getResourcePath()
    {
        $path = $this->resourcePath;
        if(!isset($path)){
            $typeNames = explode("\\",get_class($this));
            $path = strtolower(end($typeNames));
        }
        if(isset($this->parentResourcePath)) {
            $path = $this->parentResourcePath . "/" . $path;
        }
        return $path;
    }

    /**
     * Gets resource uri
     * @return string
     */
    public function getUrl()
    {
        $url = $this->getServiceRootUrl() . $this->getResourcePath();
        $queryOptionsUrl = $this->getQueryOptionsUrl();
        if(!empty($queryOptionsUrl))
            $url = $url . "?" . $queryOptionsUrl;
        return $url;
    }


    /**
     * @return string
     */
    public function getQueryOptionsUrl()
    {
        return $this->queryOptions->toUrl();
    }

    public function getProperties()
    {
        return $this->properties;
    }

    public function getEntityTypeName(){
       return "SP." . end(explode("\\",get_class($this)));
    }


    public function fromJson($properties)
    {
        foreach($properties as $key => $value){
            $this->$key = $value;
        }
    }
    
    
    public static function createTypedObject(ClientContext $ctx, \stdClass $properties){
        $nsName = "SharePoint\\PHP\\Client\\";
        $parts = explode(".", $properties->__metadata->type);
        $clsName = $parts[1];
        if(count($parts) == 3){
            if($parts[1] == "Data"){
                $clsName = "ListItem";
            }
            else {
                $nsName = $nsName . $parts[1] . "\\";
                $clsName = $parts[2];
            }
        }
        if($clsName == "List") $clsName = "SPList";
        $clientObjectType = $nsName . $clsName;
        $clientObject = new $clientObjectType($ctx);
        $clientObject->fromJson($properties);
        return $clientObject;
    }
    
    public function isPropertyAvailable($name){
        return isset($this->properties[$name]) && !isset($this->properties[$name]->__deferred);
    }

    public function __set($name, $value)
    {
        if($name == '__metadata' && array_key_exists('uri',$value)){
            $uriParts = explode(ClientContext::$ServicePath,strtolower($value->uri));
            $this->serviceRootUrl = $uriParts[0] . ClientContext::$ServicePath;
            $this->resourcePath = $uriParts[1];
            $this->parentResourcePath = null;
        }
        $this->properties[$name] = $value;
    }

    public  function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        return null;
    }

    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }

}