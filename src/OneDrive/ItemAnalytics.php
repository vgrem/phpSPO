<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Entity;

use Office365\Runtime\ResourcePath;
class ItemAnalytics extends Entity
{
    /**
     * @return ItemActivityStat
     */
    public function getAllTime()
    {
        if (!$this->isPropertyAvailable("AllTime")) {
            $this->setProperty("AllTime", new ItemActivityStat($this->getContext(), new ResourcePath("AllTime", $this->getResourcePath())));
        }
        return $this->getProperty("AllTime");
    }
    /**
     * @return ItemActivityStat
     */
    public function getLastSevenDays()
    {
        if (!$this->isPropertyAvailable("LastSevenDays")) {
            $this->setProperty("LastSevenDays", new ItemActivityStat($this->getContext(), new ResourcePath("LastSevenDays", $this->getResourcePath())));
        }
        return $this->getProperty("LastSevenDays");
    }
}