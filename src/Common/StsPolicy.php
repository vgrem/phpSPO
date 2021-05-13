<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Entity;

class StsPolicy extends Entity
{
    /**
     * @return array
     */
    public function getDefinition()
    {
        if (!$this->isPropertyAvailable("Definition")) {
            return null;
        }
        return $this->getProperty("Definition");
    }
    /**
     * @var array
     */
    public function setDefinition($value)
    {
        $this->setProperty("Definition", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsOrganizationDefault()
    {
        if (!$this->isPropertyAvailable("IsOrganizationDefault")) {
            return null;
        }
        return $this->getProperty("IsOrganizationDefault");
    }
    /**
     * @var bool
     */
    public function setIsOrganizationDefault($value)
    {
        $this->setProperty("IsOrganizationDefault", $value, true);
    }
}