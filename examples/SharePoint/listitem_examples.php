<?php

require_once('../bootstrap.php');
$Settings = include('../../Settings.php');

use Office365\PHP\Client\Runtime\Auth\AuthenticationContext;
use Office365\PHP\Client\SharePoint\AttachmentCreationInformation;
use Office365\PHP\Client\SharePoint\ClientContext;
use Office365\PHP\Client\SharePoint\ListCreationInformation;
use Office365\PHP\Client\SharePoint\SPList;


try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);

    $ctx = new ClientContext($Settings['Url'],$authCtx);

	$listTitle = 'Tasks812';
    $list = ListExtensions::ensureList($ctx->getWeb(),$listTitle, \Office365\PHP\Client\SharePoint\ListTemplateType::TasksWithTimelineAndHierarchy);
    addAttachmentToListItem($list);

	//printTasks($list);
	//queryListViaCAMLQuery($list);
	//generateTasks($list);
    //$itemId = createTask($list);


    /*$field = $list->getFields()->getByInternalNameOrTitle("Editor");
    $field->setProperty("ReadOnlyField",false);
    $field->update();
    $ctx->executeQuery();
    $ctx->load($field);
    $ctx->executeQuery();
    print $field->getProperty("ReadOnlyField");*/




    //$itemId = 604;
	//$item = getListItem($list,$itemId);
    //$item = $list->getItemById($itemId);
	//updateTask($item);
    //deleteTask($item);
	//queryListItems($list);
}
catch (Exception $e) {
	echo 'Error: ',  $e->getMessage(), "\n";
}



function addAttachmentToListItem(SPList $list){
    $ctx = $list->getContext();
    $itemProperties = array(
        'Title' => 'Order Approval' . rand(1, 1000)
        //'__metadata' => array('type' => 'SP.Data.TasksListItem')
    );
    $listItem = $list->addItem($itemProperties);
    $ctx->executeQuery();


    $attCreationInformation = new AttachmentCreationInformation();
    $path = "../data/SharePoint User Guide.docx";
    $attCreationInformation->FileName = basename($path);
    $attCreationInformation->ContentStream = file_get_contents($path);

    $attachment = $listItem->getAttachmentFiles()->add($attCreationInformation);
    $ctx->executeQuery();
    print "List item with " . $attachment->getServerRelativeUrl() . " attachment has been created";
}





function queryListItems(SPList $list)
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
 * @param \Office365\PHP\Client\SharePoint\SPList $list
 * @param $itemId
 * @return \Office365\PHP\Client\SharePoint\ListItem
 */
function getListItem(SPList $list, $itemId){
    $ctx = $list->getContext();
	$listItem = $list->getItemById($itemId);
	$ctx->load($listItem);
	$ctx->executeQuery();
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
	//$item->setProperty('Title', "New");
    $item->setProperty('EditorStringId', "11");
    $item->setProperty('EditorId', 11);
	$item->update();
    $ctx->executeQuery();
    print "Task {$item->getProperty('Title')} has been updated.\r\n";
}