<?php


namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\ClientObject;

/**
 * Defines a single role definition, including a name, description, and set of rights.
 */
class RoleDefinition extends ClientObject
{
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }

}