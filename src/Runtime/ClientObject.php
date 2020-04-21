<?php

namespace Office365\PHP\Client\Runtime;

use Office365\PHP\Client\Runtime\OData\ODataPathBuilder;
use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;

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
    private $properties = null;


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
     * @param string $value
     */
    public function setResourceUrl($value)
    {
        $this->resourcePath = ODataPathBuilder::fromUrl($value);
    }

    /**
     * Resolve the resource path
     * @param bool $includeQueryOptions
     * @return string
     */
    public function getResourceUrl($includeQueryOptions=true)
    {
        $url = $this->getContext()->getServiceRootUrl() . $this->getResourcePath()->toUrl();
        if ($includeQueryOptions && !$this->getQueryOptions()->isEmpty()) {
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
     * Gets entity type name for a resource
     * @return string
     */
    public function getTypeName()
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
     */
    public function setProperty($name, $value, $persistChanges = true)
    {
        if($persistChanges)
            $this->changes[$name] = $value;

        //save property
        $this->{$name} = $value;

        //update resource path
        if ($name === "Id") {
            if (is_null($this->getResourcePath())) {
                if (is_int($value)) {
                    $entityKey = "({$value})";
                } else {
                    $entityKey = "(guid'{$value}')";
                }
                $this->setResourceUrl($this->parentCollection->getResourcePath()->toUrl() . $entityKey);
            }
        }

    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
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


    public function mapJson($json){
        foreach ($json as $key => $value) {
            if(is_array($value)){
                $getterName = "get$key";
                if(method_exists($this,$getterName))
                    $propertyType = $this->{$getterName}();
                else
                    $propertyType = $this->getProperty($key);
                if($propertyType instanceof ClientObject || $propertyType instanceof ClientValueObject)
                    $propertyType->mapJson($value);
                else
                    $this->setProperty($key,$value,false);
            }
            else
                $this->setProperty($key,$value,false);
        }
    }

}
