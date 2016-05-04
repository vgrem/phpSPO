<?php

namespace SharePoint\PHP\Client;


/**
 * List collection
 */
class ListCollection extends ClientObjectCollection
{
    /**
     * Get List by title
     */
    public function getByTitle($title)
    {
        return new SPList($this->getContext(),$this->getResourcePath(),"getbytitle('{$title}')");
    }

    public function getById($id)
    {
        return new SPList($this->getContext(),$this->getResourcePath(),"getbyid(guid'{$id}')");
    }


    /**
     * Creates a List resource
     * @param ListCreationInformation $parameters
     * @return SPList
     */
    public function add(ListCreationInformation $parameters)
    {
        /*$payload = array(
            'AllowContentTypes' => $parameters->AllowContentTypes,
            'BaseTemplate'=>  $parameters->BaseTemplate,
            'ContentTypesEnabled' => $parameters->ContentTypesEnabled,
            'Description' =>  $parameters->Description,
            'Title' => $parameters->Title
        );*/
        $list = new SPList($this->getContext());
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Create,$parameters);
        $this->getContext()->addQuery($qry,$list);
        $this->addChild($list);
        return $list;
    }
}