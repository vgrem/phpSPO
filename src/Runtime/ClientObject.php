<?php

namespace Office365\Runtime;

use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\OData\ODataQueryOptions;

/**
 * Represents OData Entity
 */
class ClientObject
{

    /**
     * @var ClientRuntimeContext
     */
    protected $context;

    /**
     * @var ResourcePath
     */
    protected $resourcePath;

    /**
     * @var array
     */
    protected $properties;


    /**
     * @var array
     */
    protected $changes = array();

    /**
     * @var self
     */
    protected $parentCollection;

    /**
     * @var ODataQueryOptions
     */
    protected $queryOptions;

    /**
     * @var string
     */
    protected $namespace;


    /**
     * ClientObject constructor.
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath|null $resourcePath
     * @param ODataQueryOptions|null $queryOptions
     * @param string|null $namespace
     */
    public function __construct(ClientRuntimeContext $ctx,
                                ResourcePath $resourcePath = null,
                                ODataQueryOptions $queryOptions = null,
                                $namespace=null)
    {
        $this->context = $ctx;
        $this->resourcePath = $resourcePath;
        $this->namespace = $namespace;
        $this->properties = array();
        $this->queryOptions = $queryOptions;
        if (!isset($this->queryOptions))
           $this->queryOptions = new ODataQueryOptions();
        else
            $this->queryOptions = $queryOptions;
    }


    /**
     * @return self
     */
    public function get(){
        $this->getContext()->load($this);
        return $this;
    }


    /**
     * @return RequestOptions
     */
    public function buildRequest(){
        return $this->getContext()->buildRequest();
    }


    /**
     * Submit a client request
     * @return self
     */
    public function executeQuery(){
        $this->getContext()->executeQuery();
        return $this;
    }

    /**
     * Submit a query along with handling transient failures
     * @param int $retryCount
     * @param int $delaySecs
     * @return self
     * @throws \Exception
     */
    public function executeQueryRetry($retryCount=3,$delaySecs=10){
        $this->getContext()->executeQueryRetry($retryCount,$delaySecs);
        return $this;
    }

    /**
     * @return ODataQueryOptions
     */
    public function getQueryOptions()
    {
        return $this->queryOptions;
    }


    /**
     * @return self
     */
    public function getParentCollection()
    {
        return $this->parentCollection;
    }

    /**
     * @return null
     */
    protected function getServerTypeId()
    {
        return null;
    }


    /**
     * @return ClientRuntimeContext
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Removes object from parent collection
     */
    protected function removeFromParentCollection()
    {
        if ($this->parentCollection === null) {
            return;
        }
        $this->parentCollection->removeChild($this);
    }


    /**
     * Resolve the resource path
     * @return ResourcePath
     */
    public function getResourcePath()
    {
        return $this->resourcePath;
    }

    /**
     * Resolve the resource path
     * @return string
     */
    public function getResourceUrl()
    {
        $url = $this->getContext()->getServiceRootUrl() . $this->getResourcePath()->toUrl();
        if (!$this->getQueryOptions()->isEmpty()) {
            $url .= '?' . $this->getQueryOptions()->toUrl();
        }
        return $url;
    }


    /**
     * Directs that related records should be retrieved in the record or collection being retrieved.
     * @param string|string[] $value
     * @return ClientObject $this
     */
    public function expand($value)
    {
        if(is_array($value))
            $this->queryOptions->Expand = implode(',', $value);
        else
            $this->queryOptions->Expand = $value;
        return $this;
    }


    /**
     * Specifies a subset of properties to return.
     * @param string|string[] $value
     * @return ClientObject $this
     */
    public function select($value)
    {
        if(is_array($value))
            $this->queryOptions->Select = implode(',', $value);
        else
            $this->queryOptions->Select = $value;
        return $this;
    }


    /**
     * Gets entity type name
     * @return string
     */
    public function getServerTypeName()
    {
        return null;
    }

    /**
     * @return array
     */
    function toJson($onlyChanges=false)
    {
        if($onlyChanges){
            $result = array();
            foreach ($this->properties as $k => $v) {
                if (array_key_exists($k, $this->changes)) {
                    $result[$k] = $v;
                }
            }
            return $result;
        }
        return $this->properties;
    }


    /**
     * Determine whether client object property has been loaded
     * @param string $name
     * @return bool
     */
    public function isPropertyAvailable($name)
    {
        return isset($this->properties[$name]);
    }


    /**
     * Determine whether client object has been retrieved from the server
     * @return bool
     */
    public function getServerObjectIsNull(){
        return is_null($this->properties);
    }


    /**
     * A preferred way of getting the client object property
     * @param string $name
     * @param mixed|null $defaultValue
     * @return mixed|null
     */
    public function getProperty($name,$defaultValue=null)
    {
        $calledFnName = debug_backtrace()[1]['function'];

        if($this->isPropertyAvailable($name))
            return $this->properties[$name];
        else if(is_null($defaultValue)) {
            $getter = "get$name";
            if(method_exists($this,$getter) && strcasecmp($getter, $calledFnName) != 0) {
                $defaultValue = $this->$getter();
            }
        }
        return $defaultValue;
    }

    /**
     * A preferred way of setting the client object property
     * @param string $name
     * @param mixed $value
     * @param bool $persistChanges
     * @return $this
     */
    public function setProperty($name, $value, $persistChanges = true)
    {
        if($persistChanges)
            $this->changes[$name] = true;

        if($value instanceof ClientObject || $value instanceof ClientValue){
            $this->properties[$name] = $value;
            return $this;
        }

        if(!is_null($value)) {
            $childProperty = $this->getProperty($name);
            if($childProperty instanceof ClientObject || $childProperty instanceof ClientValue) {
                foreach ($value as $k=>$v){
                    $childProperty->setProperty($k,$v,False);
                }
                $this->properties[$name] = $childProperty;
            }
            else
                $this->properties[$name] = $value;
        }
        else
            $this->properties[$name] = $value;
        return $this;
    }


    /**
     * Ensures property is loaded
     * @param string $propName
     * @param callable $loadedCallback
     * @return self
     */
    public function ensureProperty($propName, $loadedCallback=null)
    {
        return $this->ensureProperties(array($propName), $loadedCallback);
    }

    /**
     * Ensure properties are loaded
     * @param array $propNames
     * @param callable $loadedCallback
     */
    public function ensureProperties($propNames, $loadedCallback=null){

        $result = array_filter($propNames,function ($name){
            return $this->isPropertyAvailable($name) === false;
        });

        if(count($result) === 0) {
            if(is_callable($loadedCallback)) call_user_func($loadedCallback, $this);
        } else {
            $this->getContext()->load($this, $propNames);
            $query = $this->getContext()->getCurrentQuery();
            $this->getContext()->afterExecuteQuery(function ($curQuery) use ($query, $loadedCallback){
                if($curQuery->getId() == $query->getId())
                    if(is_callable($loadedCallback)) call_user_func($loadedCallback, $this);
            });
        }
        return $this;
    }
}
