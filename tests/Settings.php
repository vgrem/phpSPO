<?php

$secure_vars = explode(";",getenv("phpSPO_secure_vars"));
$tenant_prefix = "mediadev8";

return array(
    'TenantName' => "{$tenant_prefix}.onmicrosoft.com",
	'Url' => "https://{$tenant_prefix}.sharepoint.com",
    'TeamSiteUrl' => "https://{$tenant_prefix}.sharepoint.com/sites/team",
    'OneDriveUrl' => "https://{$tenant_prefix}-my.sharepoint.com",
    'AdminTenantUrl' => "https://{$tenant_prefix}-admin.sharepoint.com",
    'Password' => $secure_vars[1],
    'UserName' => $secure_vars[0],
    'ClientId' => $secure_vars[2],
    'ClientSecret' => $secure_vars[3],
    'RedirectUrl' => "https://{$tenant_prefix}.sharepoint.com",
    'TestAccountName' => "jdoe2@{$tenant_prefix}.onmicrosoft.com",
    'TestAltAccountName' => "wellis2@{$tenant_prefix}.onmicrosoft.com"
);









