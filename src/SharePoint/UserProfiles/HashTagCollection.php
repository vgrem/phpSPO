<?php

/**
 * Generated 2021-08-22T15:28:03+00:00 16.0.21611.12002
 */
namespace Office365\SharePoint\UserProfiles;

use Office365\Runtime\ResourcePath;
use Office365\SharePoint\BaseEntity;
use Office365\SharePoint\BaseEntityCollection;
class HashTagCollection extends BaseEntity
{
    /**
     * @return HashTagCollection
     */
    public function getItems()
    {
        return $this->getProperty("Items", new BaseEntityCollection($this->getContext(), new ResourcePath("items", $this->resourcePath), HashTag::class));
    }
    /**
     * @var HashTagCollection
     */
    public function setItems($value)
    {
        return $this->setProperty("Items", $value, true);
    }
}