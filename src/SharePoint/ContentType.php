<?php


namespace SharePoint\PHP\Client;

use SharePoint\PHP\Client\Runtime\ODataFormat;

class ContentType extends ClientObject
{


    function convertToEntity($itemPayload, ODataFormat $format)
    {
        parent::convertToEntity($itemPayload, $format);
        if (property_exists($itemPayload, "StringId")) {
            $this->resourcePath = ResourcePath::parse(
                $this->getContext(),
                $this->resourcePath->toUrl() . "('{$itemPayload->StringId}')");
        }
    }

    /**
     * Deletes Content Type resource
     */
    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }





}