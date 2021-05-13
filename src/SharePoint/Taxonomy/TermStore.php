<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\ResourcePath;

class TermStore extends TaxonomyItem
{

    /**
     * @return TaxonomyItemCollection
     */
    public function getTermGroups(){
        return $this->getProperty("termGroups",
            new TaxonomyItemCollection($this->getContext(),
                new ResourcePath("termGroups", $this->getResourcePath()),TermGroup::class,$this));
    }

}