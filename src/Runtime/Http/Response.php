<?php


namespace Office365\Runtime\Http;


class Response
{
    public function __construct($content, $headers)
    {
        $this->Content = $content;
        $this->StatusCode = $headers['HttpCode'];
    }

    public function getHeaders()
    {
        $lines = array_map(function ($line) {
            return $line;
        }, explode("\r\n", $this->getContent()));
        $result = array();
        foreach ($lines as $line){
            if($line != ""){
                list($k, $v) = preg_split("/[ :]/", $line,2);
                $result[$k] = $v;
            }
        }
        return $result;
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
