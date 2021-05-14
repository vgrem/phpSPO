<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Excel;

use Office365\Entity;

/**
 * Represents a comment in workbook.
 */
class WorkbookComment extends Entity
{
    /**
     * The content of comment.
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
     * The content of comment.
     * @var string
     */
    public function setContent($value)
    {
        $this->setProperty("Content", $value, true);
    }
    /**
     * Indicates the type for the comment.
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
     * Indicates the type for the comment.
     * @var string
     */
    public function setContentType($value)
    {
        $this->setProperty("ContentType", $value, true);
    }
}