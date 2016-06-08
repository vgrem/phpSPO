<?php


namespace SharePoint\PHP\Client;

/**
 * Represents a field in a SharePoint list.
 */
class Field extends ClientObject
{

    public function deleteObject()
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Delete);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Sets the value of the ShowInDisplayForm property for this field.
     * @param $value true to show the field in the form; otherwise false.
     */
    public function setShowInDisplayForm($value){
        $url = $this->getUrl() . "/setshowindisplayform(" . var_export($value, true) . ")";
        $qry = new ClientQuery($url,ClientActionType::Update);
        $this->getContext()->addQuery($qry);
    }
}