<?php

namespace Office365\PHP\Client\Runtime;


use Office365\PHP\Client\Runtime\OData\ODataPathBuilder;

/**
 * Represents OData base entity
 */
class ClientObject implements IEntityType
{
    /**
     * @var string
     */
    protected $resourceType;

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
    private $properties = array();


    /**
     * @var array
     */
    private $propertiesMetadata = array();

    /**
     * @var ClientObjectCollection
     */
    protected $parentCollection;




    /**
     * ClientObject constructor.
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath|null $resourcePath
     */
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null)
    {
        $this->context = $ctx;
        $this->resourcePath = $resourcePath;
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
        $this->resourcePath = ODataPathBuilder::fromUrl($this->getContext(), $value);
    }

    /**
     * Resolve the resource path
     * @return string
     */
    public function getResourceUrl()
    {
        return $this->getContext()->getServiceRootUrl() . $this->getResourcePath()->toUrl();
    }

    /**
     * Gets entity type name for a resource
     * @return string
     */
    public function getTypeName()
    {
        if (isset($this->resourceType)) {
            return $this->resourceType;
        }
        $classInfo = explode("\\", get_class($this));
        return end($classInfo);
    }

    /**
     * @param int $flag
     * @return array
     */
    function getProperties($flag=SCHEMA_ALL_PROPERTIES)
    {
        if($flag === SCHEMA_ALL_PROPERTIES)
            return $this->properties;
        //exclude non serializable properties
        $result = array();
        foreach( $this->properties as $key=>$value ) {
            $metadata = $this->propertiesMetadata[$key];
            if(($metadata !== null && $metadata["Serializable"] == true))
                $result[$key] = $value;
        }
        return $result;
    }


    /**
     * Determine whether client object property has been loaded
     * @param $name
     * @return bool
     */
    public function isPropertyAvailable($name)
    {
        return isset($this->properties[$name]) && !isset($this->properties[$name]->__deferred);
    }


    /**
     * Determine whether client object has been retrieved from the server
     * @return bool
     */
    public function getServerObjectIsNull(){
        if(!is_null($this->resourcePath))
            return $this->resourcePath->ServerObjectIsNull;
        return true;
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
        $this->propertiesMetadata[$name] = array("Serializable" => $persistChanges);

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



}
