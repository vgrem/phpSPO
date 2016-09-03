<?php


namespace Office365\PHP\Client\OutlookServices;

use Office365\PHP\Client\Runtime\ClientActionInvokePostMethod;


/**
 * A message in a mailbox folder.
 */
class Message extends OutlookEntity
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
     * The body of the message.
     * @var ItemBody
     */
    public $Body;

    /**
     * The subject of the message.
     * @var string
     */
    public $Subject;


    /**
     * The To recipients for the message.
     * @var array
     */
    public $ToRecipients;



}