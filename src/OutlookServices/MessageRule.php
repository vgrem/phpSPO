<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;

/**
 *  "A rule that applies to messages in the Inbox of a user."
 */
class MessageRule extends Entity
{
    /**
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return integer
     */
    public function getSequence()
    {
        if (!$this->isPropertyAvailable("Sequence")) {
            return null;
        }
        return $this->getProperty("Sequence");
    }
    /**
     * @var integer
     */
    public function setSequence($value)
    {
        $this->setProperty("Sequence", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsEnabled()
    {
        if (!$this->isPropertyAvailable("IsEnabled")) {
            return null;
        }
        return $this->getProperty("IsEnabled");
    }
    /**
     * @var bool
     */
    public function setIsEnabled($value)
    {
        $this->setProperty("IsEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getHasError()
    {
        if (!$this->isPropertyAvailable("HasError")) {
            return null;
        }
        return $this->getProperty("HasError");
    }
    /**
     * @var bool
     */
    public function setHasError($value)
    {
        $this->setProperty("HasError", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsReadOnly()
    {
        if (!$this->isPropertyAvailable("IsReadOnly")) {
            return null;
        }
        return $this->getProperty("IsReadOnly");
    }
    /**
     * @var bool
     */
    public function setIsReadOnly($value)
    {
        $this->setProperty("IsReadOnly", $value, true);
    }
    /**
     * @return MessageRulePredicates
     */
    public function getConditions()
    {
        if (!$this->isPropertyAvailable("Conditions")) {
            return null;
        }
        return $this->getProperty("Conditions");
    }
    /**
     * @var MessageRulePredicates
     */
    public function setConditions($value)
    {
        $this->setProperty("Conditions", $value, true);
    }
    /**
     * @return MessageRuleActions
     */
    public function getActions()
    {
        if (!$this->isPropertyAvailable("Actions")) {
            return null;
        }
        return $this->getProperty("Actions");
    }
    /**
     * @var MessageRuleActions
     */
    public function setActions($value)
    {
        $this->setProperty("Actions", $value, true);
    }
    /**
     * @return MessageRulePredicates
     */
    public function getExceptions()
    {
        if (!$this->isPropertyAvailable("Exceptions")) {
            return null;
        }
        return $this->getProperty("Exceptions");
    }
    /**
     * @var MessageRulePredicates
     */
    public function setExceptions($value)
    {
        $this->setProperty("Exceptions", $value, true);
    }
}