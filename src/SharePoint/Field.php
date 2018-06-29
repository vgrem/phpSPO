<?php


namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ClientObject;

/**
 * Represents a field in a SharePoint list.
 */
class Field extends ClientObject
{

    public function update()
    {
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQuery($qry,$this);
    }

    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Sets the value of the ShowInDisplayForm property for this field.
     * @param $value true to show the field in the form; otherwise false.
     */
    public function setShowInDisplayForm($value){
        $qry = new InvokePostMethodQuery(
            $this->getResourcePath(),
            "setShowInDisplayForm",
            array($value)
        );
        $this->getContext()->addQuery($qry);
    }
}