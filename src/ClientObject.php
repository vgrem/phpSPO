<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataQueryOptions;

/**
 * Base client object 
 */
abstract class ClientObject
{
    protected $serverObjectLoaded;

    protected $resourceType;

    private $ctx;

    private $serviceRootUrl;

    protected $resourcePath;

    protected $parentResourcePath;

    protected $queryOptions;

    private $properties = array();

    private $changed_properties = array();

    /**
     * @var ClientObjectCollection
     */
    protected $parentCollection;

    public function __construct(ClientContext $ctx, $parentResourcePath = null, $resourcePath = null)
    {
        $this->ctx = $ctx;
        $this->resourcePath = $resourcePath;
        $this->parentResourcePath = $parentResourcePath;
        $this->queryOptions = new ODataQueryOptions();
        $this->serverObjectLoaded = false;
    }


    public function getContext()
    {
        return $this->ctx;
    }


    protected function removeFromParentCollection()
    {
        if (is_null($this->parentCollection == null))
           return;
        $this->parentCollection->removeChild($this);
    }


    /**
     * Gets the service root URL that identifies the root of an OData service
     * @return string
     */
    protected function getServiceRootUrl()
    {
        if (!isset($this->serviceRootUrl)) {
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
        if (!isset($path)) {
            $typeNames = explode("\\", get_class($this));
            $path = strtolower(end($typeNames));
        }
        if (isset($this->parentResourcePath)) {
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
        if (!empty($queryOptionsUrl))
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


    /**
     * Gets entity type name for a resource
     * @return string
     */
    public function getEntityTypeName()
    {
        if (isset($this->resourceType))
            return $this->resourceType;
        $typeNames = explode("\\", get_class($this));
        return "SP." . end($typeNames);
    }


    public static function createTypedObject(ClientContext $ctx, \stdClass $properties)
    {
        $baseNsName = __NAMESPACE__;
        $parts = explode(".", $properties->__metadata->type);
        $clsName = $parts[1];
        if (count($parts) == 3) {
            if ($parts[1] == "Data") {
                $clsName = "ListItem";
            } else {
                //$nsName = $baseNsName . "\\" . $parts[1] . "\\";
                $clsName = $parts[2];
            }
        }
        
        if ($clsName == "List"){
        	$clsName = "SPList";        
        }elseif($clsName == "TaxonomyField"){ 
        	$clsName="Taxonomy\\$clsName";
        }
        $clientObjectType = $baseNsName . "\\" . $clsName;
        $clientObject = new $clientObjectType($ctx);
        $clientObject->initClientObjectProperties($properties);
        return $clientObject;
    }


    public function fromJson($properties)
    {
        if($this instanceof ClientObjectCollection)
            $this->clearData();
        $this->serverObjectLoaded = true;
        $ctx = $this->getContext();
        if (isset($properties->results)) {
            foreach ($properties->results as $item) {
                $clientObject = ClientObject::createTypedObject($ctx, $item);
                $this->addChild($clientObject);
            }
        } else {
            $this->initClientObjectProperties($properties);
        }
    }


    public function toJson()
    {
        $this->ensureMetadataType($this->changed_properties);
        return json_encode($this->changed_properties);
    }


    protected function initClientObjectProperties($properties)
    {
        foreach ($properties as $key => $value) {
            $this->$key = $value;
        }
    }


    private function ensureMetadataType(&$parameters)
    {
        if (array_key_exists('parameters', $parameters)) {
            return $this->ensureMetadataType($parameters['parameters']);
        }
        if (!array_key_exists('__metadata', $parameters)) {
            $parameters['__metadata'] = ['type' => $this->getEntityTypeName()];
        }
        return $parameters;
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
     * @param bool $trackChanges
     */
    public function setProperty($name, $value, $trackChanges = true)
    {
        if ($trackChanges) {
            $this->changed_properties[$name] = $value;
        }
        $this->{$name} = $value;
    }


    public function __set($name, $value)
    {
        if ($name == '__metadata') {
            $uriParts = explode(ClientContext::$ServicePath, strtolower($value->uri));
            $this->serviceRootUrl = $uriParts[0] . ClientContext::$ServicePath;
            $this->resourcePath = $uriParts[1];
            $this->parentResourcePath = null;
            $this->resourceType = $value->type;
        }
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