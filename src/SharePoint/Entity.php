<?php


namespace Office365\SharePoint;


use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\Actions\UpdateEntityQuery;

class Entity extends BaseEntity
{

    /**
     * The recommended way to update SharePoint resource is to send a UPDATE request to the resource endpoint
     * @return $this
     */
    public function update()
    {
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQueryAndResultObject($qry, $this);
        return $this;
    }
    /**
     * The recommended way to delete SharePoint resource is to send a DELETE request to the resource endpoint
     * @return $this
     */
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
        $this->removeFromParentCollection();
        return $this;
    }

}