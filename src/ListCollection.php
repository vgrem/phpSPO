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
        $resourcePath = "/_api/lists/getbytitle('{$title}')";
        $list = new SPList($this->getContext(),$resourcePath);
        return $list;
    }

    public function getById($id)
    {
        $resourcePath = "/_api/lists/getbyid(guid'{$id}')";
        $list = new SPList($this->getContext(),$resourcePath);
        return $list;
    }


    /**
     * Creates a List resource
     * @param ListCreationInformation $parameters
     * @return SPList
     */
    public function add(ListCreationInformation $parameters)
    {
        $payload = array(
            'AllowContentTypes' => $parameters->AllowContentTypes,
            'BaseTemplate'=>  $parameters->BaseTemplate,
            'ContentTypesEnabled' => $parameters->ContentTypesEnabled,
            'Description' =>  $parameters->Description,
            'Title' => $parameters->Title
        );
        $list = new SPList($this->getContext(),"/_api/web",null,$payload);
        $qry = new ClientQuery($list,ClientOperationType::Create,"/lists");
        $this->getContext()->addQuery($qry);
        $this->addChild($list);
        return $list;
    }
}