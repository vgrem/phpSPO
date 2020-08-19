<?php


namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;

class SPResourcePath extends ClientValue
{

    /**
     * @param string $decodedUrl
     * @param string|null $typeName
     */
    public function __construct($decodedUrl,$typeName = null)
    {
        $this->DecodedUrl = $decodedUrl;
        parent::__construct($typeName);
    }

    /**
     * @var string
     */
    public $DecodedUrl;

}