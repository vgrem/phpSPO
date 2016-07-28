<?php


namespace SharePoint\PHP\Client;

/**
 * Represents a field in a SharePoint list.
 */
class Field extends ClientObject
{

    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Sets the value of the ShowInDisplayForm property for this field.
     * @param $value true to show the field in the form; otherwise false.
     */
    public function setShowInDisplayForm($value){
        $qry = new ClientActionInvokePostMethod(
            $this,
            "setShowInDisplayForm",
            array($value)
        );
        $this->getContext()->addQuery($qry);
    }
}