<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\ResourcePath;

class TermStore extends TaxonomyItem
{

    /**
     * @return TaxonomyItemCollection
     */
    public function getTermGroups(){
        if (!$this->isPropertyAvailable("termGroups")) {
            $this->setProperty("termGroups", new TaxonomyItemCollection($this->getContext(),
                new ResourcePath("termGroups", $this->getResourcePath()),TermGroup::class,$this));
        }
        return $this->getProperty("termGroups");
    }

}