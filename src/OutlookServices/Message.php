<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OutlookServices;

use Office365\EntityCollection;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\Actions\UpdateEntityQuery;
use Office365\Runtime\ClientValue;
use Office365\Runtime\ClientValueCollection;

/**
 *  "A message in a mailFolder."
 */
class Message extends OutlookItem
{

    /**
     * @param $attachmentType
     * @return ItemAttachment|FileAttachment|ReferenceAttachment
     */
    public function addAttachment($attachmentType)
    {
        $attachment = new $attachmentType($this->getContext());
        $this->getAttachments()->addChild($attachment);
        return $attachment;
    }

    /**
     * Reply to the sender of a message by specifying a comment and using the Reply method.
     * @param string $comment
     */
    public function reply($comment)
    {
        $parameter = new ClientValue();
        $parameter->setProperty("Comment", $comment);
        $qry = new InvokePostMethodQuery($this, "Reply", null, null, $parameter);
        $this->getContext()->addQuery($qry);
    }
    /**
     * Reply to the sender of a message by specifying a comment and using the Reply method.
     * @param string $comment
     */
    public function replyAll($comment)
    {
        $parameter = new ClientValue();
        $parameter->setProperty("Comment", $comment);
        $qry = new InvokePostMethodQuery($this, "ReplyAll", null, null, $parameter);
        $this->getContext()->addQuery($qry);
    }
    /**
     * Forward a message by using the Forward method and optionally specifying a comment.
     * @param string $comment
     * @param array $toRecipients
     */
    public function forward($comment, $toRecipients)
    {
        $parameter = array();
        $parameter["Comment"] = $comment;
        $parameter["ToRecipients"] = $toRecipients;
        $qry = new InvokePostMethodQuery($this, "Forward", null, null, $parameter);
        $this->getContext()->addQuery($qry);
        return $this;
    }
    /**
     * Move a message to a folder. This creates a new copy of the message in the destination folder.
     * @param string $destinationId The destination folder ID, or the Inbox, Drafts, SentItems, or
     * DeletedItems well-known folder name.
     */
    public function move($destinationId)
    {
        $parameter = new ClientValue();
        $parameter->setProperty("DestinationId", $destinationId);
        $qry = new InvokePostMethodQuery($this, "Move", null, null, $parameter);
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
     * Indicates whether the message has attachments. This property doesn't include inline attachments, so if a message contains only inline attachments, this property is false. To verify the existence of inline attachments, parse the **body** property to look for a `src` attribute, such as `<IMG src="cid:image001.jpg@01D26CD8.6C05F070">`.
     * @return bool
     */
    public function getHasAttachments()
    {
        return $this->getProperty("HasAttachments");
    }
    /**
     * Indicates whether the message has attachments. This property doesn't include inline attachments, so if a message contains only inline attachments, this property is false. To verify the existence of inline attachments, parse the **body** property to look for a `src` attribute, such as `<IMG src="cid:image001.jpg@01D26CD8.6C05F070">`.
     * @var bool
     */
    public function setHasAttachments($value)
    {
        $this->setProperty("HasAttachments", $value, true);
    }
    /**
     * @return string
     */
    public function getInternetMessageId()
    {
        return $this->getProperty("InternetMessageId");
    }
    /**
     * @var string
     */
    public function setInternetMessageId($value)
    {
        $this->setProperty("InternetMessageId", $value, true);
    }
    /**
     * The subject of the message.
     * @return string
     */
    public function getSubject()
    {
        return $this->getProperty("Subject");
    }
    /**
     * The subject of the message.
     * @var string
     */
    public function setSubject($value)
    {
        $this->setProperty("Subject", $value, true);
    }
    /**
     * The first 255 characters of the message body. It is in text format.
     * @return string
     */
    public function getBodyPreview()
    {
        return $this->getProperty("BodyPreview");
    }
    /**
     * The first 255 characters of the message body. It is in text format.
     * @var string
     */
    public function setBodyPreview($value)
    {
        $this->setProperty("BodyPreview", $value, true);
    }
    /**
     * The unique identifier for the message's parent mailFolder.
     * @return string
     */
    public function getParentFolderId()
    {
        return $this->getProperty("ParentFolderId");
    }
    /**
     * The unique identifier for the message's parent mailFolder.
     * @var string
     */
    public function setParentFolderId($value)
    {
        $this->setProperty("ParentFolderId", $value, true);
    }
    /**
     * The account that is actually used to generate the message. In most cases, this value is the same as the **from** property. You can set this property to a different value when sending a message from a [shared mailbox](/exchange/collaboration/shared-mailboxes/shared-mailboxes), [for a shared calendar, or as a delegate](/graph/outlook-share-delegate-calendar.md). In any case, the value must correspond to the actual mailbox used. Find out more about [setting the from and sender properties](/graph/outlook-create-send-messages#setting-the-from-and-sender-properties) of a message.
     * @return Recipient
     */
    public function getSender()
    {
        return $this->getProperty("Sender", new Recipient());
    }
    /**
     * The account that is actually used to generate the message. In most cases, this value is the same as the **from** property. You can set this property to a different value when sending a message from a [shared mailbox](/exchange/collaboration/shared-mailboxes/shared-mailboxes), [for a shared calendar, or as a delegate](/graph/outlook-share-delegate-calendar.md). In any case, the value must correspond to the actual mailbox used. Find out more about [setting the from and sender properties](/graph/outlook-create-send-messages#setting-the-from-and-sender-properties) of a message.
     * @var Recipient
     */
    public function setSender($value)
    {
        $this->setProperty("Sender", $value, true);
    }
    /**
     * The owner of the mailbox from which the message is sent. In most cases, this value is the same as the **sender** property, except for sharing or delegation scenarios. The value must correspond to the actual mailbox used. Find out more about [setting the from and sender properties](/graph/outlook-create-send-messages#setting-the-from-and-sender-properties) of a message.
     * @return Recipient
     */
    public function getFrom()
    {
        return $this->getProperty("From", new Recipient());
    }
    /**
     * The owner of the mailbox from which the message is sent. In most cases, this value is the same as the **sender** property, except for sharing or delegation scenarios. The value must correspond to the actual mailbox used. Find out more about [setting the from and sender properties](/graph/outlook-create-send-messages#setting-the-from-and-sender-properties) of a message.
     * @var Recipient
     */
    public function setFrom($value)
    {
        $this->setProperty("From", $value, true);
    }
    /**
     * The ID of the conversation the email belongs to.
     * @return string
     */
    public function getConversationId()
    {
        return $this->getProperty("ConversationId");
    }
    /**
     * The ID of the conversation the email belongs to.
     * @var string
     */
    public function setConversationId($value)
    {
        $this->setProperty("ConversationId", $value, true);
    }
    /**
     * Indicates the position of the message within the conversation.
     * @return string
     */
    public function getConversationIndex()
    {
        return $this->getProperty("ConversationIndex");
    }
    /**
     * Indicates the position of the message within the conversation.
     * @var string
     */
    public function setConversationIndex($value)
    {
        $this->setProperty("ConversationIndex", $value, true);
    }
    /**
     * Indicates whether a read receipt is requested for the message.
     * @return bool
     */
    public function getIsDeliveryReceiptRequested()
    {
        return $this->getProperty("IsDeliveryReceiptRequested");
    }
    /**
     * Indicates whether a read receipt is requested for the message.
     * @var bool
     */
    public function setIsDeliveryReceiptRequested($value)
    {
        $this->setProperty("IsDeliveryReceiptRequested", $value, true);
    }
    /**
     * Indicates whether a read receipt is requested for the message.
     * @return bool
     */
    public function getIsReadReceiptRequested()
    {
        if (!$this->isPropertyAvailable("IsReadReceiptRequested")) {
            return null;
        }
        return $this->getProperty("IsReadReceiptRequested");
    }
    /**
     * Indicates whether a read receipt is requested for the message.
     * @var bool
     */
    public function setIsReadReceiptRequested($value)
    {
        $this->setProperty("IsReadReceiptRequested", $value, true);
    }
    /**
     * Indicates whether the message has been read.
     * @return bool
     */
    public function getIsRead()
    {
        if (!$this->isPropertyAvailable("IsRead")) {
            return null;
        }
        return $this->getProperty("IsRead");
    }

    /**
     * Indicates whether the message has been read.
     *
     * @return Message
     * @var bool
     */
    public function setIsRead($value)
    {
        $this->setProperty("IsRead", $value, true);
        return $this;
    }
    /**
     * Indicates whether the message is a draft. A message is a draft if it hasn't been sent yet.
     * @return bool
     */
    public function getIsDraft()
    {
        if (!$this->isPropertyAvailable("IsDraft")) {
            return null;
        }
        return $this->getProperty("IsDraft");
    }
    /**
     * Indicates whether the message is a draft. A message is a draft if it hasn't been sent yet.
     * @var bool
     */
    public function setIsDraft($value)
    {
        $this->setProperty("IsDraft", $value, true);
    }
    /**
     * The URL to open the message in Outlook Web App.<br><br>You can append an ispopout argument to the end of the URL to change how the message is displayed. If ispopout is not present or if it is set to 1, then the message is shown in a popout window. If ispopout is set to 0, then the browser will show the message in the Outlook Web App review pane.<br><br>The message will open in the browser if you are logged in to your mailbox via Outlook Web App. You will be prompted to login if you are not already logged in with the browser.<br><br>This URL can be accessed from within an iFrame.
     * @return string
     */
    public function getWebLink()
    {
        if (!$this->isPropertyAvailable("WebLink")) {
            return null;
        }
        return $this->getProperty("WebLink");
    }
    /**
     * The URL to open the message in Outlook Web App.<br><br>You can append an ispopout argument to the end of the URL to change how the message is displayed. If ispopout is not present or if it is set to 1, then the message is shown in a popout window. If ispopout is set to 0, then the browser will show the message in the Outlook Web App review pane.<br><br>The message will open in the browser if you are logged in to your mailbox via Outlook Web App. You will be prompted to login if you are not already logged in with the browser.<br><br>This URL can be accessed from within an iFrame.
     * @var string
     */
    public function setWebLink($value)
    {
        $this->setProperty("WebLink", $value, true);
    }
    /**
     * The body of the message. It can be in HTML or text format. Find out about [safe HTML in a message body](/graph/outlook-create-send-messages#reading-messages-with-control-over-the-body-format-returned).
     * @return ItemBody
     */
    public function getBody()
    {
        return $this->getProperty("Body", new ItemBody());
    }
    /**
     * The body of the message. It can be in HTML or text format. Find out about [safe HTML in a message body](/graph/outlook-create-send-messages#reading-messages-with-control-over-the-body-format-returned).
     * @var ItemBody
     */
    public function setBody($value)
    {
        $this->setProperty("Body", $value, true);
    }
    /**
     * The part of the body of the message that is unique to the current message. **uniqueBody** is not returned by default but can be retrieved for a given message by use of the `?$select=uniqueBody` query. It can be in HTML or text format.
     * @return ItemBody
     */
    public function getUniqueBody()
    {
        return $this->getProperty("UniqueBody", new ItemBody());
    }
    /**
     * The part of the body of the message that is unique to the current message. **uniqueBody** is not returned by default but can be retrieved for a given message by use of the `?$select=uniqueBody` query. It can be in HTML or text format.
     * @var ItemBody
     */
    public function setUniqueBody($value)
    {
        $this->setProperty("UniqueBody", $value, true);
    }
    /**
     * The flag value that indicates the status, start date, due date, or completion date for the message.
     * @return FollowupFlag
     */
    public function getFlag()
    {
        return $this->getProperty("Flag");
    }
    /**
     * The flag value that indicates the status, start date, due date, or completion date for the message.
     * @var FollowupFlag
     */
    public function setFlag($value)
    {
        $this->setProperty("Flag", $value, true);
    }


    /**
     * @return ClientValueCollection
     */
    public function getToRecipients(){
        return $this->getProperty("ToRecipients",new ClientValueCollection(Recipient::class));
    }

    /**
     * @param EmailAddress[] $values
     * @return $this
     */
    public function setToRecipients($values){
        $values = array_map(function ($value) {
            if ($value instanceof EmailAddress)
                return new Recipient($value);
            else
                return $value;
        }, $values);
        return $this->setProperty("ToRecipients", ClientValueCollection::fromArray(Recipient::class,$values));
    }

    /**
     * @return EntityCollection
     */
    public function getAttachments(){
        return $this->getProperty("Attachments",
            new EntityCollection($this->getContext(),$this->getResourcePath(),Attachment::class));
    }


    public function getServerTypeName()
    {
        return parent::getServerTypeName();
    }
}