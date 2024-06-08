<?php

/**
 * Generated  2024-06-08T09:12:30+00:00 16.0.24922.12004
 */
namespace Office365\SharePoint;

class ChangeAppConsentPrincipal extends BaseEntity
{
    /**
     * @return integer
     */
    public function getAppConsentPrincipalId()
    {
        return $this->getProperty("AppConsentPrincipalId");
    }
    /**
     * @var integer
     */
    public function setAppConsentPrincipalId($value)
    {
        return $this->setProperty("AppConsentPrincipalId", $value, true);
    }
}