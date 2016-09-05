<?php

require_once('../bootstrap.php');
require_once(__DIR__ . '../../src/SharePoint/UserProfiles/PeopleManager.php');


use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
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
    
    $peopleManager = new \Office365\PHP\Client\SharePoint\UserProfiles\PeopleManager($ctx);
    $properties = $peopleManager->getMyProperties();
    $ctx->load($properties);
    $ctx->executeQuery();

    print "Account Name '{$properties->AccountName}' \r\n";

    #print properties
    foreach( $properties->UserProfileProperties as $p ) {
        print "{$p->Key}: '{$p->Value}'\r\n";
    }
}
