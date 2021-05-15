<?php

/**
 * Modified: 2020-05-26T22:07:25+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 *  "You can add related content to an event,"
 */
class Attachment extends Entity
{
    /**
     * The attachment's file name.
     * @return string
     */
    public function getName()
    {
        return $this->getProperty("Name");
    }
    /**
     * The attachment's file name.
     * @var string
     */
    public function setName($value)
    {
        $this->setProperty("Name", $value, true);
    }
    /**
     * The MIME type.
     * @return string
     */
    public function getContentType()
    {
        return $this->getProperty("ContentType");
    }
    /**
     * The MIME type.
     * @var string
     */
    public function setContentType($value)
    {
        $this->setProperty("ContentType", $value, true);
    }
    /**
     * The length of the attachment in bytes.
     * @return integer
     */
    public function getSize()
    {
        return $this->getProperty("Size");
    }
    /**
     * The length of the attachment in bytes.
     * @var integer
     */
    public function setSize($value)
    {
        $this->setProperty("Size", $value, true);
    }
    /**
     * `true` if the attachment is an inline attachment; otherwise, `false`.
     * @return bool
     */
    public function getIsInline()
    {
        return $this->getProperty("IsInline");
    }
    /**
     * `true` if the attachment is an inline attachment; otherwise, `false`.
     * @var bool
     */
    public function setIsInline($value)
    {
        $this->setProperty("IsInline", $value, true);
    }
}