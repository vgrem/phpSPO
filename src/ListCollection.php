<?php

namespace SharePoint\PHP\Client;


/**
 * List collection
 */
class ListCollection extends ClientObjectCollection
{
    /**
     * Get List by title
     *
     * @ResourceUri: /_api/lists/getbytitle('%s')
     *
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

    public function add(array $listCreationInformation)
    {
        $list = new SPList($this->getContext(),"/_api/web/lists",null,$listCreationInformation);
        $qry = new ClientQuery($list,ClientOperationType::Create);
        $this->getContext()->addQuery($qry);
        $this->addChild($list);
        return $list;
    }
}