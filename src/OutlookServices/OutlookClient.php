<?php

namespace Office365\PHP\Client\OutlookServices;


use Office365\PHP\Client\Runtime\ClientAction;
use Office365\PHP\Client\Runtime\ClientActionType;
use Office365\PHP\Client\Runtime\ClientRuntimeContext;
use Office365\PHP\Client\Runtime\Auth\IAuthenticationContext;
use Office365\PHP\Client\Runtime\HttpMethod;
use Office365\PHP\Client\Runtime\ResourcePathEntity;
use Office365\PHP\Client\Runtime\OData\JsonFormat;
use Office365\PHP\Client\Runtime\OData\ODataMetadataLevel;
use Office365\PHP\Client\Runtime\Utilities\RequestOptions;

require_once(__DIR__ . '/../Runtime/Auth/NetworkCredentialContext.php');
require_once(__DIR__ . '/../Runtime/ClientRuntimeContext.php');
require_once(__DIR__ . '/../Runtime/Utilities/RequestOptions.php');
require_once(__DIR__ . '/../Runtime/OData/JsonFormat.php');
require_once('OutlookEntity.php');
require_once('CalendarColor.php');
require_once('DateTimeTimeZone.php');
require_once('Item.php');
require_once('ItemCollection.php');
require_once('Attachment.php');
require_once('AttachmentCollection.php');
require_once('FileAttachment.php');
require_once('FileAttachmentCollection.php');
require_once('Calendar.php');
require_once('CalendarCollection.php');
require_once('BodyType.php');
require_once('ItemBody.php');
require_once('User.php');
require_once('UserCollection.php');
require_once('Group.php');
require_once('GroupCollection.php');
require_once('EmailAddress.php');
require_once('Location.php');
require_once('Contact.php');
require_once('ContactCollection.php');
require_once('Event.php');
require_once('EventCollection.php');
require_once('Message.php');
require_once('MessageCollection.php');
require_once('Recipient.php');
require_once('Attendee.php');
require_once('OperationParameterCollection.php');

/**
 * Outlook Services OData client
 */
class OutlookClient extends ClientRuntimeContext
{

    public function __construct(IAuthenticationContext $authContext)
    {
        parent::__construct($this->serviceRootUrl, $authContext,new JsonFormat(ODataMetadataLevel::Verbose));
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
        if ($query->ActionType == ClientActionType::UpdateEntity) {
            $request->Method = HttpMethod::Patch;
        } else if ($query->ActionType == ClientActionType::DeleteEntity) {
            $request->Method = HttpMethod::Delete;
        }
    }



    /**
     * @return User
     */
    public function getMe(){
        if(!isset($this->me))
            $this->me = new User($this,new ResourcePathEntity($this,null,"me"));
        return $this->me;
    }


    /**
     * @return UserCollection
     */
    public function getUsers(){
        if(!isset($this->users))
            $this->users = new UserCollection($this,new ResourcePathEntity($this,null,"Users"));
        return $this->users;
    }


    /**
     * @return GroupCollection
     */
    public function getGroups(){
        if(!isset($this->groups))
            $this->groups = new GroupCollection($this,new ResourcePathEntity($this,null,"Groups"));
        return $this->groups;
    }


    /**
     * @var string
     */
    private $serviceRootUrl = "https://outlook.office365.com/api/v1.0/";


    /**
     * @var User
     */
    private $me;


    /**
     * @var UserCollection
     */
    private $users;


    /**
     * @var GroupCollection
     */
    private $groups;

}

