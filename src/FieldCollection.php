<?php
/**
 * Represents a collection of Field resources
 */

namespace SharePoint\PHP\Client;


class FieldCollection extends ClientObjectCollection
{
    public function getByTitle($title)
    {
        $resourcePath = $this->getResourcePath() . "/getbytitle('{$title}')";
        $field = new Field($this->getContext(),$resourcePath);
        return $field;
    }

    public function getByInternalNameOrTitle($internalNameOrTitle)
    {
        $resourcePath = $this->getResourcePath() . "/getbyinternalnameortitle('{$internalNameOrTitle}')";
        $field = new Field($this->getContext(),$resourcePath);
        return $field;
    }
}