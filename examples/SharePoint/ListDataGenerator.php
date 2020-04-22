<?php


require_once '../vendor/autoload.php';
$Settings = include('../../Settings.php');


use Office365\SharePoint\ClientContext;
use Office365\SharePoint\ListCreationInformation;
use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\SPList;
use Office365\SharePoint\Web;


try {

    $ctx = ClientContext::connectWithClientCredentials($Settings['Url'],$Settings['ClientId'],$Settings['ClientSecret']);
	generateContacts($ctx);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}

function generateContacts(ClientContext $ctx){

    $listTitle = 'Contacts';
    $list =  ensureList($ctx->getWeb(),$listTitle, ListTemplateType::Contacts);
	$contactsCount = 100;
	for($i = 0; $i < $contactsCount; $i++){
	     $contactEntry = createContactCard();
	     $item = $list->addItem($contactEntry);
         $ctx->executeQuery();
	     print "$i: Contact '{$item->getProperty('Title')}' has been created.\r\n";
	}
}


/**
 * @return array
 */
function createContactCard()
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

/**
 * @param Web $web
 * @param string $listTitle
 * @param int $type
 * @return SPList
 */
function ensureList(Web $web, $listTitle, $type)
{
    $ctx = $web->getContext();
    $lists = $web->getLists()->filter("Title eq '$listTitle'")->top(1);
    $ctx->load($lists);
    $ctx->executeQuery();
    if ($lists->getCount() == 1) {
        return $lists->getData()[0];
    }
    return createList($web, $listTitle, $type);
}

function createList(Web $web, $listTitle, $type)
{
    $ctx = $web->getContext();
    $info = new ListCreationInformation($listTitle);
    $info->BaseTemplate = $type;
    $list = $web->getLists()->add($info);
    $ctx->executeQuery();
    return $list;
}