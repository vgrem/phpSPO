<?php

namespace Office365\SharePoint;

use Office365\Runtime\ClientValueCollection;
use Office365\Runtime\ServerTypeInfo;

class FieldMultiLookupValue extends ClientValueCollection
{
    public function __construct($lookupIds)
    {
        parent::__construct(FieldLookupValue::class);
        foreach ($lookupIds as $lookupId) {
            $this->addChild(new FieldLookupValue($lookupId));
        }
    }


    public function toJson()
    {
        $lookupIds = array_map(function (FieldLookupValue $value) {
            return $value->LookupId;
        }, $this->getData());
        return array('results' => $lookupIds);
    }

    /**
     * @return ServerTypeInfo
     */
    public function getServerTypeInfo()
    {
        return ServerTypeInfo::primitive("integer", true);
    }

}