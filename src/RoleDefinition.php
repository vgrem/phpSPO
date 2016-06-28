<?php


namespace SharePoint\PHP\Client;

/**
 * Defines a single role definition, including a name, description, and set of rights.
 */
class RoleDefinition extends ClientObject
{
    public function deleteObject()
    {
        $qry = new ClientAction($this->getResourcePath(),HttpMethod::Delete);
        $this->getContext()->addQuery($qry);
    }

}