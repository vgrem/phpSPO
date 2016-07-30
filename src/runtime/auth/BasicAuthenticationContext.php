<?php

namespace SharePoint\PHP\Client;
require_once('AuthenticationContext.php');

class BasicAuthenticationContext extends AuthenticationContext{

    /**
     * @var array
     */
    //private $cachedCookies = array();

    /**
     * @var UserCredentials
     */
    private $userCredentials;

    public function __construct($url, $username, $password){
        parent::__construct($url);
        $this->userCredentials = new UserCredentials($username,$password);
    }

    public function authenticateRequest($options)
    {
        $options->AuthType = CURLAUTH_BASIC;
        $options->UserCredentials = $this->userCredentials;
    }

}