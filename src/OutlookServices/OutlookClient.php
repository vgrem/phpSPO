<?php

namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientActionType;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\OData\JsonFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

require_once(__DIR__ . '/../Runtime/Auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../Runtime/ClientRuntimeContext.php');
require_once(__DIR__ . '/../Runtime/Utilities/RequestOptions.php');
require_once(__DIR__ . '/../Runtime/OData/JsonFormat.php');
require_once('BodyType.php');
require_once('ItemBody.php');
require_once('User.php');
require_once('EmailAddress.php');
require_once('Contact.php');
require_once('ContactCollection.php');
require_once('Event.php');
require_once('EventCollection.php');
require_once('Message.php');

/**
 * Office 365 client
 * @package Office365\PHP\Client\OutlookServices
 */
class OutlookClient extends ClientRuntimeContext
{

    public function __construct(IAuthenticationContext $authContext)
    {
        parent::__construct($this->serviceRootUrl, $authContext,new JsonFormat(ODataMetadataLevel::Verbose));
        $this->me = new User($this,new ResourcePathEntity($this,null,"me"));
    }



    /**
     * Submits query to Outlook REST/OData service
     */
    public function executeQuery()
    {
        $this->getPendingRequest()->beforeExecuteQuery(function (RequestOptions $request,ClientAction $query){
            $this->prepareOutlookServicesRequest($request,$query);
        });
        parent::executeQuery();
    }


    private function prepareOutlookServicesRequest(RequestOptions $request,ClientAction $query)
    {
        //set data modification headers
        if ($query->ActionType == ClientActionType::Update) {
            //$request->addCustomHeader("IF-MATCH", "*");
            //$request->addCustomHeader("X-HTTP-Method", "MERGE");
        } else if ($query->ActionType == ClientActionType::Delete) {
            //$request->addCustomHeader("IF-MATCH", "*");
            //$request->addCustomHeader("X-HTTP-Method", "DELETE");
        }
    }



    /**
     * @return User
     */
    public function getMe(){
        return $this->me;
    }


    /**
     * @var string
     */
    private $serviceRootUrl = "https://outlook.office365.com/api/v1.0/";


    /**
     * @var User
     */
    private $me;



}

