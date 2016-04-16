<?php


namespace SharePoint\PHP\Client;

/**
 * Represents a field in a SharePoint list.
 */
class Field extends ClientObject
{
    /**
     * Sets the value of the ShowInDisplayForm property for this field.
     * @param $value true to show the field in the form; otherwise false.
     */
    public function setShowInDisplayForm($value){
        $endpoint = "/setshowindisplayform(" . var_export($value, true) . ")";
        $qry = new ClientQuery($this,ClientOperationType::Update,$endpoint);
        $this->getContext()->addQuery($qry);
    }
}