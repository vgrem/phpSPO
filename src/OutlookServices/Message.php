<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionDeleteEntity;
use Office365\PHP\Client\Runtime\ClientActionInvokePostMethod;
use Office365\PHP\Client\Runtime\ClientActionUpdateEntity;
use Office365\PHP\Client\Runtime\ClientObject;


class Message extends ClientObject
{

    /**
     * Reply to the sender of a message by specifying a comment and using the Reply method.
     * @param string $comment
     */
    public function reply($comment)
    {
        $payload = new OperationParameterCollection();
        $payload->add("Comment",$comment);
        $qry = new ClientActionInvokePostMethod($this,"Reply",null,$payload);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Reply to the sender of a message by specifying a comment and using the Reply method.
     * @param string $comment
     */
    public function replyAll($comment)
    {
        $payload = new OperationParameterCollection();
        $payload->add("Comment",$comment);
        $qry = new ClientActionInvokePostMethod($this,"ReplyAll",null,$payload);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Forward a message by using the Forward method and optionally specifying a comment.
     * @param string $comment
     * @param array $toRecipients
     */
    public function forward($comment,$toRecipients)
    {
        $payload = new OperationParameterCollection();
        $payload->add("Comment",$comment);
        $payload->add("ToRecipients",$toRecipients);
        $qry = new ClientActionInvokePostMethod($this,"Forward",null,$payload);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Move a message to a folder. This creates a new copy of the message in the destination folder.
     * @param string $destinationId The destination folder ID, or the Inbox, Drafts, SentItems, or
     * DeletedItems well-known folder name.
     */
    public function move($destinationId){
        $payload = new OperationParameterCollection();
        $payload->add("DestinationId",$destinationId);
        $qry = new ClientActionInvokePostMethod($this,"Move",null,$payload);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Updates a Message resource
     */
    public function update()
    {
        $qry = new ClientActionUpdateEntity($this);
        $this->getContext()->addQuery($qry);
    }


    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }


    function setProperty($name, $value, $persistChanges = true)
    {
        if($name == "Id"){
            if(is_null($this->getResourcePath()))
                $this->setResourceUrl($this->parentCollection->getResourcePath()->toUrl() . "/" . $value);
            $this->{$name} = $value;
        }
        else
            parent::setProperty($name, $value, $persistChanges);
    }

    /**
     * @var ItemBody
     */
    public $Body;

    /**
     * @var string
     */
    public $Subject;


    public $Id;

}