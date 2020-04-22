<?php

namespace Office365\Runtime\Auth;

use Office365\Runtime\Http\RequestOptions;

interface IAuthenticationContext
{
    public function authenticateRequest(RequestOptions $request);
}