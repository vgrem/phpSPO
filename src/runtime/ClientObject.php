<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataPrimitiveTypeKind;


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


    /**
     * @return ClientContext
     */
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
        $typeNames = explode("\\", get_class($this));
        return "SP." . end($typeNames);
    }


    /**
     * @param ClientObject $parentClientObject
     * @param \stdClass $data
     * @return ClientObject
     * @internal param ClientContext $ctx
     */
    public static function createTypedObject(ClientObject $parentClientObject,  \stdClass $data)
    {
        $ctx = $parentClientObject->getContext();
        $typeParts = explode(".", $data->__metadata->type);
        $entityName = $typeParts[1];
        if (count($typeParts) == 3) {
            if ($typeParts[1] == "Data") {
                $entityName = "ListItem";
            } else {
                $entityName = $typeParts[2];
            }
        }
        $clientObjectType = self::resolveClientObjectType($entityName);
        $clientObject = new $clientObjectType($ctx,new ResourcePathEntry($ctx,$parentClientObject->getResourcePath(),$entityName));
        return $clientObject;
    }

    private static function resolveClientObjectType($entityName){
        $typeMappings = array(
            "Data" => "ListItem",
            "List" => "SPList",
            "TaxonomyField" => "Taxonomy\\TaxonomyField",
            "WebPartDefinition" => "WebParts\\WebPartDefinition",
            "PersonProperties" => "UserProfiles\\PersonProperties"
        );

        if(array_key_exists($entityName,$typeMappings))
            $entityName = $typeMappings[$entityName];
        return __NAMESPACE__ . "\\" . $entityName;
    }


    public function fromJson($data)
    {
        if($this instanceof ClientObjectCollection) {
            $this->clearData();
            if (isset($data->results)) {
                foreach ($data->results as $item) {
                    $clientObject = ClientObject::createTypedObject($this, $item);
                    $clientObject->initClientObjectProperties($item);
                    $this->addChild($clientObject);
                }
            }
            $this->areItemsAvailable = true;
        }
        else {
            $this->initClientObjectProperties($data);
        }
    }


    public function toJson()
    {
        $this->ensureMetadataType($this->changed_properties);
        return json_encode($this->changed_properties);
    }


    protected function initClientObjectProperties(\stdClass $data,$parentPropertyName=null)
    {
        $primitiveNames = ODataPrimitiveTypeKind::getValues();
        $primitiveCollectionNames = array_map(function($name) { return "Collection(" . $name . ")";} , $primitiveNames);

        foreach ($data as $key => $value) {
            if($key == "__metadata") { //update resource type
                $uriParts = explode(ClientContext::$ServicePath, strtolower($value->uri));
                $this->serviceRootUrl = $uriParts[0] . ClientContext::$ServicePath;
                $this->resourcePath = ResourcePath::parse($this->getContext(),$uriParts[1]);
                $this->resourceType = $value->type;
            }
            else if(isset($value->__deferred)){ //deferred property
                $this->$key = null;
            }
            else if(!is_object($value)){ //primitive property
                $this->$key = $value;
            }
            else if(isset($value->__metadata)) {
                if(in_array($value->__metadata->type,$primitiveCollectionNames)){ //determine whether is primitive collection property
                    $this->$key = $value->results;
                }
                else {
                    $clientObject = ClientObject::createTypedObject($this, $value);
                    $this->$key = $clientObject;
                }
            }
            else {
                $this->$key = array();
                foreach ($value->results as $pair) {
                    $this->$key[$pair->Key] = $pair->Value;
                }
            }
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