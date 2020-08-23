<?php

namespace Office365\SharePoint;

use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ResourcePathServiceOperation;

class ViewCollection extends ClientObjectCollection
{
    /**
     * Get View by title
     * @param $title
     * @return View
     */
    public function getByTitle($title)
    {
        return new View(
            $this->getContext(),
            new ResourcePathServiceOperation("getByTitle",array(rawurlencode($title)),$this->getResourcePath())
        );
    }


    /**
     * Get View by id
     * @param $id
     * @return View
     */
    public function getById($id)
    {
        return new View(
            $this->getContext(),
            new ResourcePathServiceOperation("getById",array($id),$this->getResourcePath())
        );
    }




    /**
     * Creates a View resource
     * @param ViewCreationInformation $properties
     * @return View
     */
    public function add(ViewCreationInformation $properties)
    {
        $view = new View($this->getContext(),$this->getResourcePath());
        $qry = new InvokePostMethodQuery($this,null,null,null,$properties);
        $this->getContext()->addQueryAndResultObject($qry,$view);
        $this->addChild($view);
        return $view;
    }
}