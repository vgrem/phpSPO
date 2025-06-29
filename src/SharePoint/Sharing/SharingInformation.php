<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
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
    /**
     * @return bool
     */
    public function getisStubFile()
    {
        return $this->getProperty("isStubFile");
    }
    /**
     * @var bool
     */
    public function setisStubFile($value)
    {
        return $this->setProperty("isStubFile", $value, true);
    }
    /**
     * @return string
     */
    public function getoutlookEndpointHostUrl()
    {
        return $this->getProperty("outlookEndpointHostUrl");
    }
    /**
     * @var string
     */
    public function setoutlookEndpointHostUrl($value)
    {
        return $this->setProperty("outlookEndpointHostUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getsiteIBMode()
    {
        return $this->getProperty("siteIBMode");
    }
    /**
     * @var string
     */
    public function setsiteIBMode($value)
    {
        return $this->setProperty("siteIBMode", $value, true);
    }
    /**
     * @return string
     */
    public function getuserIsSharingViaMCS()
    {
        return $this->getProperty("userIsSharingViaMCS");
    }
    /**
     * @var string
     */
    public function setuserIsSharingViaMCS($value)
    {
        return $this->setProperty("userIsSharingViaMCS", $value, true);
    }
    /**
     * @return string
     */
    public function getuserPhotoCdnBaseUrl()
    {
        return $this->getProperty("userPhotoCdnBaseUrl");
    }
    /**
     * @var string
     */
    public function setuserPhotoCdnBaseUrl($value)
    {
        return $this->setProperty("userPhotoCdnBaseUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getstandardRolesModified()
    {
        return $this->getProperty("standardRolesModified");
    }
    /**
     * @var bool
     */
    public function setstandardRolesModified($value)
    {
        return $this->setProperty("standardRolesModified", $value, true);
    }
    /**
     * @return string
     */
    public function getdisplayName()
    {
        return $this->getProperty("displayName");
    }
    /**
     * @var string
     */
    public function setdisplayName($value)
    {
        return $this->setProperty("displayName", $value, true);
    }
    /**
     * @return string
     */
    public function getitemUrl()
    {
        return $this->getProperty("itemUrl");
    }
    /**
     * @var string
     */
    public function setitemUrl($value)
    {
        return $this->setProperty("itemUrl", $value, true);
    }
    /**
     * @return SensitivityLabelInformation
     */
    public function getsensitivityLabelInformation()
    {
        return $this->getProperty("sensitivityLabelInformation");
    }
    /**
     * @var SensitivityLabelInformation
     */
    public function setsensitivityLabelInformation($value)
    {
        return $this->setProperty("sensitivityLabelInformation", $value, true);
    }
    /**
     * @return bool
     */
    public function getisConsumerFiles()
    {
        return $this->getProperty("isConsumerFiles");
    }
    /**
     * @var bool
     */
    public function setisConsumerFiles($value)
    {
        return $this->setProperty("isConsumerFiles", $value, true);
    }
    /**
     * @return string
     */
    public function getsiteId()
    {
        return $this->getProperty("siteId");
    }
    /**
     * @var string
     */
    public function setsiteId($value)
    {
        return $this->setProperty("siteId", $value, true);
    }
    /**
     * @return string
     */
    public function getsubstrateFileId()
    {
        return $this->getProperty("substrateFileId");
    }
    /**
     * @var string
     */
    public function setsubstrateFileId($value)
    {
        return $this->setProperty("substrateFileId", $value, true);
    }
    /**
     * @return string
     */
    public function gettenantDisplayName()
    {
        return $this->getProperty("tenantDisplayName");
    }
    /**
     * @var string
     */
    public function settenantDisplayName($value)
    {
        return $this->setProperty("tenantDisplayName", $value, true);
    }
    /**
     * @return string
     */
    public function gettenantId()
    {
        return $this->getProperty("tenantId");
    }
    /**
     * @var string
     */
    public function settenantId($value)
    {
        return $this->setProperty("tenantId", $value, true);
    }
    /**
     * @return RecipientLimits
     */
    public function getrecipientLimits()
    {
        return $this->getProperty("recipientLimits");
    }
    /**
     * @var RecipientLimits
     */
    public function setrecipientLimits($value)
    {
        return $this->setProperty("recipientLimits", $value, true);
    }
    /**
     * @return integer
     */
    public function getageGroup()
    {
        return $this->getProperty("ageGroup");
    }
    /**
     * @var integer
     */
    public function setageGroup($value)
    {
        return $this->setProperty("ageGroup", $value, true);
    }
    /**
     * @return bool
     */
    public function getisPremium()
    {
        return $this->getProperty("isPremium");
    }
    /**
     * @var bool
     */
    public function setisPremium($value)
    {
        return $this->setProperty("isPremium", $value, true);
    }
    /**
     * @return bool
     */
    public function getcanAddExistingExternalPrincipal()
    {
        return $this->getProperty("canAddExistingExternalPrincipal");
    }
    /**
     * @var bool
     */
    public function setcanAddExistingExternalPrincipal($value)
    {
        return $this->setProperty("canAddExistingExternalPrincipal", $value, true);
    }
    /**
     * @return string
     */
    public function getallOrganizationSecurityGroupId()
    {
        return $this->getProperty("allOrganizationSecurityGroupId");
    }
    /**
     * @var string
     */
    public function setallOrganizationSecurityGroupId($value)
    {
        return $this->setProperty("allOrganizationSecurityGroupId", $value, true);
    }
    /**
     * @return bool
     */
    public function getdiscoverableByOrganizationEnabled()
    {
        return $this->getProperty("discoverableByOrganizationEnabled");
    }
    /**
     * @var bool
     */
    public function setdiscoverableByOrganizationEnabled($value)
    {
        return $this->setProperty("discoverableByOrganizationEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getisMultiTenantOrganization()
    {
        return $this->getProperty("isMultiTenantOrganization");
    }
    /**
     * @var bool
     */
    public function setisMultiTenantOrganization($value)
    {
        return $this->setProperty("isMultiTenantOrganization", $value, true);
    }
}