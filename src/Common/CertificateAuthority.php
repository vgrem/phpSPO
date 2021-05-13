<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class CertificateAuthority extends ClientValue
{
    /**
     * @var bool
     */
    public $IsRootAuthority;
    /**
     * @var string
     */
    public $CertificateRevocationListUrl;
    /**
     * @var string
     */
    public $DeltaCertificateRevocationListUrl;
    /**
     * @var string
     */
    public $Certificate;
    /**
     * @var string
     */
    public $Issuer;
    /**
     * @var string
     */
    public $IssuerSki;
}