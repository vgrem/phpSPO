<?php

require_once(__DIR__.'/../src/ClientContext.php');
require_once(__DIR__.'/../src/auth/AuthenticationContext.php');
require_once 'Settings.php';

use SharePoint\PHP\Client\AuthenticationContext;
use SharePoint\PHP\Client\ClientContext;


try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);

    $ctx = new ClientContext($Settings['Url'],$authCtx);
	//printTasks($ctx);
    $itemId = createTask($ctx);
	$item = getTask($ctx,$itemId);
	//updateTask($item);
    deleteTask($item);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}



/**
 * Read list items operation example
 */
function printTasks(ClientContext $ctx){
	
	$listTitle = 'Tasks';
    
	$web = $ctx->getWeb();
    $list = $web->getLists()->getByTitle($listTitle);
	$items = $list->getItems();
    $ctx->load($items);
    $ctx->executeQuery();
	foreach( $items->getData() as $item ) {
	    print "Task: '{$item->Title}'\r\n";
	}
}

/**
 * Create list item operation example 
 */
function createTask(ClientContext $ctx){
	
	$listTitle = 'Tasks';
	$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
	$itemProperties = array(
		'Title' => 'Order Approval' . rand(1, 1000),
		'Body' => 'Please review a task',
		//'__metadata' => array('type' => 'SP.Data.TasksListItem')
	);
	$item = $list->addItem($itemProperties);
    $ctx->executeQuery();
	print "Task '{$item->Title}' has been created.\r\n";
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