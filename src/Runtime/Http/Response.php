<?php


namespace Office365\Runtime\Http;


class Response
{
    public function __construct($content, $headers)
    {
        $this->Content = $content;
        $this->StatusCode = $headers['HttpCode'];
    }

    /**
     *
     * @throws RequestException
     */
    public function validate(){
        if ($this->StatusCode >= 400) {
            throw new RequestException($this->Content,$this->StatusCode);
        }
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
