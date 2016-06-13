<?php

require_once __DIR__ . '/../../Faker/src/autoload.php';  //Faker library (https://github.com/fzaninotto/Faker)
require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__ . '/../src/runtime/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;


try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);

    $ctx = new ClientContext($Settings['Url'],$authCtx);
	generateContacts($ctx);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}




function generateContacts(ClientContext $ctx){

    $listTitle = 'Contacts';
	$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
	
    
	$contactsCount = 10;
	for($i = 0; $i < $contactsCount; $i++){
	     $contactEntry = createContactEntry();
         $contactEntry['__metadata'] = array('type' => 'SP.Data.ContactsListItem'); //mandatory!
	     $item = $list->addItem($contactEntry);
         $ctx->executeQuery();
	     print "Contact '{$item->Title}' has been created.\r\n";
	}
    
}


function createContactEntry()
{
	 $contactCard = Faker\Factory::create();
	 return array('Title' => $contactCard->username, 
	         'FullName' => $contactCard->name,
	         'Email' => $contactCard->email,
	         'Company' => $contactCard->company,
	         'WorkPhone' => $contactCard->phoneNumber,
	         'WorkAddress' => $contactCard->streetAddress,
	         'WorkCity' => $contactCard->city,
	         'WorkZip' => $contactCard->postcode,
	         'WorkCountry' => $contactCard->country,
	         'WebPage' => array ('Url' => $contactCard->url)
	         );  
}




?>