<?php

/**
 * Modified: 2020-05-26T22:05:50+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;
class WorkbookCommentReply extends Entity
{
    /**
     * @return string
     */
    public function getContent()
    {
        if (!$this->isPropertyAvailable("Content")) {
            return null;
        }
        return $this->getProperty("Content");
    }
    /**
     * @var string
     */
    public function setContent($value)
    {
        $this->setProperty("Content", $value, true);
    }
    /**
     * @return string
     */
    public function getContentType()
    {
        if (!$this->isPropertyAvailable("ContentType")) {
            return null;
        }
        return $this->getProperty("ContentType");
    }
    /**
     * @var string
     */
    public function setContentType($value)
    {
        $this->setProperty("ContentType", $value, true);
    }
}