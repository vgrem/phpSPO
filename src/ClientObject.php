<?php

namespace SharePoint\PHP\Client;


/**
 * Base client object 
 */
abstract class ClientObject
{

    /**
     * @var string
     */
    protected $resourceType;

    /**
     * @var ClientContext
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
    
    public function __construct(ClientContext $ctx, ResourcePath $resourcePath)
    {
        $this->ctx = $ctx;
        $this->resourcePath = $resourcePath;
        $this->serviceRootUrl = $ctx->getServiceRootUrl();
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
     * @return ResourcePath
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
        $typeNames = explode("\\", get_class($this));
        return "SP." . end($typeNames);
    }


    public static function createTypedObject(ClientContext $ctx, ClientObject $parentClientObject,  \stdClass $properties)
    {
        $typeParts = explode(".", $properties->__metadata->type);
        $entityName = $typeParts[1];
        if (count($typeParts) == 3) {
            if ($typeParts[1] == "Data") {
                $entityName = "ListItem";
            } else {
                $entityName = $typeParts[2];
            }
        }

        $clientObjectType = self::resolveClientObjectType($entityName);
        $clientObject = new $clientObjectType($ctx,new ResourcePathEntity($ctx,$parentClientObject->getResourcePath(),$entityName));
        $clientObject->initClientObjectProperties($properties);
        return $clientObject;
    }

    private static function resolveClientObjectType($entityName){
        $typeMappings = array(
            "Data" => "ListItem",
            "List" => "SPList",
            "TaxonomyField" => "Taxonomy\\TaxonomyField",
            "WebPartDefinition" => "WebParts\\WebPartDefinition"
        );

        if(array_key_exists($entityName,$typeMappings))
            $entityName = $typeMappings[$entityName];
        return __NAMESPACE__ . "\\" . $entityName;
    }


    public function fromJson($properties)
    {
        $ctx = $this->getContext();
        if($this instanceof ClientObjectCollection) {
            $this->clearData();
            if (isset($properties->results)) {
                foreach ($properties->results as $item) {
                    $clientObject = ClientObject::createTypedObject($ctx,$this, $item);
                    $this->addChild($clientObject);
                }
            }
            $this->areItemsAvailable = true;
        }
        else {
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
     * @param string $propertyName
     * @param string $entityName
     * @return ClientObject
     */
    protected function ensureProperty($propertyName, $entityName)
    {
        if(!$this->isPropertyAvailable($propertyName)){
            $clientObjectType = self::resolveClientObjectType($entityName);
            $clientObject = new $clientObjectType($this->getContext(),$this->getResourcePath(),$propertyName);
            $this->setProperty($propertyName,$clientObject);
        }
        return $this->getProperty($propertyName);

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
        if ($name == '__metadata') {
            $uriParts = explode(ClientContext::$ServicePath, strtolower($value->uri));
            $this->serviceRootUrl = $uriParts[0] . ClientContext::$ServicePath;
            $this->resourcePath = ResourcePath::parse($this->getContext(),$uriParts[1]);
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