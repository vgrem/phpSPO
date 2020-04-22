<?php


namespace Office365\Runtime\Auth;


abstract class BaseTokenProvider
{
     public abstract function acquireToken($parameters);
     
}