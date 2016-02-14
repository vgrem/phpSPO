### About
This library provides a SharePoint REST client for PHP applications. This allows you to performs CRUD operations againts SharePoint Online resources via an REST/OData based API. 

### Installation

## PHP version
- PHP 5.3 or later


### API
-  PHP:cURL library is used to perform HTTP requests 
-  `ClientContext` - represents a client context to to performs CRUD operations against SharePoint resources via SharePoint Online REST API
-  `AuthenticationContext` - represents an object that provides credentials to access SharePoint Online resources.


Example:

````
try {
	$authCtx = new AuthenticationContext($Settings['Url']);
	$authCtx->acquireTokenForUser($Settings['UserName'],$Settings['Password']);
	echo 'You have been authenticated successfully\n';
}
catch (Exception $e) {
	echo 'Authentication failed: ',  $e->getMessage(), "\n";
}
````

### Usage


The following examples demonstrates how to perform basic CRUD operations againts SharePoint list item resources.

Example 1. How to read SharePoint list items

````

$authCtx = new AuthenticationContext($Url);
$authCtx->acquireTokenForUser($UserName,$Password); //authenticate

$ctx = new ClientContext($Url,$authCtx); //initialize REST client    
$web = $ctx->getWeb();
$list = $web->getLists()->getByTitle($listTitle); //init List resource
$items = $list->getItems();  //prepare a query to retrieve from the 
$ctx->load($items);  //save a query to retrieve list items from the server 
$ctx->executeQuery(); //submit query to SharePoint Online REST service
foreach( $items->getData() as $item ) {
    print "Task: '{$item->Title}'\r\n";
}
````


Example 2. How to create SharePoint list item:
````
$listTitle = 'Tasks';
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task','__metadata' => array('type' => 'SP.Data.TasksListItem'));
$item = $list->addItem($itemProperties);
$ctx->executeQuery();
print "Task '{$item->Title}' has been created.\r\n";
````

Example 3. How to delete a SharePoint list item:
````
$listTitle = 'Tasks';
$itemToDeleteId = 1;
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$listItem = $list->getItemById($itemToDeleteId);
$listItem->deleteObject();
$ctx->executeQuery();
````

Example 4. How to update SharePoint list item:
````
$listTitle = 'Tasks';
$itemToUpdateId = 1;
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$listItem = $list->getItemById($itemId);
$itemProperties = array('PercentComplete' => 1, '__metadata' => array('type' => 'SP.Data.TasksListItem'));
$listItem->update($itemProperties);
$ctx->executeQuery();
````




## Changelog

1.0.0 - May 23st, 2014
- Initial release.
 
2.0.0 - February 14, 2016
- `AuthenticationContext` and `ClientContext` classes have been introduced.  