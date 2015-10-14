<?php
namespace VGrem\phpSPO;

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
    public function __construct(SPOClient $service, $name)
    {
        $this->service = $service;
        $this->name = $name;
    }

    /**
     * Add List Item
     * @param array $itemProperties
     */
    public function addItem(array $itemProperties)
    {
        //append entity metadata type
        if (!isset($itemProperties['__metadata'])) {
            $itemProperties['__metadata'] = array('type' => $this->getListItemEntityType());
        }

        $options = array(
           'list' => $this->name,
           'data' => $itemProperties,
           'method' => 'POST',
           'formdigest' => $this->service->formDigest
        );

        $data = $this->service->requestList($options);

        // Unknown error
        if (!isset($data->d)) {
            throw new \RuntimeException("Can't add an item. Unknown Error");
        }

        return $data->d;
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
     * Get List Item(s) by Properties
     * @param array $query
     */

    public function getItemsByQuery($query)
    {
        $options = array(
            'list' => $this->name,
            'query' => $query,
            'method' => 'GET'
        );

        $data = $this->service->requestList($options);
        return $data->d->results;
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
    public function updateItem($id, $itemProperties)
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
     * Resolve ListItem entity type
     * @return string
     */
    private function getListItemEntityType()
    {
        $encName = HttpUtilities::xmlEncode($this->name);
        return 'SP.Data.' . $encName . 'ListItem';
    }
}
