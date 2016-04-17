<?php

namespace SharePoint\PHP\Client;

/**
 * Web client object collection
 *
 */
class WebCollection extends ClientObjectCollection
{
    
    public function add(WebCreationInformation $webCreationInformation)
    {
        $payload = array(
            'parameters' => array(
                '__metadata' => array('type' => 'SP.WebCreationInformation'),
                'Title' => $webCreationInformation->Title,
                'Url' => $webCreationInformation->Url,
                'WebTemplate' => $webCreationInformation->WebTemplate,
                'Language' => $webCreationInformation->Language,
                'UseSamePermissionsAsParentSite' => !$webCreationInformation->UseUniquePermissions
        ));
        $web = new Web($this->getContext(),$this->getResourcePath(),null,$payload);
        $qry = new ClientQuery($web,ClientOperationType::Create,"/add");
        $this->getContext()->addQuery($qry);
        $this->addChild($web);
        return $web;
    }
}