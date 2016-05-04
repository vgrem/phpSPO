<?php

require_once(__DIR__ . '/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;
use SharePoint\PHP\Client\ListCreationInformation;



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



function queryListItems(\SharePoint\PHP\Client\SPList $list)
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
		print "Task: '{$item->Title}, {$item->AssignedTo->results[0]->Title}'\r\n";
	}
}



function ensureList(SharePoint\PHP\Client\ClientContext $ctx,$listTitle){

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
 * @return \SharePoint\PHP\Client\SPList
 */
function createList(ClientContext $ctx,$listTitle){
	$info = new ListCreationInformation($listTitle);
	$info->Description = "Orders list";
	$info->BaseTemplate = \SharePoint\PHP\Client\ListTemplateType::Tasks;
	$list = $ctx->getWeb()->getLists()->add($info);
	$ctx->executeQuery();
	print "List '{$list->Title}' has been created.\r\n";
	return $list;
}




function generateTasks(\SharePoint\PHP\Client\SPList $list)
{
	print "Creating a new list items..\r\n";
	$ctx = $list->getContext();
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
 */
function printTasks(\SharePoint\PHP\Client\SPList $list){
	print "Getting list items from the list..\r\n";
	$ctx = $list->getContext();
	$items = $list->getItems();
    $ctx->load($items);
    $ctx->executeQuery();
	foreach( $items->getData() as $item ) {
	    print "Task: '{$item->Title}'\r\n";
	}
}

function queryListViaCAMLQuery(\SharePoint\PHP\Client\SPList $list){
	print "Querying list items from the list..\r\n";
	$ctx = $list->getContext();
	$query = new \SharePoint\PHP\Client\CamlQuery();
	$items = $list->getItems($query);
	$ctx->load($items);
	$ctx->executeQuery();
	foreach( $items->getData() as $item ) {
		print "Task: '{$item->Title}'\r\n";
	}
}

/**
 * Create list item operation example
 * @param \SharePoint\PHP\Client\SPList $list
 * @param array $itemProperties
 * @return mixed|null
 */
function createListItem(\SharePoint\PHP\Client\SPList $list, array $itemProperties){
	$ctx = $list->getContext();
	$item = $list->addItem($itemProperties);
    $ctx->executeQuery();
	print "Task {$item->getProperty('Title')} has been created.\r\n";
	return $item->Id;
}


/**
 * Read list item operation example
 */
function getTask(ClientContext $ctx,$itemId){

	$listTitle = 'Tasks';
	$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
	$listItem = $list->getItemById($itemId);
	$ctx->load($listItem);
	$ctx->executeQuery();
	print "Task '{$listItem->Title}' has been retrieved.\r\n";
	return $listItem;
}

/**
 * Delete list item operation example
 */
function deleteTask(\SharePoint\PHP\Client\ListItem $item){
	$ctx = $item->getContext();
	$item->deleteObject();
    $ctx->executeQuery();
    print "Task '{$item->Title}' has been deleted.\r\n";
    
}

/**
 * Update list item opeation example
 */
function updateTask($item){
	$ctx = $item->getContext();
	$itemProperties = array('PercentComplete' => 1, '__metadata' => array('type' => 'SP.Data.TasksListItem'));
	$item->update($itemProperties);
    $ctx->executeQuery();
    print "Task '{$item->Title}' has been updated.\r\n";
}



?>