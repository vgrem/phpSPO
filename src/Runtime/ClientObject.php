<?php

namespace Office365\PHP\Client\Runtime;;


/**
 * Represents OData entity
 */
abstract class ClientObject
{

    /**
     * @var string
     */
    protected $resourceType;

    /**
     * @var ClientRuntimeContext
     */
    private $ctx;

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
    private $changed_properties = array();

    /**
     * @var ClientObjectCollection
     */
    protected $parentCollection;


    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null)
    {
        $this->ctx = $ctx;
        $this->resourcePath = $resourcePath;
    }


    /**
     * @return ClientRuntimeContext
     */
    public function getContext()
    {
        return $this->ctx;
    }


    /**
     * Removes object from parent collection
     */
    protected function removeFromParentCollection()
    {
        if (is_null($this->parentCollection == null))
            return;
        $this->parentCollection->removeChild($this);
    }


    /**
     * @return array
     */
    public function getChangedProperties()
    {
        return $this->changed_properties;
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
     * @param string $resourcePathUrl
     */
    public function setResourceUrl($resourcePathUrl)
    {
        $this->resourcePath = ResourcePath::parse($this->getContext(), $resourcePathUrl);
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
    public function getEntityTypeName()
    {
        if (isset($this->resourceType))
            return $this->resourceType;
        $classInfo = explode("\\", get_class($this));
        return end($classInfo);
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
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
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
        if ($persistChanges) {
            $this->changed_properties[$name] = $value;
        }

        //save property
        $this->{$name} = $value;

        if ($name == "Id") {
            if (is_int($value))
                $entityKey = "({$value})";
            else
                $entityKey = "(guid'{$value}')";
            $this->setResourceUrl($this->getResourcePath()->toUrl() . $entityKey);
        }
    }


    public function __set($name, $value)
    {
        $this->properties[$name] = $value;
    }

    public function __get($name)
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