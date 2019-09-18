<?php

$project_env = explode(";",getenv("phpSPO"));

$settings = array(
    'TenantName' => "mediadev8.onmicrosoft.com",
	'Url' => "https://mediadev8.sharepoint.com",
    'OneDriveUrl' => "https://mediadev8-my.sharepoint.com",
    'Password' => $project_env[1],
    'UserName' => $project_env[0],
    'ClientId' => "4b7eb3df-afc3-4b7d-ae1d-629f22a3fe42",
    'ClientSecret' => $project_env[2],
    'RedirectUrl' => "https://mediadev8.sharepoint.com"
);

return $settings;







