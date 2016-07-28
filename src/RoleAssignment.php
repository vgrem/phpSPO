<?php
/**
 * Defines the securable object role assignments for a user or group on the Web site, list, or list item.
 */

namespace SharePoint\PHP\Client;


class RoleAssignment extends ClientObject
{

    /**
     * Update operation
     */
    public function update()
    {
        $qry = new ClientActionUpdateEntity($this);
        $this->getContext()->addQuery($qry,$this);
    }


    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }



    /**
     * @return Principal
     */
    public function getMember()
    {
        if(!$this->isPropertyAvailable("Member")){
            $this->setProperty("Member", new Principal($this->getContext(),new ResourcePathEntry($this->getContext(),$this->getResourcePath(),"Member")));
        }
        return $this->getProperty("Member");
    }
}