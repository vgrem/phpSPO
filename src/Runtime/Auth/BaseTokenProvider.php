<?php


namespace Office365\Runtime\Auth;


abstract class BaseTokenProvider
{
    /**
     * @param array $tokenParameters
     * @return mixed
     */
     public abstract function acquireToken($tokenParameters);
     
}