<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataEntity;
use SharePoint\PHP\Client\Runtime\ODataFormat;
use SharePoint\PHP\Client\Runtime\ODataPayloadKind;
use stdClass;

/**
 * Base client object 
 */
abstract class ClientObject extends ODataEntity
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
     * @var string
     */
    private $serviceRootUrl;

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
        $this->serviceRootUrl = $ctx->getServiceRootUrl();
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
     * @return string
     */
    public function getServiceRootUrl()
    {
        return $this->serviceRootUrl;
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
        return $this->serviceRootUrl . $this->getResourcePath()->toUrl();
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
     * @return int
     */
    function getPayloadType()
    {
        return ODataPayloadKind::Entry;
    }


    /**
     * @param mixed $itemPayload
     * @param ODataFormat $format
     */
    function convertToEntity($itemPayload, ODataFormat $format)
    {
        parent::convertToEntity($itemPayload, $format);
        //sync resource path
        if (property_exists($itemPayload, "Id") && !is_object($itemPayload->Id)) {
            if(is_int($itemPayload->Id))
                $entityKey = "({$itemPayload->Id})";
            else
                $entityKey = "(guid'{$itemPayload->Id}')";
            $this->resourcePath = ResourcePath::parse(
                $this->getContext(),
                $this->getResourcePath()->toUrl() . $entityKey);
        }
    }


    /**
     * @return stdClass
     */
    public function convertToPayload()
    {
        $payload = new \stdClass();
        foreach ($this->getChangedProperties() as $k => $v) {
            $payload->{$k} = $v;
        }
        return $payload;
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
     * @param $name
     * @return mixed|null
     */
    public function getProperty($name)
    {
        return $this->{$name};
    }


    /**
     * A preferred way of setting the client object property
     * @param $name
     * @param $value
     * @param bool $persistChanges
     */
    public function setProperty($name, $value, $persistChanges = true)
    {
        if ($persistChanges) {
            $this->changed_properties[$name] = $value;
        }
        $this->{$name} = $value;
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