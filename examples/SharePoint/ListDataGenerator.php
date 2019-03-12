<?php


require_once 'vendor/fzaninotto/Faker/src/autoload.php';
require_once('../bootstrap.php');
$Settings = include('../../Settings.php');

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;


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
    $list =  ListExtensions::ensureList($ctx->getWeb(),$listTitle,\Office365\PHP\Client\SharePoint\ListTemplateType::Contacts);
	$contactsCount = 1000;
	for($i = 0; $i < $contactsCount; $i++){
	     $contactEntry = createContactEntry();
         $contactEntry['__metadata'] = array('type' => 'SP.Data.ContactsListItem'); //mandatory!
	     $item = $list->addItem($contactEntry);
         $ctx->executeQuery();
	     print "$i: Contact '{$item->Title}' has been created.\r\n";
	}
}


/**
 * @return array
 */
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