<?php

namespace Office365;

use Office365\OutlookServices\BodyType;
use Office365\OutlookServices\EmailAddress;
use Office365\OutlookServices\FileAttachment;
use Office365\OutlookServices\ItemAttachment;
use Office365\OutlookServices\ItemBody;
use Office365\OutlookServices\Message;
use Office365\OutlookServices\OutlookEntity;
use Office365\OutlookServices\Recipient;

//require_once('OutlookServicesTestCase.php');


class OutlookMailTest extends OutlookServicesTestCase
{

    public function testCreateDraftMessage(){

        $currentUser = self::$context->getMe();
        self::$context->load($currentUser);
        self::$context->executeQuery();

        $message = self::$context->getMe()->getMessages()->createMessage();
        $message->Subject = "--test--";
        $message->Body = new ItemBody(BodyType::Text,"--content goes here--");
        $message->ToRecipients = array(
            new Recipient(new EmailAddress($currentUser->getProperty("DisplayName"),$currentUser->getProperty("Id")))
        );
        self::$context->executeQuery();
        self::assertTrue($message->IsDraft);
        return $message;
    }



    /**
     * @depends testCreateDraftMessage
     * @param Message $existingMessage
     */
    public function testCreteDraftMessageWithItemAttachment(Message $existingMessage)
    {
        $message = self::$context->getMe()->getMessages()->createMessage();
        $message->Subject = $existingMessage->Subject . "(with message attachment)";
        $message->Body = $existingMessage->Body;
        $message->ToRecipients = $existingMessage->ToRecipients;
        //add existing message as an attachment
        $attachment = $message->addAttachment(ItemAttachment::getType());
        $attachment->ContentType = "message/rfc822";
        $attachment->IsInline = false;
        $attachment->Name = $existingMessage->Subject;
        $attachment->Item = $this->getLink($existingMessage);
        self::$context->executeQuery();
        self::assertTrue(true);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $existingMessage
     */
    public function testCreteDraftMessageWithFileAttachment(Message $existingMessage)
    {
        $message = self::$context->getMe()->getMessages()->createMessage();
        $message->Subject = $existingMessage->Subject . "(with file attachment)";
        $message->Body = $existingMessage->Body;
        $message->ToRecipients = $existingMessage->ToRecipients;
        //add a file attachment
        $attachmentPath = "../examples/data/attachment.txt";
        $attachment = $message->addAttachment(FileAttachment::getType());
        $attachment->ContentBytes = "bWFjIGFuZCBjaGVlc2UgdG9kYXk="; //file_get_contents($attachmentPath);
        $attachment->Name = basename($attachmentPath);
        self::$context->executeQuery();
        self::assertTrue(true);
    }


    private function getLink(OutlookEntity $entity){
        //$entity->Id = null;
        $entity->ConversationId = null;
        //$entity->addTypeAnnotation("type","#Microsoft.Outlook.Message");
        //$type = $entity->getTypeName();
        //$entity->ensureTypeAnnotation("Message");
        return $entity;
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testUpdateMessage(Message $message)
    {
        $message->setProperty("IsRead",true);
        $message->update();
        self::$context->executeQuery();

        self::$context->load($message);
        self::$context->executeQuery();
        self::assertTrue($message->getProperty("IsRead"));
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testGetMessages(Message $message){
        //verify
        $messages = self::$context->getMe()->getMessages();
        self::$context->load($messages);
        self::$context->executeQuery();

        foreach ($messages->getData() as $curMessage){
            self::assertNotNull($curMessage->Id);
        }
        $foundMessage = $messages->findFirst("Id", $message->Id);
        self::assertNotNull($foundMessage);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testForwardMessage(Message $message)
    {
        $recipients = array(
            new Recipient(new EmailAddress("",self::$testUserAccount))
        );
        $message->forward("For your consideration",$recipients);
        self::$context->executeQuery();
        self::assertTrue(true);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testSendEmail(Message $message){
        self::$context->getMe()->sendEmail($message,false);
        self::$context->executeQuery();
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
        $message->deleteObject();
        self::$context->executeQuery();

        $messages = self::$context->getMe()->getMessages();
        self::$context->load($messages);
        self::$context->executeQuery();
        $deletedMessage = $messages->findFirst("Id",$message->Id);
        self::assertNull($deletedMessage);
    }


}
