<?php

namespace Office365\Runtime;

use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\OData\ODataQueryOptions;

/**
 * Represents OData base entity
 */
class ClientObject
{
    /**
     * @var string
     */
    protected $typeName;

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
    private $properties;


    /**
     * @var array
     */
    private $changes = array();

    /**
     * @var ClientObjectCollection
     */
    protected $parentCollection;

    /**
     * @var ODataQueryOptions
     */
    protected $queryOptions;


    /**
     * ClientObject constructor.
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath|null $resourcePath
     * @param ODataQueryOptions|null $queryOptions
     */
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null,ODataQueryOptions $queryOptions = null)
    {
        $this->context = $ctx;
        $this->resourcePath = $resourcePath;
        $this->properties = array();
        $this->queryOptions = $queryOptions;
        if (!isset($this->queryOptions))
           $this->queryOptions = new ODataQueryOptions();
        else
            $this->queryOptions = $queryOptions;
    }


    /**
     * @return $this
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
     * @return $this
     */
    public function executeQuery(){
        $this->getContext()->executeQuery();
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
     * @return ClientObjectCollection
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
     * @param $value
     * @return ClientObject $this
     */
    public function expand($value)
    {
        $this->queryOptions->Expand = $value;
        return $this;
    }


    /**
     * Specifies a subset of properties to return.
     * @param $value
     * @return ClientObject $this
     */
    public function select($value)
    {
        $this->queryOptions->Select = $value;
        return $this;
    }


    /**
     * Gets entity type name
     * @return string
     */
    public function getServerTypeName()
    {
        if (isset($this->typeName)) {
            return $this->typeName;
        }
        $classInfo = explode("\\", get_class($this));
        return end($classInfo);
    }

    /**
     * @return array
     */
    function toJson()
    {
        return $this->changes;
    }


    /**
     * Determine whether client object property has been loaded
     * @param $name
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
     * @return mixed|null
     */
    public function getProperty($name)
    {
        return $this->{$name};
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
            $this->changes[$name] = $value;
        $this->{$name} = $value;

        //update resource path
        if ($name === "Id") {
            if (is_null($this->getResourcePath())) {
                if (is_int($value)) {
                    $entityKey = "({$value})";
                } else {
                    $entityKey = "(guid'{$value}')";
                }
                $segment = $this->parentCollection->getResourcePath()->getSegment() . $entityKey;
                $this->resourcePath = new ResourcePath($segment,$this->parentCollection->getResourcePath()->getParent());
            }
        }
        return $this;
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        if(is_array($value)) {  /*Navigation property? */
            $propType = $this->getPropertyType($name);
            if($propType instanceof ClientObject || $propType instanceof ClientValue) {
                foreach ($value as $k=>$v){
                    $propType->setProperty($k,$v,False);
                }
                $this->properties[$name] = $propType;
            }
            else
                $this->properties[$name] = $value;
        }
        else
            $this->properties[$name] = $value;
    }

    /**
     * @param string $name
     * @return mixed|null
     */
    public function getPropertyType($name){
        $getterName = "get$name";
        if(method_exists($this,$getterName)) {
            return $this->{$getterName}();
        }
        return $this->getProperty($name);
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }
        return null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }


    /**
     * Ensures property is loaded
     * @param string $propName
     * @param callable $loadedCallback
     */
    public function ensureProperty($propName, $loadedCallback=null)
    {
        $this->ensureProperties(array($propName), $loadedCallback);
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
    }
}
