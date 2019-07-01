<?php


namespace Office365\PHP\Client\Runtime\Utilities;

use Office365\PHP\Client\Runtime\HttpMethod;

class RequestOptions
{


    /**
     * RequestOptions constructor.
     * @param $url string
     * @param array $headers
     * @param string $data
     * @param string $methodType
     */
    public function __construct($url, $headers = array(), $data = null, $methodType = HttpMethod::Get)
    {
        $this->Url = $url;
        $this->Method = $methodType;
        $this->Headers = $headers;
        $this->IncludeBody = true;
        $this->IncludeHeaders = false;
        $this->AuthType = null;
        $this->UserCredentials = null;
        $this->Verbose = false;
        $this->SSLVersion = null;
        $this->StreamHandle = null;
        $this->Data = $data;
        $this->ConnectTimeout = null;
    }

    public function toArray()
    {
        return get_object_vars($this);
    }

    public function addCustomHeader($name, $value)
    {
        if (is_null($this->Headers)) {
            $this->Headers = array();
        }
        if (!array_key_exists($name, $this->Headers)) {
            $this->Headers[$name] = $value;
        }
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
     * @var string
     */
    public $Method;

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
     * Do the request without getting the response
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


    /**
     * @var resource
     */
    public $StreamHandle;


    /**
     * @var string
     */
    public $Proxy;


    /**
     * @var ?int
     */
    public $ConnectTimeout;
}
