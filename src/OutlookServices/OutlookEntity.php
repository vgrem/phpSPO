<?php


namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\OData\ODataFormat;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use ReflectionObject;
use ReflectionProperty;

class OutlookEntity extends ClientObject
{

    /**
     * Updates a resource
     */
    public function update()
    {
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Deletes a resource
     */
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }


    protected function ensureTypeAnnotation(&$json)
    {
        if($this->IncludeTypeAnnotation){
            $typeName = $this->getTypeName();
            $json["@odata.type"] = "#Microsoft.OutlookServices.$typeName";
        }
    }



    function toJson(ODataFormat $format)
    {
        $json = array();
        $this->ensureTypeAnnotation($json);
        $reflection = new ReflectionObject($this);
        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $p) {
            $val = $p->getValue($this);
            if (!is_null($val) && $p->getName() !== "IncludeTypeAnnotation") {
                $json[$p->name] = $val;
            }
        }
        return $json;
    }


    function setProperty($name, $value, $serializable = true)
    {
        $normalizedName = ucfirst($name);
        if($normalizedName == "Id"){
            if(is_null($this->getResourcePath()))
                $this->setResourceUrl($this->parentCollection->getResourcePath()->toUrl() . "/" . $value);
            $this->{$normalizedName} = $value;
        }
        else
            parent::setProperty($normalizedName, $value, $serializable);
    }


    /**
     * @var string
     */
    public $Id;

    public $IncludeTypeAnnotation;
}
