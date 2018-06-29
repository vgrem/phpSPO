<?php

namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\InvokeMethodQuery;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientObject;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

/**
 * Specifies a list view.
 */
class View extends ClientObject
{

    /**
     * Updates view resource
     */
    public function update()
    {
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQuery($qry,$this);
    }

    /**
     * Gets a value that specifies the collection of fields in the list view.
     * @return ViewFieldCollection
     */
    public function getViewFields()
    {
        if(!$this->isPropertyAvailable('ViewFields')){
            $this->setProperty("ViewFields", new ViewFieldCollection($this->getContext(), new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "ViewFields")));
        }
        return $this->getProperty("ViewFields");
    }


    /**
     * The recommended way to delete a view is to send a DELETE request to the View resource endpoint,
     * as shown in View request examples.
     */
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Returns the list view as HTML.
     */
    public function renderAsHtml(){
        $qry = new InvokeMethodQuery(
            $this->getResourcePath(),
            "renderashtml"
        );
        $this->getContext()->addQuery($qry);
    }

}