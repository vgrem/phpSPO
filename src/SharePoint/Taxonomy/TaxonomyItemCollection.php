<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\ClientObjectCollection;
use Office365\Runtime\ClientRuntimeContext;
use Office365\Runtime\ResourcePath;

class TaxonomyItemCollection extends ClientObjectCollection
{

    /**
     * @var TaxonomyItem|null
     */
    private $parent;

    public function __construct(ClientRuntimeContext $ctx,
                                ResourcePath $resourcePath = null,
                                $itemTypeName = null,
                                TaxonomyItem $parent=null)
    {
        parent::__construct($ctx, $resourcePath, $itemTypeName);
        $this->parent = $parent;
    }


    /**
     * @return TaxonomyItem|null
     */
    public function getParent(){
        return $this->parent;
    }

}