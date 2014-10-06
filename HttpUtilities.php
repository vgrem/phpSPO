<?php

/**
 * Parse cookies
 * @param mixed $header 
 * @return mixed
 */
function cookie_parse( $header ) {
    $headerLines = explode("\r\n",$header);
    $cookies = array();
    foreach( $headerLines as $line ) {
        if( preg_match( '/^Set-Cookie: /i', $line ) ) {
            $line = preg_replace( '/^Set-Cookie: /i', '', trim( $line ) );
            $csplit = explode( ';', $line);
            $cinfo = explode( '=', $csplit[0],2);
            $cookies[$cinfo[0]] = $cinfo[1];
        }
    }
    return $cookies;
}

/**
 * Encodes string 
 * @param mixed $value 
 * @return mixed
 */
function xmlEncode($value)
{
    $encName = rawurlencode($value);
    $encName = str_replace("%20","_x0020_",$encName);
    return $encName;
}

 

?>