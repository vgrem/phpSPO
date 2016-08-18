<?php

require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once(__DIR__ . '/../src/SharePoint/UserProfiles/PeopleManager.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ClientRuntimeContext;
global $Settings;

try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
    $ctx = new ClientContext($Settings['Url'],$authCtx);
    readUserProfiles($ctx);
    
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function readUserProfiles(ClientRuntimeContext $ctx){
    #read my user profile properties
    
    $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager($ctx);
    $properties = $peopleManager->getMyProperties();
    $ctx->load($properties);
    $ctx->executeQuery();

    print "Account Name '{$properties->AccountName}' \r\n";

    #print properties
    foreach( $properties->UserProfileProperties as $p ) {
        print "{$p->Key}: '{$p->Value}'\r\n";
    }
}
