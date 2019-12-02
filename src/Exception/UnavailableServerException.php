<?php


namespace Office365\PHP\Client\Exception;


use Throwable;

/**
 * This exception is thrown when an error occurs while trying to fetch the server.
 * It has the following fields:
 * - `message`: a readable for human beings error message (given by cURL);
 * - `code`: the error code given by cURL.
 *
 * @see libcurl error codes available: https://curl.haxx.se/libcurl/c/libcurl-errors.html
 */
class UnavailableServerException extends \Exception
{
    public function __construct($message = '', $code = 0)
    {
        parent::__construct($message, $code);
    }
}