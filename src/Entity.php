<?php

/**
 * Microsoft Graph entity
 */
namespace Office365;


use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\Actions\UpdateEntityQuery;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

/**
 * @method GraphServiceClient getContext()
 */
class Entity extends ClientObject
{

    public function __construct(ClientRuntimeContext $ctx, ResourcePath $resourcePath = null, $namespace = null)
    {
        parent::__construct($ctx, $resourcePath, null, $namespace);
    }

    /**
     * The recommended way to update resource
     * @return self
     */
    public function update()
    {
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQueryAndResultObject($qry, $this);
        return $this;
    }
    /**
     * The recommended way to delete resource
     * @return self
     */
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
        $this->removeFromParentCollection();
        return $this;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->getProperty("Id");
    }


    /**
     * @param string $name
     * @param mixed $value
     * @param bool $persistChanges
     * @return self
     */
    function setProperty($name, $value, $persistChanges = true)
    {
        $name = ucfirst($name);
        if($name == "Id"){
            if (is_null($this->getResourcePath())) {
                $this->resourcePath = new ResourcePath($value, $this->parentCollection->getResourcePath());
            }
        }
        parent::setProperty($name, $value, $persistChanges);
        return $this;
    }


}
