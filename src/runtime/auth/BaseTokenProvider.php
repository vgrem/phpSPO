<?php


namespace SharePoint\PHP\Client;


abstract class BaseTokenProvider
{
     public abstract function acquireToken();

     public abstract function getAuthenticationCookie();
}