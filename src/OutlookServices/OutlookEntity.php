<?php


namespace Office365\OutlookServices;


use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\OData\ODataQueryOptions;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
use Office365\Runtime\ClientObject;
use ReflectionObject;
use ReflectionProperty;

class OutlookEntity extends ClientObject
{

    /**
     * @var string
     */
    private $namespaceName;

    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, ODataQueryOptions $queryOptions = null)
    {
        $this->namespaceName = "Microsoft.OutlookServices";
        parent::__construct($ctx, $resourcePath, $queryOptions);
    }

    /**
     * @return OutlookClient
     */
    public function getContext()
    {
        if($this->context instanceof OutlookClient)
            return $this->context;
        return null;
    }


    /**
     * Updates a resource
     */
    public function update()
    {
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Deletes a resource
     */
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }


    /**
     * @return array
     */
    function toJson()
    {
        $json = array();
        $reflection = new ReflectionObject($this);
        foreach ($reflection->getProperties(ReflectionProperty::IS_PUBLIC) as $p) {
            $val = $p->getValue($this);
            if (!is_null($val) && !empty($val)) {
                $json[$p->name] = $val;
            }
        }
        return $json;
    }


    function setProperty($name, $value, $persistChanges = true)
    {
        $normalizedName = ucfirst($name);
        if ($normalizedName == "Id" && is_null($this->getResourcePath())) {
            $this->resourcePath = new ResourcePath($value,$this->parentCollection->getResourcePath());
        }
        parent::setProperty($normalizedName, $value, $persistChanges);
    }


    /**
     * @return string
     */
    function getServerTypeName()
    {
        return $this->namespaceName . "." . parent::getServerTypeName();
    }


    /**
     * @var string
     */
    public $Id;


}
