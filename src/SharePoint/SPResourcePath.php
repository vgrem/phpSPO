<?php


namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;

class SPResourcePath extends ClientValue
{

    /**
     * @param string $decodedUrl
     */
    public function __construct($decodedUrl=null)
    {
        $this->DecodedUrl = $decodedUrl;
        parent::__construct();
    }

    /**
     * @var string
     */
    public $DecodedUrl;

}