<?php


namespace Office365\Runtime;

/**
 * Resource path for OneDrive path-based addressing
 */
class ResourcePathUrl extends ResourcePath
{
    public function __construct($url, ResourcePath $parent = null)
    {
        parent::__construct($url, $parent);
    }

    /**
     * @return string[]
     */
    public function getSegments()
    {
        return [":/", rawurlencode($this->getName()), ":/"];
    }

}