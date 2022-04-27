<?php


namespace Office365\SharePoint\Taxonomy;


use Office365\Runtime\ClientValueCollection;
use Office365\Runtime\ServerTypeInfo;

class TaxonomyFieldValueCollection extends ClientValueCollection
{

    public function __construct($values)
    {
        parent::__construct(TaxonomyFieldValue::class);
        foreach ($values as $value)
            $this->addChild($value);
    }

    public function __toString()
    {
        return implode(';#', $this->getData());
    }

    public function getServerTypeInfo()
    {
        return null;
    }

}