<?php


namespace Office365\PHP\Client\OutlookServices;
use Office365\PHP\Client\Runtime\ClientValueObject;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;


/**
 * A message in a mailbox folder.
 */
class Message extends Item
{

    /**
     * Reply to the sender of a message by specifying a comment and using the Reply method.
     * @param string $comment
     */
    public function reply($comment)
    {
        $parameter = new ClientValueObject();
        $parameter->setProperty("Comment",$comment);
        $qry = new InvokePostMethodQuery($this->getResourcePath(),"Reply",null,$parameter);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Reply to the sender of a message by specifying a comment and using the Reply method.
     * @param string $comment
     */
    public function replyAll($comment)
    {
        $parameter = new ClientValueObject();
        $parameter->setProperty("Comment",$comment);
        $qry = new InvokePostMethodQuery($this->getResourcePath(),"ReplyAll",null,$parameter);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Forward a message by using the Forward method and optionally specifying a comment.
     * @param string $comment
     * @param array $toRecipients
     */
    public function forward($comment,$toRecipients)
    {
        $parameter = new ClientValueObject();
        $parameter->setProperty("Comment",$comment);
        $parameter->setProperty("ToRecipients",$toRecipients);
        $qry = new InvokePostMethodQuery($this->getResourcePath(),"Forward",null,$parameter);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Move a message to a folder. This creates a new copy of the message in the destination folder.
     * @param string $destinationId The destination folder ID, or the Inbox, Drafts, SentItems, or
     * DeletedItems well-known folder name.
     */
    public function move($destinationId){
        $parameter = new ClientValueObject();
        $parameter->setProperty("DestinationId",$destinationId);
        $qry = new InvokePostMethodQuery($this->getResourcePath(),"Move",null,$parameter);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Marks a message as read/unread
     * @param bool $isRead whether or not the message is read
     */
    public function read($isRead)
    {
        $this->setProperty("IsRead", $isRead);
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }

    /**
     * Marks a message as important/unimportant
     * @param int $importance importance level (1,2,3)
     */
    public function important($importance)
    {
        $this->setProperty("Importance", $importance);
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }

    /**
     * @param $attachmentType
     * @return Attachment
     */
    public function addAttachment($attachmentType){
        $attachment = new $attachmentType($this->getContext());
        $this->Attachments[] = $attachment;
        return $attachment;
    }


    /**
     * The FileAttachment and ItemAttachment attachments for the message.
     * @var array
     */
    public $Attachments;


    /**
     * The Bcc recipients for the message.
     * @var array
     */
    public $BccRecipients;



    /**
     * The body of the message.
     * @var ItemBody
     */
    public $Body;


    /**
     * The first 255 characters of the message body content.
     * @var string
     */
    public $BodyPreview;


    /**
     * The categories associated with the message.
     * @var array
     */
    public $Categories;

    /**
     * The subject of the message.
     * @var string
     */
    public $Subject;


    /**
     * The Cc recipients for the message.
     * @var array
     */
    public $CcRecipients;

    /**
     * The To recipients for the message.
     * @var array
     */
    public $ToRecipients;


    /**
     * The ID of the conversation the email belongs to.
     * @var string
     */
    public $ConversationId;


    /**
     * Indicates whether the message has attachments.
     * @var bool
     */
    public $HasAttachments;


    /**
     * The mailbox owner and sender of the message.
     * @var Recipient
     */
    public $From;


    /**
     * The importance of the message
     * @var string
     */
    public $Importance;


    /**
     * The classification of this message for the user,
     * based on inferred relevance or importance, or on an explicit override.
     * @var int
     */
    public $InferenceClassification;

    /**
     * The account that is actually used to generate the message.
     * @var Recipient
     */
    public $Sender;


    /**
     * Indicates whether the message is a draft. A message is a draft if it hasn't been sent yet.
     * @var bool
     */
    public $IsDraft;


    /**
     * Indicates whether a read receipt is requested for the message.
     * @var bool
     */
    public $IsReadReceiptRequested;


    /**
     * Indicates whether a read receipt is requested for the message.
     * @var bool
     */
    public $IsDeliveryReceiptRequested;


    /**
     * The email addresses to use when replying.
     * @var array
     */
    public $ReplyTo;


    /**
     * The URL to open the message in Outlook Web App.
     * @var string
     */
    public $WebLink;


    /**
     * The collection of open type data extensions defined for the message. Navigation property.
     * @var array
     */
    public $Extensions;

}