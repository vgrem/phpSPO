<?php

namespace SharePoint\PHP\Client;
use SharePoint\PHP\Client\Runtime\ODataQueryOptions;

/**
 * Client objects collection
 */
class ClientObjectCollection extends ClientObject
{

    /**
     * @var ODataQueryOptions
     */
    protected $queryOptions;

    /**
     * @var array
     */
    private $data = array();

    /**
     * @var bool
     */
    protected $areItemsAvailable;


    /**
     * ClientObjectCollection constructor.
     * @param ClientContext $ctx
     * @param ResourcePath $resourcePath
     * @param ODataQueryOptions $queryOptions
     */
    public function __construct(ClientContext $ctx, ResourcePath $resourcePath = null, ODataQueryOptions $queryOptions = null)
    {
        parent::__construct($ctx,$resourcePath);
        $this->queryOptions = $queryOptions;
        if(!isset($this->queryOptions))
            $this->queryOptions = new ODataQueryOptions();
        $this->areItemsAvailable = false;
    }

    /**
     * @return string
     */
    public function getResourceUrl()
    {
        $url = parent::getResourceUrl();
        if (!$this->queryOptions->isEmpty())
            $url = $url . "?" . $this->queryOptions->toUrl();
        return $url;
    }


    public function addChild(ClientObject $clientObject)
    {
        $this->data[] = $clientObject;
        if (is_null($clientObject->parentCollection))
            $clientObject->parentCollection = $this;
    }

    public function removeChild(ClientObject $clientObject)
    {
        if (($key = array_search($clientObject, $this->data)) !== false) {
            unset($this->data[$key]);
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getCount()
    {
        return count($this->data);
    }
    

    public function clearData()
    {
        $this->data = array();
    }


    public function AreItemsAvailable()
    {
        return $this->areItemsAvailable;
    }

    /**
     * @return ODataQueryOptions
     */
    public function getQueryOptions()
    {
        return $this->queryOptions;
    }

    /**
     * Specifies a subset of properties to return.
     * @param $value
     * @return ClientObjectCollection $this
     */
    public function select($value)
    {
        $this->queryOptions->Select = $value;
        return $this;
    }

    /**
     * Specifies an expression or function that must evaluate to true for a record to be returned in the collection.
     * @param $value
     * @return ClientObjectCollection $this
     */
    public function filter($value)
    {
        $this->queryOptions->Filter = rawurlencode($value);
        return $this;
    }

    /**
     * Directs that related records should be retrieved in the record or collection being retrieved.
     * @param $value
     * @return ClientObjectCollection $this
     */
    public function expand($value)
    {
        $this->queryOptions->Expand = $value;
        return $this;
    }

    /**
     * Determines the maximum number of records to return.
     * @param $value
     * @return ClientObjectCollection $this
     */
    public function orderBy($value)
    {
        $this->queryOptions->OrderBy = $value;
        return $this;
    }

    /**
     * Determines the maximum number of records to return.
     * @param $value
     * @return ClientObjectCollection $this
     */
    public function top($value)
    {
        $this->queryOptions->Top = $value;
        return $this;
    }

    /**
     * Sets the number of records to skip before it retrieves records in a collection.
     * @param $value
     * @return ClientObjectCollection $this
     */
    public function skip($value)
    {
        $this->queryOptions->Skip = $value; 
        return $this;
    }
}