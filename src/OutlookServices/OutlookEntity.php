<?php


namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientActionDeleteEntity;
use Office365\PHP\Client\Runtime\ClientActionUpdateEntity;
use Office365\PHP\Client\Runtime\ClientObject;
use ReflectionObject;
use ReflectionProperty;

class OutlookEntity extends ClientObject
{

    /**
     * @var string
     */
    public $Id;


    /**
     * Identifies the version of the outlook object. Every time the event is changed, ChangeKey changes as well.
     * This allows Exchange to apply changes to the correct version of the object.
     * @var string
     */
    public $ChangeKey;

    /**
     * Updates a resource
     */
    public function update()
    {
        $qry = new ClientActionUpdateEntity($this);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Deletes a resource
     */
    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }



    function getChangedProperties()
    {
        $modifiedProperties = parent::getChangedProperties();
        $reflection = new ReflectionObject($this);
        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $p) {
            $val = $p->getValue($this);
            $isModified = false;
            if (!is_null($val)) {
                //if($this->isPropertyAvailable($p->name)){
                //    $isModified = ($this->getProperties()[$p->name] != $val);
                //}
                //else
                $isModified = true;
            }
            if($isModified)
                $modifiedProperties[$p->name] = $val;
        }
        return $modifiedProperties;
    }


    function setProperty($name, $value, $persistChanges = true)
    {
        if($name == "Id"){
            if(is_null($this->getResourcePath()))
                $this->setResourceUrl($this->parentCollection->getResourcePath()->toUrl() . "/" . $value);
            $this->{$name} = $value;
        }
        else
            parent::setProperty($name, $value, $persistChanges);
    }


}