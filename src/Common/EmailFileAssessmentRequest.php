<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientObject;

class EmailFileAssessmentRequest extends ClientObject
{
    /**
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
     * @var string
     */
    public function setRecipientEmail($value)
    {
        $this->setProperty("RecipientEmail", $value, true);
    }
    /**
     * @return string
     */
    public function getContentData()
    {
        if (!$this->isPropertyAvailable("ContentData")) {
            return null;
        }
        return $this->getProperty("ContentData");
    }
    /**
     * @var string
     */
    public function setContentData($value)
    {
        $this->setProperty("ContentData", $value, true);
    }
}