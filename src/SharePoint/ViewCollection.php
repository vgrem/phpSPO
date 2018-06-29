<?php

namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\ClientObjectCollection;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ResourcePathServiceOperation;

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
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getByTitle",array(rawurlencode($title)))
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
            new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"getById",array($id))
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
        $qry = new InvokePostMethodQuery($this->getResourcePath(),null,null,$properties);
        $this->getContext()->addQuery($qry,$view);
        $this->addChild($view);
        return $view;
    }
}