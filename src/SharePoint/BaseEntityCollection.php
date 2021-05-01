<?php


namespace Office365\SharePoint;


use Office365\Runtime\ClientObject;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class BaseEntityCollection extends ClientObjectCollection
{
    /**
     * @var ClientObject|null
     */
    private $parent;

    public function __construct(ClientRuntimeContext $ctx,
                                ResourcePath $resourcePath = null,
                                $itemTypeName = null,
                                ClientObject $parent=null)
    {
        parent::__construct($ctx, $resourcePath, null, $itemTypeName);
        $this->parent = $parent;
    }

    /**
     * @return ClientObject|null
     */
    public function getParent(){
        return $this->parent;
    }

}