### About
Office 365 Library for PHP. It allows to performs CRUD operations against Office 365 resources via an REST/OData based API. 

#### The list of supported Office 365 REST APIs:

-   [SharePoint REST API](https://msdn.microsoft.com/en-us/library/office/jj860569.aspx) Supported versions: [SharePoint On-Premises (2013/2016/2019)](https://msdn.microsoft.com/library/office/jj860569(v=office.15).aspx), SharePoint Online and OneDrive for Business
-   [Outlook REST API](https://msdn.microsoft.com/en-us/office/office365/api/use-outlook-rest-api#DefineOutlookRESTAPI) 
    -   [Outlook Contacts REST API](https://msdn.microsoft.com/en-us/office/office365/api/contacts-rest-operations)
    -   [Outlook Calendar REST API](https://msdn.microsoft.com/en-us/office/office365/api/calendar-rest-operations)
    -   [Outlook Mail REST API](https://msdn.microsoft.com/en-us/office/office365/api/mail-rest-operations)
    -   OneNote REST API

### Status

[![Total Downloads](https://poser.pugx.org/vgrem/php-spo/downloads)](https://packagist.org/packages/vgrem/php-spo)
[![Latest Stable Version](https://poser.pugx.org/vgrem/php-spo/v/stable)](https://packagist.org/packages/vgrem/php-spo)
[![Build Status](https://travis-ci.org/vgrem/phpSPO.svg?branch=master)](https://travis-ci.org/vgrem/phpSPO)
[![License](https://poser.pugx.org/vgrem/php-spo/license)](https://packagist.org/packages/vgrem/php-spo)

<!---
[![PayPal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=J99W9EM829BQC)
-->

### Installation

You can use **Composer** or simply **Download the Release**

#### Composer

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require vgrem/php-spo:dev-master -n --no-progress
```

Finally, be sure to include the autoloader:

```php
require_once '/path/to/your-project/vendor/autoload.php';
```



### PHP version
- [PHP 5.4 or later](https://secure.php.net/)


### API

-  PHP:cURL underlying library is used to perform HTTP requests 
-  `ClientContext` - represents a SharePoint client context to performs CRUD operations against SharePoint resources via SharePoint Online REST API
-  `OutlookClient` - represents a client context to performs CRUD operations against Office resources such as Outlook resources
-  `ClientRequest` - represents a client request (more low level compared to `ClientContext`) to to performs CRUD operations against SharePoint resources via SharePoint Online REST API
-  `AuthenticationContext` - represents an object that provides credentials to access SharePoint Online resources.
-  `NetworkCredentialContext` - provides credentials for password-based authentication schemes such as Basic.
  

There are **two** approaches available to perform REST based queries:

-   via `ClientRequest` class where you need to construct REST queries by specifying endpoint url, headers if required and payload (low level approach), see [renameFolder.php](https://github.com/vgrem/phpSPO/blob/master/examples/renameFolder.php) for a more details
-   via `ClientContext` class where you target client object resources such as Web, ListItem and etc., see [list_examples.php](https://github.com/vgrem/phpSPO/blob/master/examples/list_examples.php) for a more details 


### Usage 


#### Using SharePoint REST API


The following examples demonstrates how to perform basic CRUD operations against **SharePoint** list item resources.

Example 1. How to read SharePoint list items

```php

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
```


Example 2. How to create SharePoint list item:
```php
$listTitle = 'Tasks';
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task','__metadata' => array('type' => 'SP.Data.TasksListItem'));
$item = $list->addItem($itemProperties);
$ctx->executeQuery();
print "Task '{$item->Title}' has been created.\r\n";
```

Example 3. How to delete a SharePoint list item:
```php
$listTitle = 'Tasks';
$itemToDeleteId = 1;
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$listItem = $list->getItemById($itemToDeleteId);
$listItem->deleteObject();
$ctx->executeQuery();
```

Example 4. How to update SharePoint list item:
```php
$listTitle = 'Tasks';
$itemToUpdateId = 1;
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$listItem = $list->getItemById($itemId);
$listItem->setProperty('PercentComplete',1);
$listItem->update();
$ctx->executeQuery();
```



#### Using Outlook REST API

The following examples demonstrates how to read, create and send messages via Outlook Mail API.

Example 1. How to create a draft message

```php

$authCtx = new NetworkCredentialContext($UserName,$Password); //using Basic Auth scheme (for v1 API only)
$ctx = new OutlookClient($authCtx); //initialize OutlookServices client
$message = $ctx->getMe()->getMessages()->createMessage(); //create a Message resource
//set Message properties
$message->Subject = "--subject--";
$message->Body = new ItemBody(BodyType::Text,"--Content goes here--");
$message->ToRecipients = array(
     new Recipient(new EmailAddress("Jon Doe","jdoe@contoso.onmicrosoft.com"))
);
$ctx->executeQuery();
```


Example 2. How to get messages

```php

$authCtx = new NetworkCredentialContext($UserName,$Password); //using Basic Auth scheme (for v1 API only)
$ctx = new OutlookClient($authCtx); //initialize OutlookServices client
$messages = $ctx->getMe()->getMessages();
$ctx->load($messages);
$ctx->executeQuery();
//print messages subjects
foreach ($messages->getData() as $curMessage){
   print $curMessage->Subject;
}
```


Example 3. How to send a message

```php

$authCtx = new NetworkCredentialContext($UserName,$Password); //using Basic Auth scheme (for v1 API only)
$ctx = new OutlookClient($authCtx); //initialize OutlookServices client
$message = $ctx->getMe()->getMessages()->createMessage(); //create a Message resource
//set Message properties
$message->Subject = "--subject--";
$message->Body = new ItemBody(BodyType::Text,"--Content goes here--");
$message->ToRecipients = array(
     new Recipient(new EmailAddress("Jon Doe","jdoe@contoso.onmicrosoft.com"))
);
$ctx->getMe()->sendEmail($message,false); //send a Message
$ctx->executeQuery();
```
  
