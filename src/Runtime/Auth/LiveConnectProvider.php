<?php

namespace Office365\Runtime\Auth;



use Exception;

/**
 * Live Connect implements the OAuth 2.0 protocol to authenticate users
 */
class LiveConnectProvider extends BaseTokenProvider
{
    //private static $StsUrl = 'https://login.live.com/oauth20_token.srf';

    public function acquireToken($parameters)
    {
        throw new Exception("Not implemented");
    }
}