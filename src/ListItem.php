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
        $qry = new ClientQuery($this->getUrl(),ClientActionType::Update,$listItemUpdationInformation);
        $qry->addResultObject($this);
        $this->getContext()->addQuery($qry);
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