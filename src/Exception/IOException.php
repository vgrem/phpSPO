<?php

namespace Office365\PHP\Client\Exception;

/**
 * An exception thrown if the remote service returns an error.
 */
class IOException extends \Exception
{
    /**
     * @var string|null
     */
    private $responseBody;

    /**
     * IOException constructor.
     * @param string $message an error message for the logs
     * @param int $statusCode the HTTP status code returned by the remote service
     * @param string|null $responseBody the body of the remote service response.
     */
    public function __construct($message, $statusCode = 0, $responseBody = null)
    {
        parent::__construct($message, $statusCode);
        $this->responseBody = $responseBody;
    }

    /**
     * The response returned by the remote service, or `null` if the body was empty.
     *
     * @return string|null
     */
    public function getResponseBody()
    {
        return $this->responseBody;
    }
}

