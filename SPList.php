<?php

/**
 * SharePoint List client object
 */
class SPList
{
    /**
     * SPO Rest client  
     * @var mixed
     */
    public $service;
    
    
    /**
     * Name of the SharePoint list
     * @var string
     */
    public $name;
    
    /**
     * Class constructor
     * @param mixed $service 
     * @param string $name 
     */
    public function __construct($service,$name)
    {
        $this->service = $service;
        $this->name = $name;
    }
    
    /**
     * Get Single List Item
     * @return mixed
     */
    public function getItem($id)
    {
        $options = array(
          'list' => $this->name,
          'id' => $id,
          'method' => 'GET'
       );
       $data = $this->service->requestList($options);
       return $data->d; 
    }      
    
    /**
     * Get List Item(s)
     * @return mixed
     */
    public function getItems()
    {
        $options = array(
          'list' => $this->name,
          'method' => 'GET'
       );
       $data = $this->service->requestList($options);
       return $data->d->results; 
    }
    
    /**
     * Update List Item operation
     * @param integer $id 
     * @param array $itemProperties 
     */
    public function updateItem($id,$itemProperties)
    {
        $itemProperties['__metadata'] = array('type' => $this->getListItemEntityType());  //append entity metadata type
        $options = array(
         'list' => $this->name,
         'id' => $id,
         'data' => $itemProperties,
         'method' => 'POST',
         'xhttpmethod' => 'MERGE',
         'formdigest' => $this->service->formDigest,
         'etag' => '*'
        );
        $data = $this->service->requestList($options);
    }
    
    /**
     * Delete List Item
     * @param Integer $id 
     */
    public function deleteItem($id)
    {
        $options = array(
         'list' => $this->name,
         'id' => $id,
         'method' => 'POST',
         'xhttpmethod' => 'DELETE',
         'formdigest' => $this->service->formDigest,
         'etag' => '*'
        );
        $this->service->requestList($options);
    }
    
    /**
     * Add List Item
     * @param array $itemProperties 
     */
    public function addItem($itemProperties)
    {
        $itemProperties['__metadata'] = array('type' => $this->getListItemEntityType());  //append entity metadata type
        $options = array(
         'list' => $this->name,
         'data' => $itemProperties,
         'method' => 'POST',
         'formdigest' => $this->service->formDigest
        );
        $data = $this->service->requestList($options);
        return $data->d;
    }
    
    /**
     * Resolve ListItem entity type
     * @return string
     */
    private function getListItemEntityType()
    {
        return 'SP.Data.' . $this->name . 'ListItem';
    }
}
