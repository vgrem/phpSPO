<?php

require_once 'SPOClient.php';


$username = 'username@tenant.onmicrosoft.com';
$password = 'password';
$url = "https://tenant.sharepoint.com/project";


//connectSPO($url,$username,$password);


printTasks($url,$username,$password);

//addTask($url,$username,$password);

//deleteTask($url,$username,$password);

//updateTask($url,$username,$password);

//generateTasks($url,$username,$password);


function generateTasks($url,$username,$password){
    $client = new SPOClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);

    for ($i=14;$i<20;$i++) {
        $itemProperties = array('Title' => 'Order Approval ' . $i, 'Body' => 'Order approval task');
        $item = $list->addItem($itemProperties);
        print "Task '{$item->Title}' has been created succesfully.\r\n";
    }
}






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
function addTask($url,$username,$password){
    $client = new SPOClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task');
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