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

Example 1. How to read SharePoint list items:

```php
use Office365\SharePoint\ClientContext;
use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ListItem;

$credentials = new ClientCredential("{client-id}", "{client-secret}");
$client = (new ClientContext("https://{your-tenant-prefix}.sharepoint.com"))->withCredentials($credentials);     

$web = $client->getWeb();
$list = $web->getLists()->getByTitle("{list-title}"); //init List resource
$items = $list->getItems();  //prepare a query to retrieve from the 
$client->load($items);  //save a query to retrieve list items from the server 
$client->executeQuery(); //submit query to SharePoint Online REST service
/** @var ListItem $item */
foreach($items as $item) {
    print "Task: {$item->getProperty('Title')}\r\n";
}
```


or via Fluent API syntax:

```php
use Office365\SharePoint\ClientContext;
use Office365\Runtime\Auth\ClientCredential;
use Office365\SharePoint\ListItem;

$credentials = new ClientCredential("{client-id}", "{client-secret}");
$client = (new ClientContext("https://{your-tenant-prefix}.sharepoint.com"))->withCredentials($credentials);     

$items = $client->getWeb()
                ->getLists()
                ->getByTitle("{list-title}") 
                ->getItems()
                ->get()
                ->executeQuery();      
/** @var ListItem $item */
foreach($items as $item) {
    print "Task: {$item->getProperty('Title')}\r\n";
}
```


Example 2. How to create SharePoint list item:
```php
use Office365\SharePoint\ClientContext;
use Office365\Runtime\Auth\ClientCredential;

$credentials = new ClientCredential("{client-id}", "{client-secret}");
$client = (new ClientContext("https://{your-tenant-prefix}.sharepoint.com"))->withCredentials($credentials);

$list = $client->getWeb()->getLists()->getByTitle("Tasks");
$itemProperties = array('Title' => 'Order Approval', 'Body' => 'Order approval task');
$item = $list->addItem($itemProperties);
$client->executeQuery();
print "Task {$item->getProperty('Title')} has been created.\r\n";
```

Example 3. How to delete a SharePoint list item:
```php
use Office365\SharePoint\ClientContext;
use Office365\Runtime\Auth\ClientCredential;

$credentials = new ClientCredential("{client-id}", "{client-secret}");
$client = (new ClientContext("https://{your-tenant-prefix}.sharepoint.com"))->withCredentials($credentials);

$list = $client->getWeb()->getLists()->getByTitle("Tasks");
$listItem = $list->getItemById("{item-id-to-delete}");
$listItem->deleteObject();
$client->executeQuery();
```

Example 4. How to update SharePoint list item:
```php
use Office365\SharePoint\ClientContext;
use Office365\Runtime\Auth\ClientCredential;

$credentials = new ClientCredential("{client-id}", "{client-secret}");
$client = (new ClientContext("https://{your-tenant-prefix}.sharepoint.com"))->withCredentials($credentials);

$list = $client->getWeb()->getLists()->getByTitle("Tasks");
$listItem = $list->getItemById("{item-id-to-update}");
$listItem->setProperty('PercentComplete',1);
$listItem->update();
$client->executeQuery();
```



### Working with Outlook API

Supported list of APIs:

-   [Outlook REST API](https://msdn.microsoft.com/en-us/office/office365/api/use-outlook-rest-api#DefineOutlookRESTAPI) 
    -   [Outlook Contacts REST API](https://msdn.microsoft.com/en-us/office/office365/api/contacts-rest-operations)
    -   [Outlook Calendar REST API](https://msdn.microsoft.com/en-us/office/office365/api/calendar-rest-operations)
    -   [Outlook Mail REST API](https://msdn.microsoft.com/en-us/office/office365/api/mail-rest-operations)

The following example demonstrates how to send a message via Outlook Mail API:

```php
 use Office365\Runtime\Auth\AuthenticationContext;
 use Office365\OutlookServices\OutlookClient;
 use Office365\OutlookServices\ItemBody;
 use Office365\OutlookServices\BodyType;
 use Office365\OutlookServices\EmailAddress;
 use Office365\OutlookServices\Recipient;

 $tenantNameOrId = "{tenant}.onmicrosoft.com";
 $client = new OutlookClient($tenantNameOrId,function (AuthenticationContext $authCtx) {        
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

The following example demonstrates how retrieve My drive Url via OneDrive API:

```php
use Office365\Runtime\Auth\AuthenticationContext;
use Office365\Graph\GraphServiceClient;

$tenantNameOrId = "{tenant}.onmicrosoft.com";
$client = new GraphServiceClient($tenantNameOrId,function (AuthenticationContext $authCtx) {
      $authCtx->setAccessToken("{access-token}");
});

$drive = $client->getMe()->getDrive();
$client->load($drive);
$client->executeQuery();
print $drive->getProperty("webUrl");

```


