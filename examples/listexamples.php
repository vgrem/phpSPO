<?php

require_once 'SPORestClient.php';
require_once 'SPList.php';

$username = 'username@tenant.onmicrosoft.com';
$password = 'password';
$url = "https://tenant.sharepoint.com/project";





//printListItems($url,$username,$password);


//addListItem($url,$username,$password);


//deleteListItem($url,$username,$password);


//updateListItem($url,$username,$password);




/**
 * Read list items operation example
 * @param mixed $url 
 * @param mixed $username 
 * @param mixed $password 
 */
function printListItems($url,$username,$password){
    $client = new SPORestClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    
    $list = $client->getList($listTitle);
    $items = $list->getItems();
    foreach( $items as $item ) {
        print_r($item->Title);
    }
}

/**
 * Create list item operation example
 * @param mixed $url 
 * @param mixed $username 
 * @param mixed $password 
 */
function addListItem($url,$username,$password){
    $client = new SPORestClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task');
    $item = $list->addItem($itemProperties);
    
}

/**
 * Delete list item operation example
 * @param mixed $url 
 * @param mixed $username 
 * @param mixed $password 
 */
function deleteListItem($url,$username,$password){
    $client = new SPORestClient($url);
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
function updateListItem($url,$username,$password){
    $client = new SPORestClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $itemProperties = array('PercentComplete' => 1);
    $list->updateItem(2,$itemProperties);
    
}



?>