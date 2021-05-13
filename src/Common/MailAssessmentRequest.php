<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

/**
 * When you create a mail threat assessment request, the mail should be received by the user specified in `recipientEmail`. Delegated [Mail permissions](/graph/permissions-reference#mail-permissions) (Mail.Read or Mail.Read.Shared) are requried to access the mail received by the user or shared by someone else.
 */
class MailAssessmentRequest extends ClientObject
{
    /**
     * The mail recipient whose policies are used to assess the mail.
     * @return string
     */
    public function getRecipientEmail()
    {
        if (!$this->isPropertyAvailable("RecipientEmail")) {
            return null;
        }
        return $this->getProperty("RecipientEmail");
    }
    /**
     * The mail recipient whose policies are used to assess the mail.
     * @var string
     */
    public function setRecipientEmail($value)
    {
        $this->setProperty("RecipientEmail", $value, true);
    }
    /**
     * The resource URI of the mail message for assessment.
     * @return string
     */
    public function getMessageUri()
    {
        if (!$this->isPropertyAvailable("MessageUri")) {
            return null;
        }
        return $this->getProperty("MessageUri");
    }
    /**
     * The resource URI of the mail message for assessment.
     * @var string
     */
    public function setMessageUri($value)
    {
        $this->setProperty("MessageUri", $value, true);
    }
}