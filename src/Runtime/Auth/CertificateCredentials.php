<?php

namespace Office365\Runtime\Auth;

class CertificateCredentials
{

    /**
     * @param string $tenant
     * @param string $clientId
     * @param string $privateKey
     * @param string $thumbprint
     * @param string[] $scope
     */
    public function __construct($tenant, $clientId, $privateKey, $thumbprint, $scope=null)
    {
        $this->Tenant = $tenant;
        $this->ClientId = $clientId;
        $this->PrivateKey = $privateKey;
        $this->Thumbprint = $thumbprint;
        $this->Scope = $scope;
    }


    /**
     * @var string $Tenant
     */
    public $Tenant;

    /**
     * @var string $ClientId
     */
    public $ClientId;

    /**
     * @var string $PrivateKey
     */
    public $PrivateKey;

    /**
     * @var string $Thumbprint
     */
    public $Thumbprint;

    /**
     * @var string[] $Scope
     */
    public $Scope;

}