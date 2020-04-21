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


    /**
     * @return array
     */
    function toJson()
    {
        $json = array();
        $reflection = new ReflectionObject($this);
        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $p) {
            $val = $p->getValue($this);
            if (!is_null($val)) {
                $json[$p->name] = $val;
            }
        }

        return $json;
    }


    function setProperty($name, $value, $persistChanges = true)
    {
        $normalizedName = ucfirst($name);
        if ($normalizedName == "Id" && is_null($this->getResourcePath())) {
            $this->setResourceUrl($this->parentCollection->getResourcePath()->toUrl() . "/" . $value);
        }
        parent::setProperty($normalizedName, $value, $persistChanges);
    }


    /**
     * @var string
     */
    public $Id;
}
