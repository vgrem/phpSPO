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
	printTasks($ctx);
    createTask($ctx);
	//updateTask($ctx);
    //deleteTask($ctx);
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
	$itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task','__metadata' => array('type' => 'SP.Data.TasksListItem'));
	$item = $list->addItem($itemProperties);
    $ctx->executeQuery();
	print "Task '{$item->Title}' has been created.\r\n";
}

/**
 * Delete list item operation example
 */
function deleteTask(ClientContext $ctx){
	
	$listTitle = 'Tasks';
	$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
    $itemId = 27;
    $listItem = $list->getItemById($itemId);
	$listItem->deleteObject();
    $ctx->executeQuery();
    print "Task has been deleted.\r\n";
    
}

/**
 * Update list item opeation example
 */
function updateTask(ClientContext $ctx){
	$listTitle = 'Tasks';
    $itemId = 27;
	$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
    $listItem = $list->getItemById($itemId);
	$itemProperties = array('PercentComplete' => 1, '__metadata' => array('type' => 'SP.Data.TasksListItem'));
	$listItem->update($itemProperties);
    $ctx->executeQuery();
    print "Task has been updated.\r\n";
}



?>