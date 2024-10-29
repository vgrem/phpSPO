<?php

namespace Office365\SharePoint;


use Office365\Runtime\ClientValue;

/**
 * The context information for a site.
 */
class ContextWebInformation extends ClientValue
{



    public function __construct()
    {
        parent::__construct();
        $this->_valid_from = time();
    }

    /**
     * @var int
     */
    private $_valid_from;

    /**
     * Determines whether FormDigest has been expired or not
     * @return bool
     */
    function isValid()
    {
        if ($this->FormDigestTimeoutSeconds === null) {
            return false;
        }

        $expires_in_sec = time() - $this->_valid_from;
        return $expires_in_sec < $this->FormDigestTimeoutSeconds;
    }

    /**
     * The form digest value.
     * @var string
     */
    public $FormDigestValue;


    /**
     * The library version.
     * @var string
     */
    public $LibraryVersion;


    /**
     * The amount of time in seconds that the form digest will timeout.
     * @var int
     */
    public $FormDigestTimeoutSeconds;

    /**
     * The full URL of the site collection context.
     * @var string
     */
    public $SiteFullUrl;

    /**
     * The supported client-side object model request schema version.
     * @var array
     */
    public $SupportedSchemaVersions;


    /**
     * The full URL of the site context.
     * @var string
     */
    public $WebFullUrl;



}
