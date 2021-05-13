<?php

$secure_vars = explode(";",getenv("phpSPO_secure_vars"));
$parts = explode('@', $secure_vars[0]);
$domain_parts = explode('.', $parts[1]);
$tenant_prefix = $domain_parts[0];

return array(
    'TenantName' => "{$tenant_prefix}.onmicrosoft.com",
	'Url' => "https://{$tenant_prefix}.sharepoint.com",
    'TeamSiteUrl' => "https://{$tenant_prefix}.sharepoint.com/sites/team",
    'OneDriveUrl' => "https://{$tenant_prefix}-my.sharepoint.com",
    'AdminTenantUrl' => "https://{$tenant_prefix}-admin.sharepoint.com",
    'Password' => $secure_vars[1],
    'UserName' => $secure_vars[0],
    'ClientId' => "4b7eb3df-afc3-4b7d-ae1d-629f22a3fe42",
    'ClientSecret' => $secure_vars[2],
    'RedirectUrl' => "https://{$tenant_prefix}.sharepoint.com",
    'TestAccountName' => "jdoe2@{$tenant_prefix}.onmicrosoft.com",
    'TestAltAccountName' => "wellis2@{$tenant_prefix}.onmicrosoft.com"
);









