<?php


namespace Office365\SharePoint\Taxonomy;

use Office365\Runtime\ResourcePath;

class TermSet extends TaxonomyItem
{

    /**
     * @return TaxonomyItemCollection
     */
    public function getTerms(){
        return $this->getProperty("terms",
            new TaxonomyItemCollection($this->getContext(),
                new ResourcePath("terms", $this->getResourcePath()),Term::class, $this));
    }

}