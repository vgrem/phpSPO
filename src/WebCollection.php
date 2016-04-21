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
        $web = new Web($this->getContext());
        $qry = new ClientQuery($this->getUrl() . "/add",ClientActionType::Create,$payload);
        $qry->addResultObject($web);
        $this->getContext()->addQuery($qry);
        $this->addChild($web);
        return $web;
    }
}