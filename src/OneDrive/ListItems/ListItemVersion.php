<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive\ListItems;


use Office365\OneDrive\BaseItemVersion;
use Office365\OneDrive\FieldValueSet;
use Office365\Runtime\ResourcePath;
class ListItemVersion extends BaseItemVersion
{
    /**
     * @return FieldValueSet
     */
    public function getFields()
    {
        return $this->getProperty("Fields",
            new FieldValueSet($this->getContext(), new ResourcePath("Fields", $this->getResourcePath())));
    }
}