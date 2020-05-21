<?php

namespace Office365\Runtime;
use Exception;
use Generator;
use IteratorAggregate;
use Office365\Runtime\Http\RequestOptions;
use Office365\Runtime\OData\JsonLightFormat;
use Office365\Runtime\OData\ODataQueryOptions;
use Traversable;


/**
 * Client objects collection (represents EntitySet in terms of OData)
 */
class ClientObjectCollection extends ClientObject implements IteratorAggregate
{

    /**
     * @var array
     */
    private $data = null;

    /**
     * @var string|null
     */
    public $NextRequestUrl;


    /**
     * ClientObjectCollection constructor.
     * @param ClientRuntimeContext $ctx
     * @param ResourcePath $resourcePath
     * @param ODataQueryOptions $queryOptions
     */
    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ODataQueryOptions $queryOptions = null)
    {
        parent::__construct($ctx, $resourcePath, $queryOptions);
        $this->data = array();
        $this->NextRequestUrl = null;
    }


    /**
     * @return bool
     */
    function getServerObjectIsNull()
    {
        return !is_array($this->data);
    }

    function isPropertyAvailable($name)
    {
        return isset($this->data[$name]);
    }

    /**
     * Adds client object into collection
     * @param ClientObject $clientObject
     * @param int $index
     */
    public function addChildAt(ClientObject $clientObject, $index)
    {
        array_splice($this->data, $index, 0, [$clientObject]);
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
    public function findFirst($key, $value)
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
        $it = $this->getIterator();
        while($it->valid() ){
            $it->next();
        }
        return count($this->data);
    }


    public function clearData()
    {
        $this->data = array();
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
    public function getItemTypeName()
    {
        return str_replace("Collection", "", get_class($this));
    }


    /**
     * @return array
     */
    function toJson()
    {
        return array_map(function (ClientObject $item) {
            return $item->toJson();
        }, $this->getData());
    }


    /**
     * @param string|integer $index
     * @param mixed $value
     * @param bool $persistChanges
     */
    function setProperty($index, $value, $persistChanges = true)
    {
        if((is_int($index))){
            $itemType = $this->createType();
            foreach ($value as $k=>$v) {
                $itemType->setProperty($k, $v, $persistChanges);
            }
            $this->addChild($itemType);
        }
        else{
            parent::setProperty($index,$value,$persistChanges);
        }
    }


    /**
     * @return Generator|Traversable
     * @throws Exception
     */
    public function getIterator()
    {
        /** @var ClientObject $item */
        foreach ($this->data as $index => $item) {
            yield $index => $item;
        }

        if(is_null($this->queryOptions->Top) && !is_null($this->NextRequestUrl)){
            foreach ($this->getNextItems() as $item){
                $this->addChild($item);
                yield $item;
            }
        }
    }

    /**
     * @return ClientObjectCollection
     * @throws Exception
     */
    private function getNextItems(){
        $items = new ClientObjectCollection($this->context,$this->resourcePath);
        $request = new RequestOptions($this->NextRequestUrl);
        $response = $this->getContext()->executeQueryDirect($request);
        $payload = json_decode($response->getContent(), true);
        $this->getContext()->getPendingRequest()->mapJson($payload,$items,new JsonLightFormat());
        $this->NextRequestUrl = null;
        return $items;
    }

}
