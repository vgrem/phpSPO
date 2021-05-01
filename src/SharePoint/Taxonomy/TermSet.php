<?php


namespace Office365\SharePoint\Taxonomy;

use Office365\Runtime\ResourcePath;

class TermSet extends TaxonomyItem
{

    /**
     * @return TaxonomyItemCollection
     */
    public function getTerms(){
        if (!$this->isPropertyAvailable("terms")) {
            $this->setProperty("terms", new TaxonomyItemCollection($this->getContext(),
                new ResourcePath("terms", $this->getResourcePath()),Term::class, $this));
        }
        return $this->getProperty("terms");
    }

}