<?php
/**
 * Represents a collection of Field resources
 */

namespace SharePoint\PHP\Client;


class FieldCollection extends ClientObjectCollection
{
    public function getByTitle($title)
    {
        return new Field($this->getContext(),$this->getResourcePath(),"getbytitle('{$title}')");
    }

    public function getByInternalNameOrTitle($internalNameOrTitle)
    {
        return new Field($this->getContext(),$this->getResourcePath(),"getbyinternalnameortitle('{$internalNameOrTitle}')");
    }
}