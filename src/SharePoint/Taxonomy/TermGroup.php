<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\ResourcePath;

class TermGroup extends TaxonomyItem
{

    /**
     * @return TaxonomyItemCollection
     */
    public function getTermSets(){
        return $this->getProperty("termSets",
            new TaxonomyItemCollection($this->getContext(),
                new ResourcePath("termSets", $this->getResourcePath()),TermSet::class,$this));
    }

    /**
     * @return string|null
     */
    public function getName(){
        return $this->getProperty("name");
    }

}