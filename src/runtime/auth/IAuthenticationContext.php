<?php

namespace SharePoint\PHP\Client;

interface IAuthenticationContext
{
    public function authenticateRequest(RequestOptions $request);
}