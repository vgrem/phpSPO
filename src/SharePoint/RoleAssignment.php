<?php
/**
 * Defines the securable object role assignments for a user or group on the Web site, list, or list item.
 */

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataFormat;


class RoleAssignment extends ClientObject
{

    /**
     * Updates Role Assignment
     */
    public function update()
    {
        $qry = new ClientActionUpdateEntity($this);
        $this->getContext()->addQuery($qry,$this);
    }


    /**
     * Deletes Role Assignment
     */
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
            $this->setProperty("Member", new Principal($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"Member")));
        }
        return $this->getProperty("Member");
    }


    function convertToEntity($itemPayload, ODataFormat $format)
    {
        if(property_exists($itemPayload,"Member")){
            switch ($itemPayload->Member->PrincipalType){
                case PrincipalType::User:
                    $this->setProperty("Member", new User(
                        $this->getContext(),
                        new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"Member")));
                    break;
                case PrincipalType::SharePointGroup:
                    $this->setProperty("Member", new Group(
                        $this->getContext(),
                        new ResourcePathEntity($this->getContext(),$this->getResourcePath(),"Member")));
                    break;
            }
        }

        parent::convertToEntity($itemPayload, $format);
    }




}