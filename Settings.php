<?php

$project_env = explode(";",getenv("phpSPO"));

$settings = array(
    'TenantName' => "mediadev88.onmicrosoft.com",
	'Url' => "https://mediadev88.sharepoint.com",
    'OneDriveUrl' => "https://mediadev88-my.sharepoint.com",
    'Password' => $project_env[1],
    'UserName' => $project_env[0],
    'ClientId' => "d4b2d51e-2d8e-4f08-8bce-961a7a435130",
    'ClientSecret' => $project_env[2],
    'RedirectUrl' => "https://mediadev88.sharepoint.com"
);

return $settings;







