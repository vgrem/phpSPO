<?php

require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__ . '/../src/runtime/auth/AuthenticationContext.php');
require_once(__DIR__.'/../src/userprofiles/PeopleManager.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\UserProfiles;





try {
    $authCtx = new AuthenticationContext($Settings['Url']);
    $authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);

    $ctx = new ClientContext($Settings['Url'],$authCtx);
    readUserProfiles($ctx);
    
}
catch (Exception $e) {
    echo 'Error: ',  $e->getMessage(), "\n";
}


function readUserProfiles(ClientContext $ctx){
    #read my user profile properties
    
    $peopleManager = new \SharePoint\PHP\Client\UserProfiles\PeopleManager($ctx);
    $properties = $peopleManager->getMyProperties();
    $ctx->load($properties);
    $ctx->executeQuery();

    print "Account Name '{$properties->AccountName}' \r\n";

    #print properties
    foreach( $properties->UserProfileProperties->results as $p ) {
        print "{$p->Key}: '{$p->Value}'\r\n";
    }


    #follow
    //$accountName = "jdoe@media16.onmicrosoft.com";
    //$peopleManager->follow($accountName);
    //$ctx->executeQuery();


}






?>
