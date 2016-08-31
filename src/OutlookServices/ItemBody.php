<?php


namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientValueObject;

class ItemBody extends ClientValueObject
{

    function __construct($contentType,$content)
    {
        $this->ContentType = $contentType;
        $this->Content = $content;
        parent::__construct();
    }

    /**
     * @var string
     */
    public $ContentType;


    /**
     * @var string
     */
    public $Content;

}