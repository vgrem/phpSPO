<?php

namespace Office365;


use Office365\Outlook\BodyType;
use Office365\Outlook\EmailAddress;
use Office365\Outlook\ItemBody;
use Office365\Outlook\Messages\FileAttachment;
use Office365\Outlook\Messages\ItemAttachment;
use Office365\Outlook\Messages\Message;
use Office365\Outlook\Recipient;

class OutlookMailTest extends GraphTestCase
{

    public function testCreateDraftMessage(){

        $currentUser = self::$graphClient->getMe()->get()->executeQuery();
        /** @var Message $message */
        $message = self::$graphClient->getMe()->getMessages()->add();
        $message->setSubject("--test--");
        $message->setBody(new ItemBody(BodyType::Text,"--content goes here--"));
        $message->setToRecipients([new EmailAddress($currentUser->getDisplayName(),$currentUser->getUserPrincipalName())]);
        self::$graphClient->executeQuery();
        self::assertTrue($message->getIsDraft());
        return $message;
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $existingMessage
     */
    public function testCreateDraftMessageWithItemAttachment(Message $existingMessage)
    {
        /** @var Message $message */
        $message = self::$graphClient->getMe()->getMessages()->add();
        $message->setSubject($existingMessage->getSubject() . "(with message attachment)");
        $message->setBody($existingMessage->getBody());
        $message->getToRecipients()->addChild($existingMessage->getToRecipients()->getData()[0]);
        //add existing message as an attachment
        /** @var ItemAttachment $attachment */
        $attachment = $message->addAttachment(ItemAttachment::class);
        $attachment->setContentType("message/rfc822");
        $attachment->setIsInline(false);
        $attachment->setName($existingMessage->getSubject());
        $attachment->setItem($existingMessage);
        self::$graphClient->executeQuery();
        self::assertTrue(true);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $existingMessage
     */
    public function testCreteDraftMessageWithFileAttachment(Message $existingMessage)
    {
        /** @var Message $message */
        $message = self::$graphClient->getMe()->getMessages()->add();
        $message->setSubject($existingMessage->getSubject() . "(with file attachment)");
        $message->setBody($existingMessage->getBody());
        $message->getToRecipients()->addChild($existingMessage->getToRecipients()->getData()[0]);
        //add a file attachment
        $attachmentPath = "../examples/data/attachment.txt";
        $attachment = $message->addAttachment(FileAttachment::class);
        $attachment->setContentBytes("bWFjIGFuZCBjaGVlc2UgdG9kYXk="); //file_get_contents($attachmentPath);
        $attachment->setName(basename($attachmentPath));
        self::$graphClient->executeQuery();
        self::assertTrue(true);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testUpdateMessage(Message $message)
    {
        $message->setIsRead(true)->update()->executeQuery();
        self::$graphClient->load($message);
        self::$graphClient->executeQuery();
        self::assertTrue($message->getIsRead());
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testGetMessage(Message $message){
        //verify
        $foundMessage = self::$graphClient->getMe()->getMessages()->getById($message->getId())->get()->executeQuery();
        self::assertNotNull($foundMessage);
        self::assertInstanceOf(Message::class, $foundMessage);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testForwardMessage(Message $message)
    {
        $recipients = array(
            new Recipient(new EmailAddress("",self::$testAccountName))
        );
        $message->forward("For your consideration",$recipients)->executeQuery();
        self::assertTrue(true);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testSendEmail(Message $message){
        self::$graphClient->getMe()->sendEmail($message,false)->executeQuery();
        self::assertTrue(true);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    /*public function testReplyMessage(Message $message)
    {
        $message->replyAll("Sounds great!");
        self::$context->executeQuery();
    }*/


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testDeleteMyMessage(Message $message)
    {
        $message->deleteObject()->executeQuery();
        $messages = self::$graphClient->getMe()->getMessages()->get()->executeQuery();
        $deletedMessage = $messages->findFirst("Id",$message->getId());
        self::assertNull($deletedMessage);
    }


}
