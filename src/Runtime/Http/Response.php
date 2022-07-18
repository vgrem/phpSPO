<?php


namespace Office365\Runtime\Http;


class Response
{
    public function __construct($content, $headers)
    {
        $this->Content = $content;
        $this->StatusCode = $headers['HttpCode'];
        // validate the individual responses,
        // so we can catch an instance where there is an unauthorized response.
        $this->validate();
    }

    public function getHeaders()
    {
        if (!empty($this->Headers)) {
            return $this->Headers;
        }
        $lines = array_map(function ($line) {
            return $line;
        }, explode("\r\n", $this->getContent()));
        $this->Headers = [];

        foreach ($lines as $line){
            if($line != ""){
                list($k, $v) = preg_split("/[ :]/", $line,2);
                $this->Headers[$k] = $v;
            }
        }
        return $this->Headers;
    }


    /**
     *
     * @throws RequestException
     */
    public function validate(){
        if ($this->StatusCode >= 400) {
            $headers = $this->getHeaders();
            $content = $this->Content;
            if (array_key_exists('Content-Length', $headers) && trim($headers['Content-Length']) == '0') {
                if (array_key_exists('X-MSDAVEXT_Error', $headers)) {
                    $this->Content = urldecode($headers['X-MSDAVEXT_Error']);
                }
                throw new RequestException($this->Content,$this->StatusCode);
            }
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

    /**
     * @var array The parsed headers.
     */
     protected $Headers = [];

}
