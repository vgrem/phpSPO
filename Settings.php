<?php

$secure_vars = explode(";",getenv("phpSPO_secure_vars"));
return array(
    'TenantName' => "mediadev8.onmicrosoft.com",
	'Url' => "https://mediadev8.sharepoint.com/sites/team",
    'OneDriveUrl' => "https://mediadev8-my.sharepoint.com",
    'Password' => $secure_vars[1],
    'UserName' => $secure_vars[0],
    'ClientId' => "4b7eb3df-afc3-4b7d-ae1d-629f22a3fe42",
    'ClientSecret' => $secure_vars[2],
    'RedirectUrl' => "https://mediadev8.sharepoint.com"
);







