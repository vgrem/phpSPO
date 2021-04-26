<?php


namespace Office365\Runtime\Http;


use Office365\Runtime\Auth\UserCredentials;

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
        $this->TransferEncodingChunkedAllowed = false;
        $this->FollowLocation = false;
        $this->IPResolve = null;
        $this->ForbidReuse = false;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }


    /**
     * @param string $name
     * @param string $value
     */
    public function ensureHeader($name, $value)
    {
        if (is_null($this->Headers)) {
            $this->Headers = array();
        }
        if (!array_key_exists($name, $this->Headers)) {
            $this->Headers[$name] = $value;
        }
    }


    /**
     * @return string[]
     */
    public function getRawHeaders()
    {
        return array_map(
            function ($k, $v) {
                return "$k:$v";
            },
            array_keys($this->Headers),
            array_values($this->Headers)
        );
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
     * Control which version range of SSL/TLS versions to use
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
     * It should contain the maximum time in seconds that you allow the connection phase to the server to take
     * @var ?int
     */
    public $ConnectTimeout;


    /**
     * @var bool
     */
    public $TransferEncodingChunkedAllowed;

    /**
     * tells the library to follow any Location: header that the server sends as part of an HTTP header
     * in a 3xx response. The Location: header can specify a relative or an absolute URL to follow.
     * @var bool
     */
    public $FollowLocation;

    /**
     * Whether to use prefer IPV4 of IPV6 addresses
     * @var bool
     */
    public $IPResolve;

    /**
     * Do we want connections to be re-used or not
     * @var bool
     */
    public $ForbidReuse;
}
