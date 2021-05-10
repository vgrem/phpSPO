<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\ClientObject;
use Office365\Runtime\ResourcePath;



class TaxonomyItem extends ClientObject
{

    /**
     * @param string $name
     * @param mixed $value
     * @param bool $persistChanges
     * @return self
     */
    public function setProperty($name, $value, $persistChanges = true)
    {
        if ($name === "id" && is_null($this->getResourcePath())) {
            $this->resourcePath = new ResourcePath($value,$this->getParentCollection()->getResourcePath());
        }
        parent::setProperty($name, $value, $persistChanges);
        return $this;
    }

}