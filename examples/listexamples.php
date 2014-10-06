<?php

require_once 'SPOClient.php';

/**
 * Read list items operation example
 * @param mixed $url 
 * @param mixed $username 
 * @param mixed $password 
 */
function printTasks($url,$username,$password){
    $client = new SPOClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    
    $list = $client->getList($listTitle);
    $items = $list->getItems();
    foreach( $items as $item ) {
        print "Task: '{$item->Title}'\r\n";
    }
}

/**
 * Create list item operation example
 * @param mixed $url 
 * @param mixed $username 
 * @param mixed $password 
 */
function createTask($url,$username,$password){
    $client = new SPOClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task','__metadata' => array('type' => 'SP.Data.TasksListItem'));
    $item = $list->addItem($itemProperties);
    print "Task '{$item->Title}' has been created succesfully.\r\n";
}

/**
 * Delete list item operation example
 * @param mixed $url 
 * @param mixed $username 
 * @param mixed $password 
 */
function deleteTask($url,$username,$password){
    $client = new SPOClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $list->deleteItem(2);
    
}

/**
 * Update list item opeation example
 * @param mixed $url 
 * @param mixed $username 
 * @param mixed $password 
 */
function updateTask($url,$username,$password){
    $client = new SPOClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $itemProperties = array('PercentComplete' => 1);
    $list->updateItem(2,$itemProperties);
    
}



?>