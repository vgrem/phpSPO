<?php


namespace Office365\PHP\Client\Runtime\Http;


class Response
{
    public function __construct($content, $headers)
    {
        $this->Content = $content;
        $this->StatusCode = $headers['HttpCode'];
    }

    public function getStatusCode()
    {
        return $this->StatusCode;
    }

    public function getContent(){
        return $this->Content;
    }


    /**
     * @var integer
     */
    protected $StatusCode;


    /**
     * @var mixed
     */
    protected $Content;

}
