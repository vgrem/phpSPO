<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OutlookServices;

/**
 *  "A file (such as a text file or Word document) attached to an event, message or post. The  **contentBytes** "
 */
class FileAttachment extends Attachment
{
    /**
     * The ID of the attachment in the Exchange store.
     * @return string
     */
    public function getContentId()
    {
        return $this->getProperty("ContentId");
    }
    /**
     * The ID of the attachment in the Exchange store.
     * @var string
     */
    public function setContentId($value)
    {
        $this->setProperty("ContentId", $value, true);
    }
    /**
     * Do not use this property as it is not supported.
     * @return string
     */
    public function getContentLocation()
    {
        return $this->getProperty("ContentLocation");
    }
    /**
     * Do not use this property as it is not supported.
     * @var string
     */
    public function setContentLocation($value)
    {
        $this->setProperty("ContentLocation", $value, true);
    }
    /**
     * The base64-encoded contents of the file.
     * @return string
     */
    public function getContentBytes()
    {
        return $this->getProperty("ContentBytes");
    }

    /**
     * The base64-encoded contents of the file.
     *
     * @return self
     * @var string
     */
    public function setContentBytes($value)
    {
        return $this->setProperty("ContentBytes", $value, true);
    }
}