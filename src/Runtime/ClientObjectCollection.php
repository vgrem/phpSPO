<?php

namespace Office365\PHP\Client\Runtime;

use Office365\PHP\Client\Runtime\OData\ODataQueryOptions;


/**
 * Client objects collection (represents EntitySet in terms of OData)
 */
class ClientObjectCollection extends ClientObject implements IEntityTypeCollection
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
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath, ODataQueryOptions $queryOptions = null)
    {
        parent::__construct($ctx, $resourcePath);
        $this->queryOptions = $queryOptions;
        if (!isset($this->queryOptions))
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
     * @param int $index
     */
    public function addChildAt(ClientObject $clientObject, $index )
    {
        array_splice($this->data,$index,0,[$clientObject]);
        if (is_null($clientObject->parentCollection))
            $clientObject->parentCollection = $this;
    }

    /**
     * Adds client object into collection
     * @param ClientObject $clientObject
     */
    public function addChild($clientObject)
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
     * Finds the first item
     * @param string $key
     * @param string $value
     * @return ClientObject|null
     */
    public function findFirst($key,$value)
    {
        $result = $this->findItems(
            function (ClientObject $item) use ($key, $value) {
                return $item->getProperty($key) === $value;
            });
        return (is_array($result) && (count($result) > 0) ? array_values($result)[0] : null);
    }


    /**
     * Finds items by entity property
     * @param callable $callback
     * @return array
     */
    public function findItems(callable $callback)
    {
        $result = array_filter(
            $this->data,
            function (ClientObject $item) use ($callback) {
                return call_user_func($callback, $item);
            }
        );
        if (count($result) > 0)
            return array_values($result);
        return null;
    }


    /**
     * Gets the item at the specified index
     * @param $index
     * @return ClientObject
     */
    public function getItem($index)
    {
        return $this->data[$index];
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
        $this->queryOptions->OrderBy = rawurlencode($value);
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
     * Sets the number of records to skip before it retrieves records in a collection.
     * @param $value
     * @return ClientObjectCollection $this
     */
    public function skiptoken($value)
    {
        $this->queryOptions->SkipToken = rawurlencode($value);
        return $this;
    }


    /**
     * Creates resource for a collection
     * @return ClientObject
     */
    public function createType()
    {
        $clientObjectType = $this->getItemTypeName();
        $clientObject = new $clientObjectType($this->getContext());
        $clientObject->parentCollection = $this;
        return $clientObject;
    }


    /**
     * @return string
     */
    /**
     * @return string
     */
    public function getItemTypeName()
    {
        return str_replace("Collection", "", get_class($this));
    }


   function getProperties($flag=SCHEMA_ALL_PROPERTIES)
   {
       return array_map(function (ClientObject $item) use ($flag) {
           return $item->getProperties($flag);
       }, $this->getData());
   }

}
