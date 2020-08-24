<?php

namespace Office365\SharePoint;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ResourcePathServiceOperation;


/**
 * List collection
 */
class ListCollection extends ClientObjectCollection
{
    /**
     * Get List by title
     * @param $title
     * @return SPList
     */
    public function getByTitle($title)
    {
        return new SPList(
            $this->getContext(),
            new ResourcePathServiceOperation("getByTitle",array(rawurlencode($title)),$this->getResourcePath())
        );
    }

    /**
     * Get List by id
     * @param $id
     * @return SPList
     */
    public function getById($id)
    {
        return new SPList(
            $this->getContext(),
            new ResourcePathServiceOperation("getById",array($id),$this->getResourcePath())
        );
    }


    /**
     * Creates a List resource
     * @param ListCreationInformation $properties
     * @return SPList
     */
    public function add(ListCreationInformation $properties)
    {
        $list = new SPList($this->getContext());
        $qry = new InvokePostMethodQuery($this,null,null,null,$properties);
        $this->getContext()->addQueryAndResultObject($qry,$list);
        $this->addChild($list);
        return $list;
    }

    /**
     * @return string
     */
    public function getItemTypeName()
    {
        return __NAMESPACE__ . "\\" . "SPList";
    }
}