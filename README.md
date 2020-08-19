### About
Office 365 Library for PHP. 
A REST/OData based client library for Office 365.


### Usage 

1.   [Installation](#Installation)
1.   [Working with SharePoint API](#Working-with-SharePoint-API) 
2.   [Working with Outlook API](#Working-with-Outlook-API) 
3.   [Working with OneDrive API](#Working-with-OneDrive-API)


### Status

[![Total Downloads](https://poser.pugx.org/vgrem/php-spo/downloads)](https://packagist.org/packages/vgrem/php-spo)
[![Latest Stable Version](https://poser.pugx.org/vgrem/php-spo/v/stable)](https://packagist.org/packages/vgrem/php-spo)
[![Build Status](https://travis-ci.org/vgrem/phpSPO.svg?branch=master)](https://travis-ci.org/vgrem/phpSPO)
[![License](https://poser.pugx.org/vgrem/php-spo/license)](https://packagist.org/packages/vgrem/php-spo)


### Installation

You can use **Composer** or simply **Download the Release**

#### Composer

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.

Once composer installed, execute the following command in your project root to install this library:

```sh
composer require vgrem/php-spo
```

or via `composer.json` file:

```json
{
    "require": {
        "vgrem/php-spo": "^2.4"
    }
}
```

Finally, be sure to include the autoloader:

```
require_once '/path/to/your-project/vendor/autoload.php';
```

#### Requirements 

PHP version: [PHP 5.5 or later](https://secure.php.net/)


#### Working with SharePoint API

The list of supported SharePoint versions:

- SharePoint Online and OneDrive for Business
- SharePoint On-Premises (2013-2019) 

#### Authentication

The following auth flows supported:

- app principals (client credentials) auth (refer [Granting access using SharePoint App-Only](https://docs.microsoft.com/en-us/sharepoint/dev/solution-guidance/security-apponly-azureacs) for a details): 
  ```
  $credentials = new ClientCredential($clientId, $clientSecret);
  $ctx = (new ClientContext($url))->withCredentials($credentials);
  ```


- user credentials auth: 
  ```
  $credentials = new UserCredentials($userName, $password);
  $ctx = (new ClientContext($url))->withCredentials($credentials);
  ```
  
  
- NTLM auth (for SharePoint On-Premises):
  ```
   $authCtx = new NetworkCredentialContext($username, $password);
   $authCtx->AuthType = CURLAUTH_NTLM;
   $ctx = new ClientContext($url,$authCtx);
  ```

#### Examples  

The following examples demonstrates how to perform basic CRUD operations against **SharePoint** list item resources:

Example 1. How to read SharePoint list items

```
$credentials = new ClientCredential($clientId, $clientSecret);
$ctx = (new ClientContext($url))->withCredentials($credentials);     
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
```
$listTitle = 'Tasks';
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task','__metadata' => array('type' => 'SP.Data.TasksListItem'));
$item = $list->addItem($itemProperties);
$ctx->executeQuery();
print "Task '{$item->Title}' has been created.\r\n";
```

Example 3. How to delete a SharePoint list item:
```
$listTitle = 'Tasks';
$itemToDeleteId = 1;
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$listItem = $list->getItemById($itemToDeleteId);
$listItem->deleteObject();
$ctx->executeQuery();
```

Example 4. How to update SharePoint list item:
```
$listTitle = 'Tasks';
$itemToUpdateId = 1;
$list = $ctx->getWeb()->getLists()->getByTitle($listTitle);
$listItem = $list->getItemById($itemId);
$listItem->setProperty('PercentComplete',1);
$listItem->update();
$ctx->executeQuery();
```



### Working with Outlook API

Supported list of APIs:

-   [Outlook REST API](https://msdn.microsoft.com/en-us/office/office365/api/use-outlook-rest-api#DefineOutlookRESTAPI) 
    -   [Outlook Contacts REST API](https://msdn.microsoft.com/en-us/office/office365/api/contacts-rest-operations)
    -   [Outlook Calendar REST API](https://msdn.microsoft.com/en-us/office/office365/api/calendar-rest-operations)
    -   [Outlook Mail REST API](https://msdn.microsoft.com/en-us/office/office365/api/mail-rest-operations)

The following example demonstrates how to send a message via Outlook Mail API:

```

 $client = new OutlookClient($settings['TenantName'],function (AuthenticationContext $authCtx) {        
        $authCtx->setAccessToken("--access token goes here--");
 });
 $message = $client->getMe()->getMessages()->createMessage();
 $message->Subject = "Meet for lunch?";
 $message->Body = new ItemBody(BodyType::Text,"The new cafeteria is open.");
 $message->ToRecipients = array(
     new Recipient(new EmailAddress(null,"jdoe@contoso.onmicrosoft.com"))
 );
 $client->getMe()->sendEmail($message,true);
 $client->executeQuery();


```

### Working with OneDrive API

The following example demonstrates how retrieve my drive Url via OneDrive API:

```

$client = new GraphServiceClient($settings['TenantName'],function (AuthenticationContext $authCtx) use($settings) {
      $authCtx->setAccessToken("--access token goes here--");
});

$drive = $client->getMe()->getDrive();
$client->load($drive);
$client->executeQuery();
print $drive->getProperty("webUrl");

```
