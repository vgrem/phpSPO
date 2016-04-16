<?php

namespace SharePoint\PHP\Client;

/**
 * Base client object 
 */
class ClientObject
{
    private $ctx;

    protected $resourcePath;

    protected $queryOptions;

    protected $payload;

    private $properties = array();

	public function __construct(ClientContext $ctx,$resourcePath=null,$queryOptions=null,$payload=null)
    {
		$this->ctx = $ctx;
        $this->resourcePath = $resourcePath;
        $this->queryOptions = $queryOptions;
        $this->payload = $payload;
    }

    public function getContext()
    {
        return $this->ctx;
    }

    public function getPayload()
    {
        $this->ensureEntityTypeName();
        return $this->payload;
    }

    public function getResourcePath()
    {
        if(!isset($this->resourcePath))
            throw new \Exception("Resource Path is not defined for " . $this->getEntityTypeName());
        return $this->resourcePath;
    }

    public function getEntityTypeName(){
       return "SP." . end(explode("\\",get_class($this)));;
    }

    public function getQueryOptions()
    {
        return $this->queryOptions;
    }

    public function fromJson($properties)
    {
        foreach($properties as $key => $value){
            $this->$key = $value;
        }
    }

    protected function ensureEntityTypeName(){
        if(!is_null($this->payload['parameters']))
            return;
        if(!is_null($this->payload) && !array_key_exists('__metadata',$this->payload)){
            $this->payload['__metadata'] = array( 'type' => $this->getEntityTypeName() );
        }
    }
    
    public function isPropertyAvailable($name){
        return isset($this->properties[$name]);
    }

    public function __set($name, $value)
    {
        if($name == '__metadata' && array_key_exists('uri',$value)){
            $this->resourcePath = str_replace($this->ctx->getUrl(), '', $value->uri); //sync resource path
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