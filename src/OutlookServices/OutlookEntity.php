<?php


namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\DeleteEntityQuery;
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


    public function addAnnotation($name, $value)
    {
        $this->annotations["@odata.$name"] = $value;
    }

    public function ensureTypeAnnotation()
    {
        $typeName = $this->getTypeName();
        $this->addAnnotation("type","#Microsoft.OutlookServices.$typeName");
    }





    function getProperties($flag=SCHEMA_ALL_PROPERTIES)
    {
        $result = parent::getProperties($flag);
        //include annotations
        foreach ($this->annotations as $key => $val) {
            $result[$key] = $val;
        }

        $reflection = new ReflectionObject($this);
        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $p) {
            $val = $p->getValue($this);
            if (!is_null($val)) {
                $result[$p->name] = $val;
            }
        }
        return $result;
    }


    function setProperty($name, $value, $persistChanges = true)
    {
        $normalizedName = ucfirst($name);
        if($normalizedName == "Id"){
            if(is_null($this->getResourcePath()))
                $this->setResourceUrl($this->parentCollection->getResourcePath()->toUrl() . "/" . $value);
            $this->{$normalizedName} = $value;
        }
        else
            parent::setProperty($normalizedName, $value, $persistChanges);
    }


    /**
     * @var string
     */
    public $Id;


    /**
     * @var array
     */
    protected $annotations = array();

}