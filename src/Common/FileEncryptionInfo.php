<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class FileEncryptionInfo extends ClientValue
{
    /**
     * @var string
     */
    public $EncryptionKey;
    /**
     * @var string
     */
    public $InitializationVector;
    /**
     * @var string
     */
    public $Mac;
    /**
     * @var string
     */
    public $MacKey;
    /**
     * @var string
     */
    public $ProfileIdentifier;
    /**
     * @var string
     */
    public $FileDigest;
    /**
     * @var string
     */
    public $FileDigestAlgorithm;
}