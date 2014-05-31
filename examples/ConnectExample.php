<?php

require_once 'SPOClient.php';


function connectSPO($url,$username,$password)
{
    try {
        $client = new SPOClient($url);
        $client->signIn($username,$password);
        echo 'You have been authenticated successfully\n';
    }
    catch (Exception $e) {
        echo 'Authentication failed: ',  $e->getMessage(), "\n";
    }
}

?>
