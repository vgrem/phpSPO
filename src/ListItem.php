<?php

namespace SharePoint\PHP\Client;

/**
 * ListItem client object
 */
class ListItem extends ClientObject
{

    

    /**
     * Gets the parent list that contains the list item.
     * @return SPList
     * @throws \Exception
     */
    public function getParentList(){
        if(!isset($this->ParentList)){
            $this->ParentList = new SPList($this->getContext(),$this->getResourcePath() . "/parentlist");
        }
        return $this->ParentList;
    }

    /**
     * Sets the parent list that contains the list item.
     * @param SPList $list
     */
    public function setParentList(SPList $list){
        $this->ParentList = $list;
    }

    /**
     * Updates list item resource
     * @param $listItemUpdationInformation
     */
    public function update($listItemUpdationInformation)
    {
        $this->payload = $listItemUpdationInformation;
        $qry = new ClientQuery($this,ClientOperationType::Update);
        $this->getContext()->addQuery($qry);
    }

    public function deleteObject()
    {
        $qry = new ClientQuery($this,ClientOperationType::Delete);
        $this->getContext()->addQuery($qry);
    }


    public function getEntityTypeName(){
        $list = $this->getParentList();
        $options = array(
            'url' => $this->getContext()->getUrl() . $list->getResourcePath() . "?\$select=ListItemEntityTypeFullName",
            'method' => 'GET'
        );
        $result = $this->getContext()->getPendingRequest()->executeQueryDirect($options);
        $json = json_decode($result);
        return $json->d->ListItemEntityTypeFullName;
    }
}