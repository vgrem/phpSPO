<?php
namespace Office365\Runtime\Http;


class Requests
{

	private static $defaultOptions = array(
			CURLOPT_SSL_VERIFYHOST => false,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true,
	);

    /**
     * @param RequestOptions $options
     * @param array $headers
     * @return Response
     * @throws RequestException
     */
	public static function execute(RequestOptions $options, &$headers = array())
	{
		$ch = Requests::init($options);
        $response = curl_exec($ch);
        $headers["HttpCode"] = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headers["ContentType"] = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
        if ($response === false) {
            throw new RequestException(curl_error($ch), curl_errno($ch));
        }
        curl_close($ch);
		return new Response($response,$headers);
	}


    /**
     * @param string $url
     * @param array $headers
     * @return Response
     * @throws RequestException
     */
    public static function get($url,$headers)
    {
        $options = new RequestOptions($url);
        $options->Headers = $headers;
        return Requests::execute($options);
    }

    /**
     * @param $url
     * @param $headers
     * @param bool $includeBody
     * @return Response
     * @throws RequestException
     */
    public static function head($url,$headers,$includeBody = false)
    {
        $options = new RequestOptions($url);
        $options->IncludeHeaders = true;
        $options->IncludeBody = $includeBody;
        $options->Headers = $headers;
        return Requests::execute($options);
    }


    /**
     * @param $url
     * @param $headers
     * @param $data
     * @param bool $includeHeaders
     * @return Response
     * @throws RequestException
     */
    public static function post($url, $headers, $data, $includeHeaders = false)
    {
        $options = new RequestOptions($url);
        $options->Method = HttpMethod::Post;
        $options->Headers = $headers;
        $options->Data = $data;
        $options->IncludeHeaders = $includeHeaders;
        return Requests::execute($options);
    }


	/**
	 * Parse cookies (http://stackoverflow.com/a/895858/1375553)
	 * @param $response
	 * @return array
	 */
    public static function parseCookies($response)
    {
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $response, $matches);
        $cookies = array();
        foreach($matches[1] as $item) {
            list($k, $v) = explode('=', $item,2);
            $cookies[$k] = $v;
        }
        return $cookies;
    }


    /**
     * Init Curl with the default parameters
     * @param RequestOptions $options
     * @return resource [type]    [description]
     */
    private static function init(RequestOptions $options)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $options->Url);
        curl_setopt_array($ch, self::$defaultOptions);  //default options
        //include headers in response
        curl_setopt($ch, CURLOPT_HEADER, $options->IncludeHeaders);
        //include body in response
        curl_setopt($ch, CURLOPT_NOBODY, !$options->IncludeBody);
        //set re-use policy
        curl_setopt($ch, CURLOPT_FORBID_REUSE, $options->ForbidReuse);
        //Set method
        if($options->Method === HttpMethod::Post) {
           curl_setopt($ch, CURLOPT_POST, 1);
           //if true, add the "Transfer-Encoding: chunked" HTTP header if the "Content-Length" header is absent.
           if ($options->TransferEncodingChunkedAllowed && !array_key_exists('Content-Length', $options->Headers)) {
              $options->ensureHeader("Transfer-Encoding", "chunked");
           }
        } else if($options->Method == HttpMethod::Patch) {
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $options->Method);
        } else if($options->Method == HttpMethod::Put) {
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $options->Method);
        } else if($options->Method == HttpMethod::Delete) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $options->Method);
        }
        //set Post Body
        if(isset($options->Data))
            curl_setopt($ch, CURLOPT_POSTFIELDS, $options->Data);
        if(is_resource($options->StreamHandle)) {
            $opt = $options->Method === HttpMethod::Get ? CURLOPT_FILE : CURLOPT_INFILE;
            curl_setopt($ch, $opt, $options->StreamHandle);
        }
        $options->ensureHeader("Content-Length",strlen($options->Data));
        //custom HTTP headers
        if($options->Headers)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $options->getRawHeaders());
        //debugging mode
        curl_setopt($ch,CURLOPT_VERBOSE, $options->Verbose);
        //SSL Version
        if(!is_null($options->SSLVersion)) {
            curl_setopt($ch,CURLOPT_SSLVERSION, $options->SSLVersion);
        }
        //authentication
        if(!is_null($options->AuthType))
            curl_setopt($ch,CURLOPT_HTTPAUTH, $options->AuthType);
        if(!is_null($options->UserCredentials))
            curl_setopt($ch,CURLOPT_USERPWD, $options->UserCredentials->toString());
        if(!is_null($options->ConnectTimeout))
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $options->ConnectTimeout);
        if($options->FollowLocation)
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        if(!is_null($options->IPResolve))
            curl_setopt($ch, CURLOPT_IPRESOLVE, $options->IPResolve);
        return $ch;
    }

}
