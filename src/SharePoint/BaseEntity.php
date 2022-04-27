<?php


namespace Office365\SharePoint;

use Office365\Runtime\Auth\ClientCredential;
use Office365\Runtime\Auth\UserCredentials;
use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\OData\ODataQueryOptions;
use Office365\Runtime\Paths\EntityPath;
use Office365\Runtime\ResourcePath;

/**
 * SharePoint specific entity
 * @method ClientContext getContext()
 */
class BaseEntity extends ClientObject
{

    public function __construct(ClientRuntimeContext $ctx,
                                ResourcePath $resourcePath = null,
                                ODataQueryOptions $queryOptions = null)
    {
        parent::__construct($ctx,$resourcePath,$queryOptions,"SP");
    }


    /**
     * @param ClientCredential|UserCredentials $credentials
     * @return $this
     */
    public function withCredentials($credentials)
    {
        $this->getContext()->withCredentials($credentials);
        return $this;
    }


    /**
     * @param string $name
     * @param mixed $value
     * @param bool $persistChanges
     * @return self
     */
    public function setProperty($name, $value, $persistChanges = true)
    {
        //fallback: determine entity by Id
        if ($name === "Id") {
            if (is_null($this->getResourcePath())) {
                $this->resourcePath = new EntityPath($value, $this->getParentCollection()->getResourcePath());
            }
        }
        parent::setProperty($name, $value, $persistChanges);
        return $this;
    }

}