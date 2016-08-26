<?php

namespace Office365\PHP\Client\Runtime;
use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;


/**
 * Client objects collection
 */
abstract class ClientObjectCollection extends ClientObject
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
     * ClientObjectCollection constructor.
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath $resourcePath
     * @param ODataQueryOptions $queryOptions
     */
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ODataQueryOptions $queryOptions = null)
    {
        parent::__construct($ctx,$resourcePath);
        $this->queryOptions = $queryOptions;
        if(!isset($this->queryOptions))
            $this->queryOptions = new ODataQueryOptions();
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


    /**
     * Adds client object into collection
     * @param ClientObject $clientObject
     */
    public function addChild(ClientObject $clientObject)
    {
        $this->data[] = $clientObject;
        if (is_null($clientObject->parentCollection))
            $clientObject->parentCollection = $this;
    }

    /**
     * @param ClientObject $clientObject
     */
    public function removeChild(ClientObject $clientObject)
    {
        if (($key = array_search($clientObject, $this->data)) !== false) {
            unset($this->data[$key]);
        }
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
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
        return ($this->getCount() > 0);
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


    /**
     * Creates resource for a collection
     * @return ClientObject
     */
    public function createTypedObject()
    {
        $clientObjectType = $this->getItemTypeName();
        return new $clientObjectType($this->getContext(),$this->getResourcePath());
    }


    /**
     * @return string
     */
    /**
     * @return string
     */
    function getItemTypeName()
    {
        return str_replace("Collection","",get_class($this));
    }

}