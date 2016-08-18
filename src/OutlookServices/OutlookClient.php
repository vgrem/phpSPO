<?php

use SharePoint\PHP\Client\IAuthenticationContext;
use SharePoint\PHP\Client\Runtime\JsonFormat;
use SharePoint\PHP\Client\Runtime\ODataMetadataLevel;

require_once(__DIR__ . '/../Runtime/Auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../Runtime/ClientRuntimeContext.php');
require_once(__DIR__ . '/../Runtime/Utilities/RequestOptions.php');
require_once(__DIR__ . '/../Runtime/OData/JsonFormat.php');
require_once('Contact.php');
require_once('ContactCollection.php');

class OutlookClient extends \SharePoint\PHP\Client\ClientRuntimeContext
{

    public function __construct(IAuthenticationContext $authContext)
    {
        parent::__construct($this->serviceRootUrl, $authContext,new JsonFormat(ODataMetadataLevel::Verbose));
        $this->rootResourcePath = new \SharePoint\PHP\Client\ResourcePathEntity($this,null,"me");
    }

    public function getMyContacts(){
        $contacts = new ContactCollection($this,new \SharePoint\PHP\Client\ResourcePathEntity(
            $this,
            $this->rootResourcePath,
            "contacts"
        ));
        return $contacts;
    }

    /**
     * @var \SharePoint\PHP\Client\ResourcePath
     */
    private $rootResourcePath;


    /**
     * @var string
     */
    private $serviceRootUrl = "https://outlook.office365.com/api/v1.0/";

}

