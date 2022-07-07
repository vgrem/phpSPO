<?php

namespace Office365\SharePoint\Internal\Paths;


use Office365\Runtime\ResourcePath;


class FileContentPath extends ResourcePath
{
    /***
     * @param ResourcePath|null $parent
     */
    public function __construct(ResourcePath $parent = null)
    {
        parent::__construct("\$value", $parent);
    }


}