<?php

namespace SharePoint\PHP\Client;

/**
 * Specifies a list view.
 */
class View extends ClientObject
{

    private $ViewFields;


    /**
     * Gets a value that specifies the collection of fields in the list view.
     * @return ViewFieldCollection
     */
    public function getViewFields()
    {
        if(!$this->isPropertyAvailable('ViewFields')){
            $this->ViewFields = new ViewFieldCollection($this->getContext(),$this->getResourcePath(), "viewfields");
        }
        return $this->ViewFields;
    }


    /**
     * The recommended way to delete a view is to send a DELETE request to the View resource endpoint,
     * as shown in View request examples.
     */
    public function deleteObject()
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Delete);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Returns the list view as HTML.
     */
    public function renderAsHtml(){
        $qry = new ClientQuery($this->getUrl() . "/renderashtml",ClientActionType::Read);
        $this->getContext()->addQuery($qry);
    }

}