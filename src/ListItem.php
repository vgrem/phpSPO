<?php

namespace SharePoint\PHP\Client;

/**
 * ListItem client object
 * @property SPList ParentList
 */
class ListItem extends ClientObject
{

    /**
     * Gets the parent list that contains the list item.
     * @return SPList
     * @throws \Exception
     */
    public function getParentList(){
        if(!$this->isPropertyAvailable('ParentList')){
            $this->ParentList = new SPList($this->getContext(),$this->getResourcePath(), "parentlist");
        }
        return $this->ParentList;
    }
    
    /**
     * Updates list item resource
     * @param $listItemUpdationInformation
     */
    public function update($listItemUpdationInformation)
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Update,$listItemUpdationInformation);
        $this->getContext()->addQuery($qry,$this);
    }

    public function deleteObject()
    {
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Delete);
        $this->getContext()->addQuery($qry);
    }


    public function getEntityTypeName(){
        $list = $this->getParentList();
        $options = array(
            'url' => $list->getUrl() . "?\$select=ListItemEntityTypeFullName",
            'method' => 'GET'
        );
        $result = $this->getContext()->getPendingRequest()->executeQueryDirect($options);
        $json = json_decode($result);
        return $json->d->ListItemEntityTypeFullName;
    }
}