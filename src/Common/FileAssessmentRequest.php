<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Common;


use Office365\Entity;

class FileAssessmentRequest extends Entity
{
    /**
     * @return string
     */
    public function getFileName()
    {
        if (!$this->isPropertyAvailable("FileName")) {
            return null;
        }
        return $this->getProperty("FileName");
    }
    /**
     * @var string
     */
    public function setFileName($value)
    {
        $this->setProperty("FileName", $value, true);
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