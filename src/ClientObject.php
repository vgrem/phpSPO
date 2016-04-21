<?php

namespace SharePoint\PHP\Client;

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
        $this->queryOptions = array();
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
            $path = strtolower(end(explode("\\",get_class($this))));
        }
        if(isset($this->parentResourcePath)) {
            $path = $this->parentResourcePath . "/" . $path;
        }
        return $path;
    }



    public function getUrl()
    {
        $url = $this->getServiceRootUrl() . $this->getResourcePath();
        if($this->getQueryOptions() != null)
        {
            //todo:append url path from query options
        }
        return $url;
    }


    /**
     * @return array
     */
    public function getQueryOptions()
    {
        return $this->queryOptions;
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