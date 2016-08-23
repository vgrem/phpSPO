<?php

namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\OData\JsonFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;

require_once(__DIR__ . '/../Runtime/Auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../Runtime/ClientRuntimeContext.php');
require_once(__DIR__ . '/../Runtime/Utilities/RequestOptions.php');
require_once(__DIR__ . '/../Runtime/OData/JsonFormat.php');
require_once('EmailAddress.php');
require_once('Contact.php');
require_once('ContactCollection.php');
require_once('Event.php');
require_once('EventCollection.php');

class OutlookClient extends ClientRuntimeContext
{

    public function __construct(IAuthenticationContext $authContext)
    {
        parent::__construct($this->serviceRootUrl, $authContext,new JsonFormat(ODataMetadataLevel::Verbose));
        $this->myResourcePath = new ResourcePathEntity($this,null,"me");
    }

    public function getMyContacts(){
        $contacts = new ContactCollection($this,new ResourcePathEntity(
            $this,
            $this->myResourcePath,
            "contacts"
        ));
        return $contacts;
    }

    /**
     * @var \Office365\PHP\Client\Runtime\ResourcePath
     */
    private $myResourcePath;


    /**
     * @var string
     */
    private $serviceRootUrl = "https://outlook.office365.com/api/v1.0/";

}

