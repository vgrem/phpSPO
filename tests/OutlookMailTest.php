<?php
use Office365\PHP\Client\OutlookServices\BodyType;
use Office365\PHP\Client\OutlookServices\EmailAddress;
use Office365\PHP\Client\OutlookServices\FileAttachment;
use Office365\PHP\Client\OutlookServices\ItemBody;
use Office365\PHP\Client\OutlookServices\Message;
use Office365\PHP\Client\OutlookServices\Recipient;

require_once('OutlookServicesTestCase.php');


class OutlookMailTest extends OutlookServicesTestCase
{

    public function testCreateDraftMessage(){

        $currentUser = self::$context->getMe();
        self::$context->load($currentUser);
        self::$context->executeQuery();

        $message = self::$context->getMe()->getMessages()->createMessage();
        $message->Subject = "--test--";
        $message->Body = new ItemBody(BodyType::Text,"--Content goes here--");
        $message->ToRecipients = array(
            new Recipient(new EmailAddress($currentUser->getProperty("DisplayName"),$currentUser->getProperty("Id")))
        );
        //add a file attachment
        /*$attachmentPath = "../examples/data/attachment.txt";
        $attachment = $message->getAttachments()->createAttachment(FileAttachment::getType());
        $attachment->ContentBytes = "bWFjIGFuZCBjaGVlc2UgdG9kYXk="; //file_get_contents($attachmentPath);
        $attachment->Name = basename($attachmentPath);
        $attachment->addAnnotation("type","#Microsoft.OutlookServices.FileAttachment");*/
        self::$context->executeQuery();
        return $message;
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
        $foundMessage = $messages->getItemById($message->Id);
        self::assertNotNull($foundMessage);
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testForwardMessage(Message $message)
    {
        $recipients = array(
            new Recipient(new EmailAddress("","jdoe@contoso.onmicrosoft.com"))
        );
        $message->forward("For your consideration",$recipients);
        self::$context->executeQuery();
    }


    /**
     * @depends testCreateDraftMessage
     * @param Message $message
     */
    public function testSendEmail(Message $message){
        self::$context->getMe()->sendEmail($message,false);
        self::$context->executeQuery();
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
        $deletedMessage = $messages->getItemById($message->getProperty("Id"));
        self::assertNull($deletedMessage);
    }


}
