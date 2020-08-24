<?php

namespace Office365\SharePoint;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\OData\ODataQueryOptions;
use Office365\Runtime\ResourcePath;


/**
 * Web client object collection
 *
 */
class WebCollection extends ClientObjectCollection
{

    /**
     * @var string|null
     */
    private $parentWebUrl;

    public function __construct(ClientRuntimeContext $ctx,
                                ResourcePath $resourcePath = null,
                                ODataQueryOptions $queryOptions = null,
                                $parentWebUrl=Null)
    {
        parent::__construct($ctx, $resourcePath, $queryOptions);
        $this->parentWebUrl = $parentWebUrl;
    }

    /**
     * @param WebCreationInformation $webCreationInformation
     * @return Web
     */
    public function add(WebCreationInformation $webCreationInformation)
    {
        $web = new Web($this->getContext(), $this->getResourcePath()->getParent());
        $qry = new InvokePostMethodQuery(
            $this,
            "Add",
            null,
            "parameters",
            $webCreationInformation
        );
        $this->getContext()->addQueryAndResultObject($qry,$web);
        $this->addChild($web);
        return $web;
    }


    function getResourceUrl()
    {
        return parent::getResourceUrl();
    }
}