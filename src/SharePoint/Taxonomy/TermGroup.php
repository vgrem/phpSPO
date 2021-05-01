<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\ResourcePath;

class TermGroup extends TaxonomyItem
{

    /**
     * @return TaxonomyItemCollection
     */
    public function getTermSets(){
        if (!$this->isPropertyAvailable("termSets")) {
            $this->setProperty("termSets", new TaxonomyItemCollection($this->getContext(),
                new ResourcePath("termSets", $this->getResourcePath()),TermSet::class,$this));
        }
        return $this->getProperty("termSets");
    }

}