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
        $resoursePath = sprintf("/_api/lists/getbytitle('%s')",$title);
        $list = new SPList($this->getContext(),$resoursePath);
        return $list;
    }

    public function getById($id)
    {
        throw new \Exception("Not implemented");
    }
}