<?php


namespace Office365\Runtime\Http;


class Response
{
    public function __construct($content, $curlInfo, RequestOptions $requestOptions)
    {
        $this->Content = $content;
        $this->CurlInfo = $curlInfo;
        $this->RequestOptions = $requestOptions;

        // validate the individual responses,
        // so we can catch an instance where there is an unauthorized response.
        $this->validate();
    }

    /**
     * returns a Array including all response headers of
     * this request. when RequestOptions::IncludeHeaders was not
     * set to true this will be empty.
     * @return Array
     */
    public function getHeaders()
    {
        if (!empty($this->Headers)) {
            return $this->Headers;
        }

        // Headers where not included into the response.
        if (!$this->RequestOptions->IncludeHeaders) {
            return [];
        }

        $endOfHeaderPos = strpos($this->Content, "\r\n\r\n");

        $lines = [];
        if ($endOfHeaderPos === false) {
            $lines = explode("\r\n", $this->Content);
        } else {
            $lines = explode("\r\n", substr($this->Content, 0, $endOfHeaderPos));
        }

        $this->Headers = [];
        foreach ($lines as $line){
            if($line){
                list($k, $v) = preg_split("/[ :]/", $line, 2);
                $this->Headers[strtolower(trim($k))] = trim($v);
            }
        }
        return $this->Headers;
    }

    /**
     * Returns a specific response header or null when he was not set.
     * @param String $key
     * @return String|null
     */
    public function getHeader($key) {
        $headers = $this->getHeaders();
        return $headers[strtolower($key)] ?? null;
    }

    /**
     * Returns the body of the response without the header part.
     * @return String
     */
    public function getBody() {
        if ($this->RequestOptions->IncludeHeaders) {

            // return body without header
            $endOfHeaderPos = strpos($this->getContent(), "\r\n\r\n");
            if ($endOfHeaderPos !== false) {
                return substr($this->getContent(), $endOfHeaderPos + 4);
            }
        }

        return $this->getContent();
    }


    /**
     *
     * @throws RequestException
     */
    public function validate()
    {
        if ($this->getStatusCode() >= 400) {
            if ($this->getHeader('Content-Length') !== null && (int)$this->getHeader('Content-Length') === 0) {
                if ($this->getHeader('X-MSDAVEXT_Error')) {
                    $this->Content = urldecode($this->getHeader('X-MSDAVEXT_Error'));
                }
                throw new RequestException($this->Content, $this->getStatusCode());
            }
        }
    }

    /**
     * returns the Content-Type of the response or null when not provided.
     * @return String|null
     */
    public function getContentType()
    {
        return $this->CurlInfo['content_type'] ?? null;
    }

    /**
     * returns the array of curl_getinfo.
     * Check https://www.php.net/manual/function.curl-getinfo.php for the available keys.
     * @return Array
     */
    public function getCurlInfo()
    {
        return $this->CurlInfo ?? array();
    }

    /**
     * returns the HTTP status code of the response
     * @return Int|null
     */
    public function getStatusCode()
    {
        return isset($this->CurlInfo['http_code']) ? (int)$this->CurlInfo['http_code'] : null;
    }

    /**
     * returns the RequestOptions object which was used to perform the request.
     * @return RequestOptions
     */
    public function getRequestOptions()
    {
        return $this->RequestOptions;
    }

    /**
     * returns the content of the response. When IncludeHeaders was set to true
     * this will contain header and body.
     * @return String
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * @var RequestOptions
     */
    protected $RequestOptions;

    /**
     * @var Array
     */
    protected $CurlInfo;

    /**
     * @var mixed
     */
    protected $Content;

    /**
     * @var array The parsed headers.
     */
     protected $Headers = [];

}
