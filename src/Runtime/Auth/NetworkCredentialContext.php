<?php

namespace Office365\Runtime\Auth;

use Office365\Runtime\Http\RequestOptions;


/**
 * Provides credentials for password-based authentication schemes such
 * as basic, digest, NTLM, and Kerberos authentication.
 */
class NetworkCredentialContext implements IAuthenticationContext
{

    /**
     * @var array
     */
    //private $cachedCookies = array();

    /**
     * @var UserCredentials
     */
    private $userCredentials;


    /**
     * @var int
     */
    public $AuthType;

    /**
     * NetworkCredentialContext constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password){
        $this->userCredentials = new UserCredentials($username,$password);
        $this->AuthType = CURLAUTH_BASIC; //default Auth schema
    }

    public function authenticateRequest(RequestOptions $request)
    {
        $request->AuthType = $this->AuthType;
        $request->UserCredentials = $this->userCredentials;
    }

}
