<?php

require_once(__DIR__ . '/../src/SharePoint/ClientContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/AuthenticationContext.php');
require_once(__DIR__ . '/../src/Runtime/Auth/NetworkCredentialContext.php');
require_once 'Settings.php';

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\SharePoint\ListCreationInformation;

global $Settings;

try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);

    $ctx = new ClientContext($Settings['Url'],$authCtx);

	$listTitle = 'Tasks';
	$list = ensureList($ctx,$listTitle);

	//printTasks($list);
	//queryListViaCAMLQuery($list);
	generateTasks($list);
    //$itemId = createTask($list);
	//$item = getTask($list,$itemId);
	//updateTask($item);
    //deleteTask($item);
	//queryListItems($list);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}



function queryListItems(\Office365\PHP\Client\SharePoint\SPList $list)
{
	$ctx = $list->getContext();
    
	print "1. Retrieve top number of list items..\r\n";
	$items = $list->getItems()->top(5);  //apply top query option
	$ctx->load($items);
	$ctx->executeQuery();
	foreach( $items->getData() as $item ) {
		print "Task: '{$item->Title}'\r\n";
	}

	/*print "2. Skip the number of list items..\r\n";
	$items = $list->getItems()->skip(40);  //apply skip query option
	$ctx->load($items);
	$ctx->executeQuery();
	foreach( $items->getData() as $item ) {
		print "Task: '{$item->Title}'\r\n";
	}*/


	print "3. Select a specific set of fields from list items..\r\n";
	$items = $list->getItems()->select('Title,Id');  //apply select query option
	$ctx->load($items);
	$ctx->executeQuery();
	foreach( $items->getData() as $item ) {
		print "Task: {$item->Id}, {$item->Title}\r\n";
	}

	print "4. Filter list items..\r\n";
	$items = $list->getItems()->filter("ID eq 1");  //apply filter query option
	$ctx->load($items);
	$ctx->executeQuery();
	foreach( $items->getData() as $item ) {
		print "Task: '{$item->Title}'\r\n";
	}

	print "5. Select projected user field value properties..\r\n";
	$items = $list->getItems()->select('Title,AssignedTo/Id,AssignedTo/Title')->expand('AssignedTo');  //apply select & expand query options
	$ctx->load($items);
	$ctx->executeQuery();
	foreach( $items->getData() as $item ) {
		print "Task: '{$item->Title}, {$item->AssignedTo[0]->Title}'\r\n";
	}
}



function ensureList(Office365\PHP\Client\SharePoint\ClientContext $ctx, $listTitle){

	$list = null;
	$lists = $ctx->getWeb()->getLists();
	$ctx->load($lists);
	$ctx->executeQuery();
	foreach($lists->getData() as $curList) {
		if ($listTitle == $curList->Title) {
			print "List {$curList->Title} has been found\r\n";
			return $curList;
		}
	}
	return createList($ctx,$listTitle);
}

/**
 * Create list item operation example
 * @param ClientContext $ctx
 * @param $listTitle
 * @return \Office365\PHP\Client\SharePoint\SPList
 */
function createList(ClientContext $ctx, $listTitle){
	$info = new ListCreationInformation($listTitle);
	$info->Description = "Orders list";
	$info->BaseTemplate = \Office365\PHP\Client\SharePoint\ListTemplateType::Tasks;
	$list = $ctx->getWeb()->getLists()->add($info);
	$ctx->executeQuery();
	print "List '{$list->Title}' has been created.\r\n";
	return $list;
}




function generateTasks(\Office365\PHP\Client\SharePoint\SPList $list)
{
	print "Creating a new list items..\r\n";
	for ($i = 0; $i < 2; $i++) {
		$itemProperties = array(
			'Title' => 'Order Approval' . rand(1, 1000),
			'Body' => 'Please review a task',
			//'__metadata' => array('type' => 'SP.Data.TasksListItem')
		);
		createListItem($list, $itemProperties);
	}
}


/**
 * Read list items operation example
 * @param \Office365\PHP\Client\SharePoint\SPList $list
 */
function printTasks(\Office365\PHP\Client\SharePoint\SPList $list){
	print "Getting list items from the list..\r\n";
	$ctx = $list->getContext();
	$items = $list->getItems();
    $ctx->load($items);
    $ctx->executeQuery();
	foreach( $items->getData() as $item ) {
	    print "Task: '{$item->Title}'\r\n";
	}
}

function queryListViaCAMLQuery(\Office365\PHP\Client\SharePoint\SPList $list){
	print "Querying list items from the list..\r\n";
	$ctx = $list->getContext();
	$query = new \Office365\PHP\Client\SharePoint\CamlQuery();
	$items = $list->getItems($query);
	$ctx->load($items);
	$ctx->executeQuery();
	foreach( $items->getData() as $item ) {
		print "Task: '{$item->Title}'\r\n";
	}
}

/**
 * Create list item operation example
 * @param \Office365\PHP\Client\SharePoint\SPList $list
 * @param array $itemProperties
 * @return mixed|null
 */
function createListItem(\Office365\PHP\Client\SharePoint\SPList $list, array $itemProperties){
	$ctx = $list->getContext();
	$item = $list->addItem($itemProperties);
    $ctx->executeQuery();
	print "Task {$item->getProperty('Title')} has been created.\r\n";
	return $item->Id;
}


/**
 * Read list item operation example
 * @param ClientContext $ctx
 * @param $itemId
 * @return \Office365\PHP\Client\SharePoint\ListItem
 */
function getTask(ClientContext $ctx, $itemId){

	$listTitle = 'Tasks';
	$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
	$listItem = $list->getItemById($itemId);
	$ctx->load($listItem);
	$ctx->executeQuery();
	print "Task '{$listItem->Title}' has been retrieved.\r\n";
	return $listItem;
}


function deleteTask(\Office365\PHP\Client\SharePoint\ListItem $item){
	$ctx = $item->getContext();
	$item->deleteObject();
    $ctx->executeQuery();
    print "Task {$item->getProperty('Title')} has been deleted.\r\n";
    
}


function updateTask(\Office365\PHP\Client\SharePoint\ListItem $item){
	$ctx = $item->getContext();
	$item->setProperty('PercentComplete', 1);
	$item->update();
    $ctx->executeQuery();
    print "Task {$item->getProperty('Title')} has been updated.\r\n";
}