<?php

namespace Office365\Runtime;

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
     * @param ClientObject $clientObject
     * @param array|null $selectProperties
     * @return $this
     */
    public function load(ClientObject $clientObject, array $selectProperties = null){
        $this->context->load($clientObject,$selectProperties);
        return $this;
    }

    /**
     * @return $this
     */
    public function executeQuery(){
        $this->context->executeQuery();
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
    private function getPropertyType($name){
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

}
