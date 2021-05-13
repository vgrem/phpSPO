<?php

/**
 * Modified: 2021-03-12T16:05:00+00:00 16.0.21103.12002
 */
namespace Office365\SharePoint\Sharing;

use Office365\Runtime\ClientObject;
/**
 * Represents 
 * a response for 
 * Microsoft.SharePoint.Client.Sharing.SecurableObjectExtensions.GetSharingInformation.The accessRequestSettings, domainRestrictionSettings and 
 * permissionsInformation properties are not included in the default 
 * scalar property set for this type.
 */
class SharingInformation extends ClientObject
{
    /**
     * @return AccessRequestSettings
     */
    public function getaccessRequestSettings()
    {
        if (!$this->isPropertyAvailable("accessRequestSettings")) {
            return null;
        }
        return $this->getProperty("accessRequestSettings");
    }
    /**
     * @var AccessRequestSettings
     */
    public function setaccessRequestSettings($value)
    {
        $this->setProperty("accessRequestSettings", $value, true);
    }
    /**
     * @return integer
     */
    public function getanonymousLinkExpirationRestrictionDays()
    {
        if (!$this->isPropertyAvailable("anonymousLinkExpirationRestrictionDays")) {
            return null;
        }
        return $this->getProperty("anonymousLinkExpirationRestrictionDays");
    }
    /**
     * @var integer
     */
    public function setanonymousLinkExpirationRestrictionDays($value)
    {
        $this->setProperty("anonymousLinkExpirationRestrictionDays", $value, true);
    }
    /**
     * @return bool
     */
    public function getblockPeoplePickerAndSharing()
    {
        if (!$this->isPropertyAvailable("blockPeoplePickerAndSharing")) {
            return null;
        }
        return $this->getProperty("blockPeoplePickerAndSharing");
    }
    /**
     * @var bool
     */
    public function setblockPeoplePickerAndSharing($value)
    {
        $this->setProperty("blockPeoplePickerAndSharing", $value, true);
    }
    /**
     * @return bool
     */
    public function getcanAddExternalPrincipal()
    {
        if (!$this->isPropertyAvailable("canAddExternalPrincipal")) {
            return null;
        }
        return $this->getProperty("canAddExternalPrincipal");
    }
    /**
     * @var bool
     */
    public function setcanAddExternalPrincipal($value)
    {
        $this->setProperty("canAddExternalPrincipal", $value, true);
    }
    /**
     * @return bool
     */
    public function getcanAddInternalPrincipal()
    {
        if (!$this->isPropertyAvailable("canAddInternalPrincipal")) {
            return null;
        }
        return $this->getProperty("canAddInternalPrincipal");
    }
    /**
     * @var bool
     */
    public function setcanAddInternalPrincipal($value)
    {
        $this->setProperty("canAddInternalPrincipal", $value, true);
    }
    /**
     * @return bool
     */
    public function getcanRequestAccessForGrantAccess()
    {
        if (!$this->isPropertyAvailable("canRequestAccessForGrantAccess")) {
            return null;
        }
        return $this->getProperty("canRequestAccessForGrantAccess");
    }
    /**
     * @var bool
     */
    public function setcanRequestAccessForGrantAccess($value)
    {
        $this->setProperty("canRequestAccessForGrantAccess", $value, true);
    }
    /**
     * @return bool
     */
    public function getcanSendEmail()
    {
        if (!$this->isPropertyAvailable("canSendEmail")) {
            return null;
        }
        return $this->getProperty("canSendEmail");
    }
    /**
     * @var bool
     */
    public function setcanSendEmail($value)
    {
        $this->setProperty("canSendEmail", $value, true);
    }
    /**
     * @return bool
     */
    public function getcanUseSimplifiedRoles()
    {
        if (!$this->isPropertyAvailable("canUseSimplifiedRoles")) {
            return null;
        }
        return $this->getProperty("canUseSimplifiedRoles");
    }
    /**
     * @var bool
     */
    public function setcanUseSimplifiedRoles($value)
    {
        $this->setProperty("canUseSimplifiedRoles", $value, true);
    }
    /**
     * @return integer
     */
    public function getcurrentRole()
    {
        if (!$this->isPropertyAvailable("currentRole")) {
            return null;
        }
        return $this->getProperty("currentRole");
    }
    /**
     * @var integer
     */
    public function setcurrentRole($value)
    {
        $this->setProperty("currentRole", $value, true);
    }
    /**
     * @return string
     */
    public function getcustomizedExternalSharingServiceUrl()
    {
        if (!$this->isPropertyAvailable("customizedExternalSharingServiceUrl")) {
            return null;
        }
        return $this->getProperty("customizedExternalSharingServiceUrl");
    }
    /**
     * @var string
     */
    public function setcustomizedExternalSharingServiceUrl($value)
    {
        $this->setProperty("customizedExternalSharingServiceUrl", $value, true);
    }
    /**
     * @return integer
     */
    public function getdefaultLinkKind()
    {
        if (!$this->isPropertyAvailable("defaultLinkKind")) {
            return null;
        }
        return $this->getProperty("defaultLinkKind");
    }
    /**
     * @var integer
     */
    public function setdefaultLinkKind($value)
    {
        $this->setProperty("defaultLinkKind", $value, true);
    }
    /**
     * @return integer
     */
    public function getdefaultShareLinkPermission()
    {
        if (!$this->isPropertyAvailable("defaultShareLinkPermission")) {
            return null;
        }
        return $this->getProperty("defaultShareLinkPermission");
    }
    /**
     * @var integer
     */
    public function setdefaultShareLinkPermission($value)
    {
        $this->setProperty("defaultShareLinkPermission", $value, true);
    }
    /**
     * @return integer
     */
    public function getdefaultShareLinkScope()
    {
        if (!$this->isPropertyAvailable("defaultShareLinkScope")) {
            return null;
        }
        return $this->getProperty("defaultShareLinkScope");
    }
    /**
     * @var integer
     */
    public function setdefaultShareLinkScope($value)
    {
        $this->setProperty("defaultShareLinkScope", $value, true);
    }
    /**
     * @return bool
     */
    public function getdefaultShareLinkToExistingAccess()
    {
        if (!$this->isPropertyAvailable("defaultShareLinkToExistingAccess")) {
            return null;
        }
        return $this->getProperty("defaultShareLinkToExistingAccess");
    }
    /**
     * @var bool
     */
    public function setdefaultShareLinkToExistingAccess($value)
    {
        $this->setProperty("defaultShareLinkToExistingAccess", $value, true);
    }
    /**
     * @return string
     */
    public function getdirectUrl()
    {
        if (!$this->isPropertyAvailable("directUrl")) {
            return null;
        }
        return $this->getProperty("directUrl");
    }
    /**
     * @var string
     */
    public function setdirectUrl($value)
    {
        $this->setProperty("directUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getdoesUserHaveIBSegment()
    {
        if (!$this->isPropertyAvailable("doesUserHaveIBSegment")) {
            return null;
        }
        return $this->getProperty("doesUserHaveIBSegment");
    }
    /**
     * @var bool
     */
    public function setdoesUserHaveIBSegment($value)
    {
        $this->setProperty("doesUserHaveIBSegment", $value, true);
    }
    /**
     * @return DomainRestrictionSettings
     */
    public function getdomainRestrictionSettings()
    {
        if (!$this->isPropertyAvailable("domainRestrictionSettings")) {
            return null;
        }
        return $this->getProperty("domainRestrictionSettings");
    }
    /**
     * @var DomainRestrictionSettings
     */
    public function setdomainRestrictionSettings($value)
    {
        $this->setProperty("domainRestrictionSettings", $value, true);
    }
    /**
     * @return integer
     */
    public function geteffectiveLimitedAccessFileType()
    {
        if (!$this->isPropertyAvailable("effectiveLimitedAccessFileType")) {
            return null;
        }
        return $this->getProperty("effectiveLimitedAccessFileType");
    }
    /**
     * @var integer
     */
    public function seteffectiveLimitedAccessFileType($value)
    {
        $this->setProperty("effectiveLimitedAccessFileType", $value, true);
    }
    /**
     * @return bool
     */
    public function gethasUniquePermissions()
    {
        if (!$this->isPropertyAvailable("hasUniquePermissions")) {
            return null;
        }
        return $this->getProperty("hasUniquePermissions");
    }
    /**
     * @var bool
     */
    public function sethasUniquePermissions($value)
    {
        $this->setProperty("hasUniquePermissions", $value, true);
    }
    /**
     * @return string
     */
    public function getitemUniqueId()
    {
        if (!$this->isPropertyAvailable("itemUniqueId")) {
            return null;
        }
        return $this->getProperty("itemUniqueId");
    }
    /**
     * @var string
     */
    public function setitemUniqueId($value)
    {
        $this->setProperty("itemUniqueId", $value, true);
    }
    /**
     * @return string
     */
    public function getmicroserviceShareUiUrl()
    {
        if (!$this->isPropertyAvailable("microserviceShareUiUrl")) {
            return null;
        }
        return $this->getProperty("microserviceShareUiUrl");
    }
    /**
     * @var string
     */
    public function setmicroserviceShareUiUrl($value)
    {
        $this->setProperty("microserviceShareUiUrl", $value, true);
    }
    /**
     * @return PermissionCollection
     */
    public function getpermissionsInformation()
    {
        if (!$this->isPropertyAvailable("permissionsInformation")) {
            return null;
        }
        return $this->getProperty("permissionsInformation");
    }
    /**
     * @var PermissionCollection
     */
    public function setpermissionsInformation($value)
    {
        $this->setProperty("permissionsInformation", $value, true);
    }
    /**
     * @return integer
     */
    public function getsharedObjectType()
    {
        if (!$this->isPropertyAvailable("sharedObjectType")) {
            return null;
        }
        return $this->getProperty("sharedObjectType");
    }
    /**
     * @var integer
     */
    public function setsharedObjectType($value)
    {
        $this->setProperty("sharedObjectType", $value, true);
    }
    /**
     * @return string
     */
    public function getshareUiUrl()
    {
        if (!$this->isPropertyAvailable("shareUiUrl")) {
            return null;
        }
        return $this->getProperty("shareUiUrl");
    }
    /**
     * @var string
     */
    public function setshareUiUrl($value)
    {
        $this->setProperty("shareUiUrl", $value, true);
    }
    /**
     * @return SharingAbilities
     */
    public function getsharingAbilities()
    {
        if (!$this->isPropertyAvailable("sharingAbilities")) {
            return null;
        }
        return $this->getProperty("sharingAbilities");
    }
    /**
     * @var SharingAbilities
     */
    public function setsharingAbilities($value)
    {
        $this->setProperty("sharingAbilities", $value, true);
    }
    /**
     * @return SharingLinkDefaultTemplatesCollection
     */
    public function getsharingLinkTemplates()
    {
        if (!$this->isPropertyAvailable("sharingLinkTemplates")) {
            return null;
        }
        return $this->getProperty("sharingLinkTemplates");
    }
    /**
     * @var SharingLinkDefaultTemplatesCollection
     */
    public function setsharingLinkTemplates($value)
    {
        $this->setProperty("sharingLinkTemplates", $value, true);
    }
    /**
     * @return integer
     */
    public function getsharingStatus()
    {
        if (!$this->isPropertyAvailable("sharingStatus")) {
            return null;
        }
        return $this->getProperty("sharingStatus");
    }
    /**
     * @var integer
     */
    public function setsharingStatus($value)
    {
        $this->setProperty("sharingStatus", $value, true);
    }
    /**
     * @return bool
     */
    public function getshowExternalSharingWarning()
    {
        if (!$this->isPropertyAvailable("showExternalSharingWarning")) {
            return null;
        }
        return $this->getProperty("showExternalSharingWarning");
    }
    /**
     * @var bool
     */
    public function setshowExternalSharingWarning($value)
    {
        $this->setProperty("showExternalSharingWarning", $value, true);
    }
    /**
     * @return array
     */
    public function getsiteIBSegmentIDs()
    {
        if (!$this->isPropertyAvailable("siteIBSegmentIDs")) {
            return null;
        }
        return $this->getProperty("siteIBSegmentIDs");
    }
    /**
     * @var array
     */
    public function setsiteIBSegmentIDs($value)
    {
        $this->setProperty("siteIBSegmentIDs", $value, true);
    }
    /**
     * @return integer
     */
    public function getwebTemplateId()
    {
        if (!$this->isPropertyAvailable("webTemplateId")) {
            return null;
        }
        return $this->getProperty("webTemplateId");
    }
    /**
     * @var integer
     */
    public function setwebTemplateId($value)
    {
        $this->setProperty("webTemplateId", $value, true);
    }
    /**
     * @return string
     */
    public function getwebUrl()
    {
        if (!$this->isPropertyAvailable("webUrl")) {
            return null;
        }
        return $this->getProperty("webUrl");
    }
    /**
     * @var string
     */
    public function setwebUrl($value)
    {
        $this->setProperty("webUrl", $value, true);
    }
    /**
     * @return AddressBarLinkSettings
     */
    public function getaddressBarLinkSettings()
    {
        if (!$this->isPropertyAvailable("addressBarLinkSettings")) {
            return null;
        }
        return $this->getProperty("addressBarLinkSettings");
    }
    /**
     * @var AddressBarLinkSettings
     */
    public function setaddressBarLinkSettings($value)
    {
        $this->setProperty("addressBarLinkSettings", $value, true);
    }
    /**
     * @return string
     */
    public function getfileExtension()
    {
        if (!$this->isPropertyAvailable("fileExtension")) {
            return null;
        }
        return $this->getProperty("fileExtension");
    }
    /**
     * @var string
     */
    public function setfileExtension($value)
    {
        $this->setProperty("fileExtension", $value, true);
    }
    /**
     * @return bool
     */
    public function getenforceIBSegmentFiltering()
    {
        if (!$this->isPropertyAvailable("enforceIBSegmentFiltering")) {
            return null;
        }
        return $this->getProperty("enforceIBSegmentFiltering");
    }
    /**
     * @var bool
     */
    public function setenforceIBSegmentFiltering($value)
    {
        $this->setProperty("enforceIBSegmentFiltering", $value, true);
    }
    /**
     * @return bool
     */
    public function getanyoneLinkTrackUsers()
    {
        if (!$this->isPropertyAvailable("anyoneLinkTrackUsers")) {
            return null;
        }
        return $this->getProperty("anyoneLinkTrackUsers");
    }
    /**
     * @var bool
     */
    public function setanyoneLinkTrackUsers($value)
    {
        $this->setProperty("anyoneLinkTrackUsers", $value, true);
    }
    /**
     * @return bool
     */
    public function getenforceSPOSearch()
    {
        if (!$this->isPropertyAvailable("enforceSPOSearch")) {
            return null;
        }
        return $this->getProperty("enforceSPOSearch");
    }
    /**
     * @var bool
     */
    public function setenforceSPOSearch($value)
    {
        $this->setProperty("enforceSPOSearch", $value, true);
    }
}