<?php

namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\ClientActionDeleteEntity;
use Office365\PHP\Client\Runtime\ClientActionUpdateEntity;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;


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
        $qry = new ClientActionUpdateEntity($this);
        $this->getContext()->addQuery($qry,$this);
    }

    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }


    public function getEntityTypeName(){
        $list = $this->getParentList();
        if(!isset($this->resourceType)) {
            //determine whether ListItemEntityTypeFullName property has been requested
            if(!$list->isPropertyAvailable("ListItemEntityTypeFullName")){
                $request = new RequestOptions($list->getResourceUrl() . "?\$select=ListItemEntityTypeFullName");
                $response = $this->getContext()->executeQueryDirect($request);
                $this->getContext()->executeQueryForObject($response,$list);
            }
            $this->resourceType = $list->getProperty("ListItemEntityTypeFullName");
        }
        return $this->resourceType;
    }


    /**
     * @return AttachmentCollection
     */
    public function getAttachmentFiles(){
        if(!$this->isPropertyAvailable('AttachmentFiles')){
            $this->setProperty("AttachmentFiles", new AttachmentCollection($this->getContext(),new ResourcePathEntity($this->getContext(),$this->getResourcePath(), "AttachmentFiles")),false);
        }
        return $this->getProperty("AttachmentFiles");
    }

}