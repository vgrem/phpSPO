<?php

namespace SharePoint\PHP\Client;

/**
 * ListItem client object
 */
class ListItem extends SecurableObject
{

    /**
     * Gets the parent list that contains the list item.
     * @return SPList
     * @throws \Exception
     */
    public function getParentList(){
        if(!$this->isPropertyAvailable('ParentList')){
            $this->setProperty("ParentList", new SPList($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "parentlist")),false);
        }
        return $this->getProperty("ParentList");
    }

    /**
     * Updates list item resource
     */
    public function update()
    {
        $qry = new ClientActionUpdateEntity($this->getResourceUrl(),$this->toJson());
        $this->getContext()->addQuery($qry,$this);
    }

    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this->getResourceUrl());
        $this->getContext()->addQuery($qry);
    }


    public function getEntityTypeName(){
        $list = $this->getParentList();
        if(!isset($this->resourceType)) {
            //determine entity type from List resource ListItemEntityTypeFullName property
            if(!$list->isPropertyAvailable("ListItemEntityTypeFullName")){
                $this->getContext()->load($list);
                $this->getContext()->executeQuery();
            }
            $this->resourceType = $list->getProperty("ListItemEntityTypeFullName");
        }
        return $this->resourceType;
    }

}