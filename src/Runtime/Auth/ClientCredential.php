<?php


namespace Office365\Runtime\Auth;


class ClientCredential
{

    /**
     * @param string $clientId
     * @param string $clientSecret
     */
    public function __construct($clientId, $clientSecret)
    {
        $this->ClientId = $clientId;
        $this->ClientSecret = $clientSecret;
    }


    /**
     * @var string $ClientId
     */
    public $ClientId;


    /**
     * @var string $ClientSecret
     */
    public $ClientSecret;

}