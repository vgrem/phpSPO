<?php


namespace Office365\OutlookServices;


use Office365\Runtime\ClientValue;


/**
 * The body content of a message or event.
 */
class ItemBody extends ClientValue
{

    function __construct($contentType,$content)
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
     * The text or HTML content.
     * @var string
     */
    public $Content;

}