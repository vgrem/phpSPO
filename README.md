# SharePoint client for PHP
This library provides a SharePoint client for PHP applications. This allows you to performs CRUD operations on SharePoint data, using an REST/OData based API for SharePoint 2013. 

The current version is restricted to SharePoint Online, using claims based authentication.

## Requirements
- PHP 5.3 or later


### API
PHP:cURL library is used to make HTTP requests to performs CRUD operations on SharePoint data, using  SharePoint 2013 REST API



Examples


The following examples demonstrates how to perform CRUD operations on SharePoint list data.

````
require_once 'SPORestClient.php';
require_once 'SPList.php';

$username = 'username@tenant.onmicrosoft.com';
$password = 'password';
$url = "https://tenant.sharepoint.com/";

generateTasks($url,$username,$password);

function generateTasks($url,$username,$password){
    $client = new SPORestClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    
    for ($i=0;$i<4;$i++) {
        $itemProperties = array('Title' => 'Order Approval ' . $i, 'Body' => 'Order approval task');
        $item = $list->addItem($itemProperties);
        print "Task '{$item->Title}' has been created succesfully.\r\n";
    }
}
````


How to create SharePoint list item:
````
function addListItem($url,$username,$password){
    $client = new SPORestClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task');
    $item = $list->addItem($itemProperties);
    
}
````

How to delete SharePoint list item:
````
function deleteListItem($url,$username,$password){
    $client = new SPORestClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $list->deleteItem(2);
    
}
````

How to update SharePoint list item:
````
function updateListItem($url,$username,$password){
    $client = new SPORestClient($url);
    $client->signIn($username,$password);
    $listTitle = 'Tasks';
    $list = $client->getList($listTitle);
    $itemProperties = array('PercentComplete' => 1);
    $list->updateItem(2,$itemProperties);
    
}
````




## Changelog

1.0.0 - May 23st, 2014
- Initial release.