<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Runtime\ClientValue;
class ItemBody extends ClientValue
{

    function __construct($contentType=null,$content=null)
    {
        $this->ContentType = $contentType;
        $this->Content = $content;
        parent::__construct();
    }

    /**
     * The content type: Text = 0, HTML = 1.
     * @var string
     */
    public $ContentType;


    /**
     * @var string
     */
    public $Content;


    public function setProperty($name, $value)
    {
        $name = ucfirst($name);
        parent::setProperty($name, $value);
    }
}