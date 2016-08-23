<?php


namespace Office365\PHP\Client\Runtime\Utilities;



class RequestOptions
{


    /**
     * RequestOptions constructor.
     * @param $url string
     * @param array $headers
     * @param string $data
     */
    public function __construct($url,$headers=array(),$data=null)
    {
        $this->Url = $url;
        $this->PostMethod = is_null($data) ?  false : true;
        $this->Headers = $headers;
        $this->IncludeBody = true;
        $this->IncludeHeaders = false;
        $this->AuthType = null;
        $this->UserCredentials = null;
        $this->Verbose = false;
        $this->SSLVersion = null;
    }


    public function addCustomHeader($name, $value)
    {
        if (!array_key_exists($name, $this->Headers))
            $this->Headers[$name] = $value;
    }

    public function getRawHeaders()
    {
        $headers = array_map(
            function ($k, $v) {
                return "$k:$v";
            },
            array_keys($this->Headers),
            array_values($this->Headers)
        );
        return $headers;
    }


    /**
     * @var string
     */
    public $Url;


    /**
     * @var bool
     */
    public $PostMethod;

    /**
     * Gets/sets custom HTTP headers
     * @var array
     */
    public $Headers;


    /**
     * @var string
     */
    public $Data;

    /**
     * Gets/sets whether to return response headers only
     * @var bool
     */
    public $IncludeHeaders;



    /**
     * Do the download request without getting the body
     * @var bool
     */
     public $IncludeBody;


    /**
     * @var int
     */
    public $AuthType;


    /**
     * @var UserCredentials
     */
    public $UserCredentials;


    /**
     * @var bool
     */
    public $Verbose;


    /**
     * @var int
     */
    public $SSLVersion;

}