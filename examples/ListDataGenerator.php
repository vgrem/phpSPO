<?php

require_once __DIR__ . '/../../Faker/src/autoload.php';  //Faker library (https://github.com/fzaninotto/Faker)
require_once 'SPOClient.php';

$username = 'username@tenant.onmicrosoft.com';
$password = 'password';
$url = "https://tenant.sharepoint.com/";


generateContacts($url,$username,$password);


function generateContacts($url,$username,$password){
    
    $client = new SPOClient($url);
    $client->signIn($username,$password);
    
    $contactsCount = 120;
    for($i = 0; $i < $contactsCount; $i++){
         $contactEntry = createContactEntry();    
         $item = addContact($client,$contactEntry);
         print "Contact '{$item->Title}' has been created succesfully.\r\n";
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

function addContact($client,$itemProperties){
    $list = $client->getList('Contacts');
    $item = $list->addItem($itemProperties);
    return $item;
}


?>