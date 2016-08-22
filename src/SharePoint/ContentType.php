<?php

namespace SharePoint\PHP\Client;


class ContentType extends ClientObject
{

    /**
     * Deletes Content Type resource
     */
    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }



    function setProperty($name, $value, $persistChanges = true)
    {
        parent::setProperty($name, $value, $persistChanges);
        if ($name == "StringId") {
            $this->setResourceUrl($this->resourcePath->toUrl() . "('{$value}')");
        }
    }


}