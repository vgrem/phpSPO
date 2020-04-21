<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T18:33:00+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint\UI\ApplicationPages;

use Office365\PHP\Client\Runtime\ClientObject;



class PickerEntityInformation extends ClientObject
{
    /**
     * @return PickerEntityInformationRequest
     */
    public function getEntity()
    {
        if (!$this->isPropertyAvailable("Entity")) {
            return null;
        }
        return $this->getProperty("Entity");
    }
    /**
     * @var PickerEntityInformationRequest
     */
    public function setEntity($value)
    {
        $this->setProperty("Entity", $value, true);
    }
    /**
     * @return integer
     */
    public function getTotalMemberCount()
    {
        if (!$this->isPropertyAvailable("TotalMemberCount")) {
            return null;
        }
        return $this->getProperty("TotalMemberCount");
    }
    /**
     * @var integer
     */
    public function setTotalMemberCount($value)
    {
        $this->setProperty("TotalMemberCount", $value, true);
    }
}