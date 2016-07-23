<?php

namespace SharePoint\PHP\Client;

/**
 * Specifies a list view.
 */
class View extends ClientObject
{

    /**
     * Gets a value that specifies the collection of fields in the list view.
     * @return ViewFieldCollection
     */
    public function getViewFields()
    {
        if(!$this->isPropertyAvailable('ViewFields')){
            $this->setProperty("ViewFields", new ViewFieldCollection($this->getContext(), new ResourcePathEntry($this->getContext(),$this->getResourcePath(), "ViewFields")));
        }
        return $this->getProperty("ViewFields");
    }


    /**
     * The recommended way to delete a view is to send a DELETE request to the View resource endpoint,
     * as shown in View request examples.
     */
    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this->getResourceUrl());
        $this->getContext()->addQuery($qry);
    }


    /**
     * Returns the list view as HTML.
     */
    public function renderAsHtml(){
        $path = new ResourcePathServiceOperation($this->getContext(),$this->getResourcePath(),"renderashtml");
        $qry = new ClientActionUpdateMethod($path,null,HttpMethod::Get);
        $this->getContext()->addQuery($qry);
    }

}