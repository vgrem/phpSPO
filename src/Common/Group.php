<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00 
 */
namespace Office365\Common;

use Office365\OneDrive\Drive;
use Office365\OneDrive\DriveCollection;
use Office365\OneDrive\SiteCollection;
use Office365\OneNote\Onenote;
use Office365\OutlookServices\Calendar;
use Office365\OutlookServices\ProfilePhoto;
use Office365\Planner\PlannerGroup;
use Office365\Runtime\ResourcePath;
use Office365\Teams\Team;

/**
 *  "Represents an Azure Active Directory (Azure AD) group, which can be an Office 365 group, or a security group. "
 */
class Group extends DirectoryObject
{

    /**
     * Create a new team under a group.
     */
    public function addTeam(){

    }


    /**
     * Describes a classification for the group (such as low, medium or high business impact). Valid values for this property are defined by creating a ClassificationList [setting](groupsetting.md) value, based on the [template definition](groupsettingtemplate.md).<br><br>Returned by default.
     * @return string
     */
    public function getClassification()
    {
        return $this->getProperty("Classification");
    }
    /**
     * Describes a classification for the group (such as low, medium or high business impact). Valid values for this property are defined by creating a ClassificationList [setting](groupsetting.md) value, based on the [template definition](groupsettingtemplate.md).<br><br>Returned by default.
     * @var string
     */
    public function setClassification($value)
    {
        $this->setProperty("Classification", $value, true);
    }
    /**
     * An optional description for the group. <br><br>Returned by default.
     * @return string
     */
    public function getDescription()
    {
        return $this->getProperty("Description");
    }

    /**
     * An optional description for the group. <br><br>Returned by default.
     *
     * @return self
     * @var string
     */
    public function setDescription($value)
    {
        return $this->setProperty("Description", $value, true);
    }
    /**
     * The display name for the group. This property is required when a group is created and cannot be cleared during updates. <br><br>Returned by default. Supports $filter and $orderby. 
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }

    /**
     * The display name for the group. This property is required when a group is created and cannot be cleared during updates. <br><br>Returned by default. Supports $filter and $orderby.
     *
     * @return self
     * @var string
     */
    public function setDisplayName($value)
    {
        return $this->setProperty("DisplayName", $value, true);
    }
    /**
     * Indicates whether there are members in this group that have license errors from its group-based license assignment. <br><br>This property is never returned on a GET operation. You can use it as a $filter argument to get groups that have members with license errors (that is, filter for this property being true). See an [example](../api/group-list.md).
     * @return bool
     */
    public function getHasMembersWithLicenseErrors()
    {
        return $this->getProperty("HasMembersWithLicenseErrors");
    }
    /**
     * Indicates whether there are members in this group that have license errors from its group-based license assignment. <br><br>This property is never returned on a GET operation. You can use it as a $filter argument to get groups that have members with license errors (that is, filter for this property being true). See an [example](../api/group-list.md).
     * @var bool
     */
    public function setHasMembersWithLicenseErrors($value)
    {
        $this->setProperty("HasMembersWithLicenseErrors", $value, true);
    }
    /**
     *  Specifies the group type and its membership.  <br><br>If the collection contains `Unified` then the group is an Office 365 group; otherwise it's a security group.  <br><br>If the collection includes `DynamicMembership`, the group has dynamic membership; otherwise, membership is static.  <br><br>Returned by default. Supports $filter.
     * @return array
     */
    public function getGroupTypes()
    {
        return $this->getProperty("GroupTypes");
    }
    /**
     *  Specifies the group type and its membership.  <br><br>If the collection contains `Unified` then the group is an Office 365 group; otherwise it's a security group.  <br><br>If the collection includes `DynamicMembership`, the group has dynamic membership; otherwise, membership is static.  <br><br>Returned by default. Supports $filter.
     * @var array
     */
    public function setGroupTypes($value)
    {
        $this->setProperty("GroupTypes", $value, true);
    }
    /**
     * Indicates status of the group license assignment to all members of the group. Default value is **false**. Read-only. Possible values: `QueuedForProcessing`, `ProcessingInProgress`, and `ProcessingComplete`.<br><br>Returned only on $select. Read-only.
     * @return LicenseProcessingState
     */
    public function getLicenseProcessingState()
    {
        return $this->getProperty("LicenseProcessingState", new LicenseProcessingState());
    }
    /**
     * Indicates status of the group license assignment to all members of the group. Default value is **false**. Read-only. Possible values: `QueuedForProcessing`, `ProcessingInProgress`, and `ProcessingComplete`.<br><br>Returned only on $select. Read-only.
     * @var LicenseProcessingState
     */
    public function setLicenseProcessingState($value)
    {
        $this->setProperty("LicenseProcessingState", $value, true);
    }
    /**
     * The SMTP address for the group, for example, "serviceadmins@contoso.onmicrosoft.com". <br><br>Returned by default. Read-only. Supports $filter.
     * @return string
     */
    public function getMail()
    {
        return $this->getProperty("Mail");
    }
    /**
     * The SMTP address for the group, for example, "serviceadmins@contoso.onmicrosoft.com". <br><br>Returned by default. Read-only. Supports $filter.
     * @var string
     */
    public function setMail($value)
    {
        $this->setProperty("Mail", $value, true);
    }
    /**
     * Specifies whether the group is mail-enabled. <br><br>Returned by default.
     * @return bool
     */
    public function getMailEnabled()
    {
        return $this->getProperty("MailEnabled");
    }
    /**
     * Specifies whether the group is mail-enabled. <br><br>Returned by default.
     * @var bool
     */
    public function setMailEnabled($value)
    {
        $this->setProperty("MailEnabled", $value, true);
    }
    /**
     * The mail alias for the group, unique in the organization. This property must be specified when a group is created. <br><br>Returned by default. Supports $filter.
     * @return string
     */
    public function getMailNickname()
    {
        return $this->getProperty("MailNickname");
    }
    /**
     * The mail alias for the group, unique in the organization. This property must be specified when a group is created. <br><br>Returned by default. Supports $filter.
     * @var string
     */
    public function setMailNickname($value)
    {
        $this->setProperty("MailNickname", $value, true);
    }
    /**
     * @return string
     */
    public function getOnPremisesDomainName()
    {
        return $this->getProperty("OnPremisesDomainName");
    }
    /**
     * @var string
     */
    public function setOnPremisesDomainName($value)
    {
        $this->setProperty("OnPremisesDomainName", $value, true);
    }
    /**
     * @return string
     */
    public function getOnPremisesNetBiosName()
    {
        return $this->getProperty("OnPremisesNetBiosName");
    }
    /**
     * @var string
     */
    public function setOnPremisesNetBiosName($value)
    {
        $this->setProperty("OnPremisesNetBiosName", $value, true);
    }
    /**
     * @return string
     */
    public function getOnPremisesSamAccountName()
    {
        return $this->getProperty("OnPremisesSamAccountName");
    }
    /**
     * @var string
     */
    public function setOnPremisesSamAccountName($value)
    {
        $this->setProperty("OnPremisesSamAccountName", $value, true);
    }
    /**
     * Contains the on-premises security identifier (SID) for the group that was synchronized from on-premises to the cloud. <br><br>Returned by default. Read-only. 
     * @return string
     */
    public function getOnPremisesSecurityIdentifier()
    {
        return $this->getProperty("OnPremisesSecurityIdentifier");
    }
    /**
     * Contains the on-premises security identifier (SID) for the group that was synchronized from on-premises to the cloud. <br><br>Returned by default. Read-only. 
     * @var string
     */
    public function setOnPremisesSecurityIdentifier($value)
    {
        $this->setProperty("OnPremisesSecurityIdentifier", $value, true);
    }
    /**
     * **true** if this group is synced from an on-premises directory; **false** if this group was originally synced from an on-premises directory but is no longer synced; **null** if this object has never been synced from an on-premises directory (default). <br><br>Returned by default. Read-only. Supports $filter.
     * @return bool
     */
    public function getOnPremisesSyncEnabled()
    {
        return $this->getProperty("OnPremisesSyncEnabled");
    }
    /**
     * **true** if this group is synced from an on-premises directory; **false** if this group was originally synced from an on-premises directory but is no longer synced; **null** if this object has never been synced from an on-premises directory (default). <br><br>Returned by default. Read-only. Supports $filter.
     * @var bool
     */
    public function setOnPremisesSyncEnabled($value)
    {
        $this->setProperty("OnPremisesSyncEnabled", $value, true);
    }
    /**
     * The preferred data location for the group. For more information, see  [OneDrive Online Multi-Geo](https://docs.microsoft.com/sharepoint/dev/solution-guidance/multigeo-introduction). <br><br>Returned by default.
     * @return string
     */
    public function getPreferredDataLocation()
    {
        return $this->getProperty("PreferredDataLocation");
    }
    /**
     * The preferred data location for the group. For more information, see  [OneDrive Online Multi-Geo](https://docs.microsoft.com/sharepoint/dev/solution-guidance/multigeo-introduction). <br><br>Returned by default.
     * @var string
     */
    public function setPreferredDataLocation($value)
    {
        $this->setProperty("PreferredDataLocation", $value, true);
    }
    /**
     *  Email addresses for the group that direct to the same group mailbox. For example: `["SMTP: bob@contoso.com", "smtp: bob@sales.contoso.com"]`. The **any** operator is required to filter expressions on multi-valued properties. <br><br>Returned by default. Read-only. Not nullable. Supports $filter. 
     * @return array
     */
    public function getProxyAddresses()
    {
        return $this->getProperty("ProxyAddresses");
    }
    /**
     *  Email addresses for the group that direct to the same group mailbox. For example: `["SMTP: bob@contoso.com", "smtp: bob@sales.contoso.com"]`. The **any** operator is required to filter expressions on multi-valued properties. <br><br>Returned by default. Read-only. Not nullable. Supports $filter. 
     * @var array
     */
    public function setProxyAddresses($value)
    {
        $this->setProperty("ProxyAddresses", $value, true);
    }
    /**
     * Specifies whether the group is a security group. <br><br>Returned by default. Supports $filter.
     * @return bool
     */
    public function getSecurityEnabled()
    {
        return $this->getProperty("SecurityEnabled");
    }
    /**
     * Specifies whether the group is a security group. <br><br>Returned by default. Supports $filter.
     * @var bool
     */
    public function setSecurityEnabled($value)
    {
        $this->setProperty("SecurityEnabled", $value, true);
    }
    /**
     * Security identifier of the group, used in Windows scenarios. <br><br>Returned by default.
     * @return string
     */
    public function getSecurityIdentifier()
    {
        return $this->getProperty("SecurityIdentifier");
    }
    /**
     * Security identifier of the group, used in Windows scenarios. <br><br>Returned by default.
     * @var string
     */
    public function setSecurityIdentifier($value)
    {
        $this->setProperty("SecurityIdentifier", $value, true);
    }
    /**
     *  Specifies the visibility of an Office 365 group. Possible values are: `Private`, `Public`, or `Hiddenmembership`; blank values are treated as public.  See [group visibility options](#group-visibility-options) to learn more.<br>Visibility can be set only when a group is created; it is not editable.<br>Visibility is supported only for unified groups; it is not supported for security groups. <br><br>Returned by default.
     * @return string
     */
    public function getVisibility()
    {
        return $this->getProperty("Visibility");
    }
    /**
     *  Specifies the visibility of an Office 365 group. Possible values are: `Private`, `Public`, or `Hiddenmembership`; blank values are treated as public.  See [group visibility options](#group-visibility-options) to learn more.<br>Visibility can be set only when a group is created; it is not editable.<br>Visibility is supported only for unified groups; it is not supported for security groups. <br><br>Returned by default.
     * @var string
     */
    public function setVisibility($value)
    {
        $this->setProperty("Visibility", $value, true);
    }
    /**
     *  Indicates if people external to the organization can send messages to the group. Default value is **false**. <br><br>Returned only on $select. 
     * @return bool
     */
    public function getAllowExternalSenders()
    {
        return $this->getProperty("AllowExternalSenders");
    }
    /**
     *  Indicates if people external to the organization can send messages to the group. Default value is **false**. <br><br>Returned only on $select. 
     * @var bool
     */
    public function setAllowExternalSenders($value)
    {
        $this->setProperty("AllowExternalSenders", $value, true);
    }
    /**
     * Indicates if new members added to the group will be auto-subscribed to receive email notifications. You can set this property in a PATCH request for the group; do not set it in the initial POST request that creates the group. Default value is **false**. <br><br>Returned only on $select.
     * @return bool
     */
    public function getAutoSubscribeNewMembers()
    {
        return $this->getProperty("AutoSubscribeNewMembers");
    }
    /**
     * Indicates if new members added to the group will be auto-subscribed to receive email notifications. You can set this property in a PATCH request for the group; do not set it in the initial POST request that creates the group. Default value is **false**. <br><br>Returned only on $select.
     * @var bool
     */
    public function setAutoSubscribeNewMembers($value)
    {
        $this->setProperty("AutoSubscribeNewMembers", $value, true);
    }
    /**
     * Indicates whether the signed-in user is subscribed to receive email conversations. Default value is **true**. <br><br>Returned only on $select. 
     * @return bool
     */
    public function getIsSubscribedByMail()
    {
        return $this->getProperty("IsSubscribedByMail");
    }
    /**
     * Indicates whether the signed-in user is subscribed to receive email conversations. Default value is **true**. <br><br>Returned only on $select. 
     * @var bool
     */
    public function setIsSubscribedByMail($value)
    {
        $this->setProperty("IsSubscribedByMail", $value, true);
    }
    /**
     * Count of conversations that have received new posts since the signed-in user last visited the group. <br><br>Returned only on $select. 
     * @return integer
     */
    public function getUnseenCount()
    {
        return $this->getProperty("UnseenCount");
    }
    /**
     * Count of conversations that have received new posts since the signed-in user last visited the group. <br><br>Returned only on $select. 
     * @var integer
     */
    public function setUnseenCount($value)
    {
        $this->setProperty("UnseenCount", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsArchived()
    {
        return $this->getProperty("IsArchived");
    }
    /**
     * @var bool
     */
    public function setIsArchived($value)
    {
        $this->setProperty("IsArchived", $value, true);
    }
    /**
     *  The user (or application) that created the group. NOTE: This is not set if the user is an administrator. Read-only.
     * @return DirectoryObject
     */
    public function getCreatedOnBehalfOf()
    {
        return $this->getProperty("CreatedOnBehalfOf",
            new DirectoryObject($this->getContext(), new ResourcePath("CreatedOnBehalfOf", $this->getResourcePath())));
    }
    /**
     * The group's calendar. Read-only.
     * @return Calendar
     */
    public function getCalendar()
    {
        return $this->getProperty("Calendar",
            new Calendar($this->getContext(), new ResourcePath("Calendar", $this->getResourcePath())));
    }
    /**
     *  The group's profile photo 
     * @return ProfilePhoto
     */
    public function getPhoto()
    {
        return $this->getProperty("Photo",
            new ProfilePhoto($this->getContext(), new ResourcePath("Photo", $this->getResourcePath())));
    }
    /**
     * The group's default drive. Read-only.
     * @return Drive
     */
    public function getDrive()
    {
        return $this->getProperty("Drive",
            new Drive($this->getContext(), new ResourcePath("Drive", $this->getResourcePath())));
    }
    /**
     * The list of SharePoint sites in this group. Access the default site with /sites/root.
     * @return SiteCollection
     */
    public function getSites()
    {
        return $this->getProperty("Sites", new SiteCollection());
    }
    /**
     *  Entry-point to Planner resource that might exist for a Unified Group.
     * @return PlannerGroup
     */
    public function getPlanner()
    {
        return $this->getProperty("Planner",
            new PlannerGroup($this->getContext(), new ResourcePath("Planner", $this->getResourcePath())));
    }
    /**
     *  Read-only.
     * @return Onenote
     */
    public function getOnenote()
    {
        return $this->getProperty("Onenote",
            new Onenote($this->getContext(), new ResourcePath("Onenote", $this->getResourcePath())));
    }
    /**
     * @return Team
     */
    public function getTeam()
    {
        return $this->getProperty("Team",
            new Team($this->getContext(), new ResourcePath("Team", $this->getResourcePath())));
    }
    /**
     * The group's drives. Read-only.
     * @return DriveCollection
     */
    public function getDrives()
    {
        return $this->getProperty("Drives",
            new DriveCollection($this->getContext(), new ResourcePath("Drives", $this->getResourcePath())));
    }
    /**
     * @return bool
     */
    public function getHideFromOutlookClients()
    {
        return $this->getProperty("HideFromOutlookClients");
    }
    /**
     * @var bool
     */
    public function setHideFromOutlookClients($value)
    {
        $this->setProperty("HideFromOutlookClients", $value, true);
    }
    /**
     * @return bool
     */
    public function getHideFromAddressLists()
    {
        return $this->getProperty("HideFromAddressLists");
    }
    /**
     * @var bool
     */
    public function setHideFromAddressLists($value)
    {
        $this->setProperty("HideFromAddressLists", $value, true);
    }
}