<?php
namespace SharePoint\PHP\Client;

class Requests
{

	/**
	 * SSL Version
	 * @var int
	 */
	private static $sslVersion = null;


	public static function setSslVersion($sslVersion)
	{
	    if (!is_int($sslVersion)) {
	        throw new \InvalidArgumentException("SSL Version must be an integer");
	    }
	    self::$sslVersion = $sslVersion;
	}

	public static function post($url,$headers,$data=null,$passHeaders=false)
	{
		$ch = Requests::initCurl($url);
        curl_setopt($ch, CURLOPT_POST, 1);
		if($headers)
		   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_HEADER, $passHeaders);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($ch);
        if ($result === false) {
            throw new \Exception(curl_error($ch));
        }
		if($passHeaders){
			$result=substr($result, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		}
        curl_close($ch);
		return $result;
	}


	public static function get($url,$headers)
    {
        $ch = Requests::initCurl($url);
		if($headers)
             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        if ($result === false) {
            throw new \Exception(curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }


	/**
	 * Parse cookies
	 * @param mixed $header
	 * @return mixed
	 */
    public static function parseCookies($response)
    {
        $headerLines = explode("\r\n", $response);
        $cookies = array();
        foreach ($headerLines as $line) {
            if (preg_match('/^Set-Cookie: /i', $line)) {
                $line = preg_replace('/^Set-Cookie: /i', '', trim($line));
                $csplit = explode(';', $line);
                $cinfo = explode('=', $csplit[0], 2);
                $cookies[$cinfo[0]] = $cinfo[1];
            }
        }

        return $cookies;
    }

	/**
	 * Init Curl with the default parameters
	 * @return    [type]    [description]
	 */
    private static function initCurl($url)
    {
        $ch = curl_init();
		if (!is_null(self::$sslVersion)) {
		    curl_setopt($ch, CURLOPT_SSLVERSION, self::$sslVersion);
		}
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        //curl_setopt($ch, CURLOPT_PROXY, '127.0.0.1:8888');
        return $ch;
    }
}