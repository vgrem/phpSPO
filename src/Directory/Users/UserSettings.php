<?php

/**
 *  2025-08-21T20:35:45+00:00 
 */
namespace Office365\Directory\Users;

use Office365\Entity;
use Office365\Runtime\ResourcePath;
use Office365\Teams\ShiftPreferences;

/**
 *  "The current user settings for content discovery. "
 */
class UserSettings extends Entity
{
    /**
     * When set to true, the delegate access to the user's [trending](/graph/api/resources/insights-trending?view=graph-rest-beta) API is disabled. When set to true, documents in the user's Office Delve are disabled. When set to true, the relevancy of the content displayed in Office 365, for example in Suggested sites in SharePoint Home and the Discover view in OneDrive for Business is affected. Users can control this setting in [Office Delve](https://support.office.com/en-us/article/are-my-documents-safe-in-office-delve-f5f409a2-37ed-4452-8f61-681e5e1836f3?ui=en-US&rs=en-US&ad=US#bkmk_optout). 
     * @return bool
     */
    public function getContributionToContentDiscoveryDisabled()
    {
        if (!$this->isPropertyAvailable("ContributionToContentDiscoveryDisabled")) {
            return null;
        }
        return $this->getProperty("ContributionToContentDiscoveryDisabled");
    }
    /**
     * When set to true, the delegate access to the user's [trending](/graph/api/resources/insights-trending?view=graph-rest-beta) API is disabled. When set to true, documents in the user's Office Delve are disabled. When set to true, the relevancy of the content displayed in Office 365, for example in Suggested sites in SharePoint Home and the Discover view in OneDrive for Business is affected. Users can control this setting in [Office Delve](https://support.office.com/en-us/article/are-my-documents-safe-in-office-delve-f5f409a2-37ed-4452-8f61-681e5e1836f3?ui=en-US&rs=en-US&ad=US#bkmk_optout). 
     * @var bool
     */
    public function setContributionToContentDiscoveryDisabled($value)
    {
        $this->setProperty("ContributionToContentDiscoveryDisabled", $value, true);
    }
    /**
     * Reflects the [organization level setting](https://support.office.com/en-us/article/office-delve-for-office-365-admins-54f87a42-15a4-44b4-9df0-d36287d9531b#bkmk_delveonoff) controlling delegate access to the [trending](/graph/api/resources/insights-trending?view=graph-rest-beta) API. When set to true, the organization doesn't have access to Office Delve. The relevancy of the content displayed in Office 365, for example in Suggested sites in SharePoint Home and the Discover view in OneDrive for Business is affected for the whole organization. This setting is read-only and can only be changed by administrators in the [SharePoint admin center](https://support.office.com/article/about-the-office-365-admin-center-758befc4-0888-4009-9f14-0d147402fd23?ui=en-US&rs=en-US&ad=US).
     * @return bool
     */
    public function getContributionToContentDiscoveryAsOrganizationDisabled()
    {
        if (!$this->isPropertyAvailable("ContributionToContentDiscoveryAsOrganizationDisabled")) {
            return null;
        }
        return $this->getProperty("ContributionToContentDiscoveryAsOrganizationDisabled");
    }
    /**
     * Reflects the [organization level setting](https://support.office.com/en-us/article/office-delve-for-office-365-admins-54f87a42-15a4-44b4-9df0-d36287d9531b#bkmk_delveonoff) controlling delegate access to the [trending](/graph/api/resources/insights-trending?view=graph-rest-beta) API. When set to true, the organization doesn't have access to Office Delve. The relevancy of the content displayed in Office 365, for example in Suggested sites in SharePoint Home and the Discover view in OneDrive for Business is affected for the whole organization. This setting is read-only and can only be changed by administrators in the [SharePoint admin center](https://support.office.com/article/about-the-office-365-admin-center-758befc4-0888-4009-9f14-0d147402fd23?ui=en-US&rs=en-US&ad=US).
     * @var bool
     */
    public function setContributionToContentDiscoveryAsOrganizationDisabled($value)
    {
        $this->setProperty("ContributionToContentDiscoveryAsOrganizationDisabled", $value, true);
    }
    /**
     * @return ShiftPreferences
     */
    public function getShiftPreferences()
    {
        return $this->getProperty("ShiftPreferences", new ShiftPreferences($this->getContext(), new ResourcePath("ShiftPreferences", $this->getResourcePath())));
    }
}