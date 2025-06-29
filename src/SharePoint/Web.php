<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
 */
namespace Office365\SharePoint;

use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ClientResult;
use Office365\Runtime\Paths\ServiceOperationPath;
use Office365\Runtime\ResourcePath;
/**
 * Specifies 
 * a site 
 * (2).The AllowAutomaticASPXPageIndexing, 
 * AllowCreateDeclarativeWorkflowForCurrentUser, AllowDesignerForCurrentUser, 
 * AllowMasterPageEditingForCurrentUser, AllowRevertFromTemplateForCurrentUser, 
 * AllowSaveDeclarativeWorkflowAsTemplateForCurrentUser, AllowSavePublishDeclarativeWorkflowForCurrentUser, 
 * CommentsOnSitePagesDisabled, ContainsConfidentialInfo, 
 * DesignerDownloadUrlForCurrentUser, EffectiveBasePermissions, 
 * ExcludeFromOfflineClient, HasUniqueRoleAssignments, MembersCanShare, 
 * NotificationsInOneDriveForBusinessEnabled, NotificationsInSharePointEnabled, 
 * PreviewFeaturesEnabled, RequestAccessEmail, SaveSiteAsTemplateEnabled, 
 * ServerRelativePath, ShowUrlStructureForCurrentUser, SiteLogoDescription, 
 * SupportedUILanguageIds, ThemeData, ThemedCssFolderUrl and ThirdPartyMdmEnabled 
 * properties are not included in the default scalar property set 
 * for this type.
 */
class Web extends SecurableObject
{
    /**
     * @var string|null
     */
    private $webUrl;
    /**
     * @param ClientContext $context
     * @param string $url
     * @param boolean $isEditLink
     * @return ClientResult
     */
    public static function createAnonymousLink($context, $url, $isEditLink)
    {
        $result = new ClientResult($context);
        $qry = new InvokePostMethodQuery($context->getWeb(), "CreateAnonymousLink", null, null, array("url" => $url, "isEditLink" => $isEditLink));
        $qry->IsStatic = true;
        $context->addQueryAndResultObject($qry, $result);
        return $result;
    }
    /**
     * @param ClientContext $context
     * @param string $url
     * @param boolean $isEditLink
     * @param string $expirationString
     * @return ClientResult
     */
    public static function createAnonymousLinkWithExpiration($context, $url, $isEditLink, $expirationString)
    {
        $result = new ClientResult($context);
        $qry = new InvokePostMethodQuery($context->getWeb(), "CreateAnonymousLinkWithExpiration", null, null, array("url" => $url, "isEditLink" => $isEditLink, "expirationString" => $expirationString));
        $qry->IsStatic = true;
        $context->addQueryAndResultObject($qry, $result);
        return $result;
    }
    /**
     * Resolves site by absolute url
     * @param ClientContext $ctx
     * @param string $absUrl
     * @return ClientResult
     */
    public static function getWebUrlFromPageUrl(ClientContext $ctx, $absUrl)
    {
        $result = new ClientResult($ctx);
        $qry = new InvokePostMethodQuery($ctx->getWeb(), "GetWebUrlFromPageUrl", null, null, array("pageFullUrl" => $absUrl));
        $qry->IsStatic = true;
        $ctx->addQueryAndResultObject($qry, $result);
        return $result;
    }
    /**
     * Retrieves the default document library
     * @return SPList
     */
    public function defaultDocumentLibrary()
    {
        return new SPList($this->getContext(), new ServiceOperationPath("DefaultDocumentLibrary", null, $this->getResourcePath()));
    }
    /**
     * @param string $logonName
     * @return User
     */
    public function ensureUser($logonName)
    {
        $returnType = new User($this->context);
        $this->getSiteUsers()->addChild($returnType);
        $qry = new InvokePostMethodQuery($this, "EnsureUser", [$logonName], null, null);
        $this->getContext()->addQueryAndResultObject($qry, $returnType);
        return $returnType;
    }
    /**
     * Returns the collection of all changes from the change log that have occurred within the scope of the site,
     * based on the specified query.
     * @param ChangeQuery $query
     * @return ChangeCollection
     */
    public function getChanges(ChangeQuery $query)
    {
        $qry = new InvokePostMethodQuery($this, "GetChanges", null, "query", $query);
        $changes = new ChangeCollection($this->getContext());
        $this->getContext()->addQueryAndResultObject($qry, $changes);
        return $changes;
    }
    /**
     * Gets the collection of all lists that are contained in the Web site available to the current user
     * based on the permissions of the current user.
     * @return ListCollection
     */
    public function getLists()
    {
        return $this->getProperty("Lists", new ListCollection($this->getContext(), new ResourcePath("Lists", $this->getResourcePath())));
    }
    /**
     * Gets a Web site collection object that represents all Web sites immediately beneath the Web site,
     * excluding children of those Web sites.
     * @return WebCollection
     */
    public function getWebs()
    {
        return $this->getProperty("Webs", new WebCollection($this->getContext(), new ResourcePath("webs", $this->getResourcePath()), $this));
    }
    /**
     * Gets the collection of field objects that represents all the fields in the Web site.
     * @return FieldCollection
     */
    public function getFields()
    {
        return $this->getProperty("Fields", new FieldCollection($this->getContext(), new ResourcePath("fields", $this->getResourcePath()), $this));
    }
    /**
     * Gets the collection of all first-level folders in the Web site.
     * @return FolderCollection
     */
    public function getFolders()
    {
        return $this->getProperty("Folders", new FolderCollection($this->getContext(), new ResourcePath("folders", $this->getResourcePath())));
    }
    /**
     * Gets the collection of all users that belong to the site collection.
     * @return UserCollection
     */
    public function getSiteUsers()
    {
        return $this->getProperty("SiteUsers", new UserCollection($this->getContext(), new ResourcePath("SiteUsers", $this->getResourcePath())));
    }
    /**
     * Gets the collection of groups for the site collection.
     * @return mixed|null|GroupCollection
     */
    public function getSiteGroups()
    {
        return $this->getProperty("SiteGroups", new GroupCollection($this->getContext(), new ResourcePath("SiteGroups", $this->getResourcePath())));
    }
    /**
     * Gets the collection of role definitions for the Web site.
     * @return RoleDefinitionCollection
     */
    public function getRoleDefinitions()
    {
        return $this->getProperty("RoleDefinitions", new RoleDefinitionCollection($this->getContext(), new ResourcePath("RoleDefinitions", $this->getResourcePath())));
    }
    /**
     * Gets a value that specifies the collection of user custom actions for the site.
     * @return UserCustomActionCollection
     */
    public function getUserCustomActions()
    {
        return $this->getProperty("UserCustomActions", new UserCustomActionCollection($this->getContext(), new ResourcePath("UserCustomActions", $this->getResourcePath())));
    }
    /**
     * @return User
     */
    public function getCurrentUser()
    {
        return $this->getProperty("CurrentUser", new User($this->getContext(), new ResourcePath("CurrentUser", $this->getResourcePath())));
    }
    /**
     * Returns the file object located at the specified server-relative URL.
     * @param string $serverRelativeUrl The server relative URL of the file.
     * @return File
     */
    public function getFileByServerRelativeUrl($serverRelativeUrl)
    {
        return new File($this->getContext(), new ServiceOperationPath("getFileByServerRelativeUrl", array(rawurlencode($serverRelativeUrl)), $this->getResourcePath()));
    }
    /**
     * Returns the file object located at the specified server-relative Path.
     * @param SPResourcePath|string $serverRelativePath The server relative Path of the file.
     * @return File
     */
    public function getFileByServerRelativePath($serverRelativePath)
    {
        if (is_string($serverRelativePath)) {
            $serverRelativePath = new SPResourcePath($serverRelativePath);
        }
        return new File($this->getContext(), new ServiceOperationPath("getFileByServerRelativePath", $serverRelativePath->toJson(), $this->getResourcePath()));
    }
    /**
     * Returns the file object with the specified GUID.
     * @param string uniqueId A GUID that identifies the file object.
     * @return File
     */
    public function getFileById($uniqueId)
    {
        return new File($this->getContext(), new ServiceOperationPath("GetFileById", array($uniqueId), $this->getResourcePath()));
    }
    /**
     * Returns the folder object located at the specified server-relative URL.
     * @param string $serverRelativeUrl The server relative URL of the folder.
     * @return Folder
     */
    public function getFolderByServerRelativeUrl($serverRelativeUrl)
    {
        return new Folder($this->getContext(), new ServiceOperationPath("getFolderByServerRelativeUrl", array(rawurlencode($serverRelativeUrl)), $this->getResourcePath()));
    }
    /**
     * Returns the folder object located at the specified server-relative Path.
     * @param SPResourcePath|string $serverRelativePath
     * @return Folder
     */
    public function getFolderByServerRelativePath($serverRelativePath)
    {
        if (is_string($serverRelativePath)) {
            $serverRelativePath = new SPResourcePath($serverRelativePath);
        }
        return new Folder($this->getContext(), new ServiceOperationPath("getFolderByServerRelativePath", $serverRelativePath->toJson(), $this->getResourcePath()));
    }
    /**
     * Returns the folder object with the specified GUID.
     * @param string uniqueId A GUID that identifies the folder object.
     * @return Folder
     */
    public function getFolderById($uniqueId)
    {
        return new Folder($this->getContext(), new ServiceOperationPath("GetFolderById", array($uniqueId), $this->getResourcePath()));
    }
    /**
     * @return ContentTypeCollection
     */
    public function getContentTypes()
    {
        return $this->getProperty('ContentTypes', new ContentTypeCollection($this->getContext(), new ResourcePath('ContentTypes', $this->getResourcePath())));
    }
    /**
     * @param string $name
     * @param mixed $value
     * @param bool $persistChanges
     * @return self
     */
    public function setProperty($name, $value, $persistChanges = true)
    {
        if ($name === 'ServerRelativeUrl') {
            $this->webUrl = $value;
        }
        parent::setProperty($name, $value, $persistChanges);
        return $this;
    }
    /**
     * @return string
     */
    public function getAccessRequestListUrl()
    {
        return $this->getProperty("AccessRequestListUrl");
    }
    /**
     * @var string
     */
    public function setAccessRequestListUrl($value)
    {
        $this->setProperty("AccessRequestListUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getAccessRequestSiteDescription()
    {
        return $this->getProperty("AccessRequestSiteDescription");
    }
    /**
     * @var string
     */
    public function setAccessRequestSiteDescription($value)
    {
        $this->setProperty("AccessRequestSiteDescription", $value, true);
    }
    /**
     * Gets or 
     * sets a Boolean value that specifies whether the .aspx page within the Web site 
     * is indexed by the search engine.
     * @return bool
     */
    public function getAllowAutomaticASPXPageIndexing()
    {
        return $this->getProperty("AllowAutomaticASPXPageIndexing");
    }
    /**
     * Gets or 
     * sets a Boolean value that specifies whether the .aspx page within the Web site 
     * is indexed by the search engine.
     * @var bool
     */
    public function setAllowAutomaticASPXPageIndexing($value)
    {
        $this->setProperty("AllowAutomaticASPXPageIndexing", $value, true);
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to create declarative workflows. The value, if not disabled on the Web 
     * application, is the same as the scalar property of Microsoft.SharePoint.Client.Site.AllowCreateDeclarativeWorkflow.
     * @return bool
     */
    public function getAllowCreateDeclarativeWorkflowForCurrentUser()
    {
        return $this->getProperty("AllowCreateDeclarativeWorkflowForCurrentUser");
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to create declarative workflows. The value, if not disabled on the Web 
     * application, is the same as the scalar property of Microsoft.SharePoint.Client.Site.AllowCreateDeclarativeWorkflow.
     * @var bool
     */
    public function setAllowCreateDeclarativeWorkflowForCurrentUser($value)
    {
        $this->setProperty("AllowCreateDeclarativeWorkflowForCurrentUser", $value, true);
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to use a designer application to customize this site (2).
     * @return bool
     */
    public function getAllowDesignerForCurrentUser()
    {
        return $this->getProperty("AllowDesignerForCurrentUser");
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to use a designer application to customize this site (2).
     * @var bool
     */
    public function setAllowDesignerForCurrentUser($value)
    {
        $this->setProperty("AllowDesignerForCurrentUser", $value, true);
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to edit the master page.
     * @return bool
     */
    public function getAllowMasterPageEditingForCurrentUser()
    {
        return $this->getProperty("AllowMasterPageEditingForCurrentUser");
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to edit the master page.
     * @var bool
     */
    public function setAllowMasterPageEditingForCurrentUser($value)
    {
        $this->setProperty("AllowMasterPageEditingForCurrentUser", $value, true);
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to revert the site (2) to a 
     * default site template. 
     * @return bool
     */
    public function getAllowRevertFromTemplateForCurrentUser()
    {
        return $this->getProperty("AllowRevertFromTemplateForCurrentUser");
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to revert the site (2) to a 
     * default site template. 
     * @var bool
     */
    public function setAllowRevertFromTemplateForCurrentUser($value)
    {
        $this->setProperty("AllowRevertFromTemplateForCurrentUser", $value, true);
    }
    /**
     * Specifies 
     * whether the site (2) allows RSS 
     * feeds.  
     * @return bool
     */
    public function getAllowRssFeeds()
    {
        return $this->getProperty("AllowRssFeeds");
    }
    /**
     * Specifies 
     * whether the site (2) allows RSS 
     * feeds.  
     * @var bool
     */
    public function setAllowRssFeeds($value)
    {
        $this->setProperty("AllowRssFeeds", $value, true);
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to save declarative workflows as a template. The value, if not disabled 
     * on the Web application, is 
     * the same as the scalar property of Microsoft.SharePoint.Client.Site.AllowSaveDeclarativeWorkflowAsTemplate.
     * @return bool
     */
    public function getAllowSaveDeclarativeWorkflowAsTemplateForCurrentUser()
    {
        return $this->getProperty("AllowSaveDeclarativeWorkflowAsTemplateForCurrentUser");
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to save declarative workflows as a template. The value, if not disabled 
     * on the Web application, is 
     * the same as the scalar property of Microsoft.SharePoint.Client.Site.AllowSaveDeclarativeWorkflowAsTemplate.
     * @var bool
     */
    public function setAllowSaveDeclarativeWorkflowAsTemplateForCurrentUser($value)
    {
        $this->setProperty("AllowSaveDeclarativeWorkflowAsTemplateForCurrentUser", $value, true);
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to save or publish declarative workflows. The value, if not disabled on 
     * the Web 
     * application, is the same as the scalar property of Microsoft.SharePoint.Client.Site.AllowSavePublishDeclarativeWorkflow.
     * @return bool
     */
    public function getAllowSavePublishDeclarativeWorkflowForCurrentUser()
    {
        return $this->getProperty("AllowSavePublishDeclarativeWorkflowForCurrentUser");
    }
    /**
     * Specifies 
     * whether the current user is 
     * allowed to save or publish declarative workflows. The value, if not disabled on 
     * the Web 
     * application, is the same as the scalar property of Microsoft.SharePoint.Client.Site.AllowSavePublishDeclarativeWorkflow.
     * @var bool
     */
    public function setAllowSavePublishDeclarativeWorkflowForCurrentUser($value)
    {
        $this->setProperty("AllowSavePublishDeclarativeWorkflowForCurrentUser", $value, true);
    }
    /**
     * Gets or 
     * sets the URL for an alternate cascading style sheet (CSS) to use in the 
     * website.A string 
     * that contains the URL for an alternate CSS file.
     * @return string
     */
    public function getAlternateCssUrl()
    {
        return $this->getProperty("AlternateCssUrl");
    }
    /**
     * Gets or 
     * sets the URL for an alternate cascading style sheet (CSS) to use in the 
     * website.A string 
     * that contains the URL for an alternate CSS file.
     * @var string
     */
    public function setAlternateCssUrl($value)
    {
        $this->setProperty("AlternateCssUrl", $value, true);
    }
    /**
     * Specifies 
     * the identifier of the app instance that 
     * this site 
     * (2) represents. If this site (2) does not represent an app instance, 
     * then this MUST specify an empty GUID.
     * @return string
     */
    public function getAppInstanceId()
    {
        return $this->getProperty("AppInstanceId");
    }
    /**
     * Specifies 
     * the identifier of the app instance that 
     * this site 
     * (2) represents. If this site (2) does not represent an app instance, 
     * then this MUST specify an empty GUID.
     * @var string
     */
    public function setAppInstanceId($value)
    {
        $this->setProperty("AppInstanceId", $value, true);
    }
    /**
     * @return string
     */
    public function getClassicWelcomePage()
    {
        return $this->getProperty("ClassicWelcomePage");
    }
    /**
     * @var string
     */
    public function setClassicWelcomePage($value)
    {
        $this->setProperty("ClassicWelcomePage", $value, true);
    }
    /**
     * Indicates 
     * whether comments on site pages are disabled or not.
     * @return bool
     */
    public function getCommentsOnSitePagesDisabled()
    {
        if (!$this->isPropertyAvailable("CommentsOnSitePagesDisabled")) {
            return null;
        }
        return $this->getProperty("CommentsOnSitePagesDisabled");
    }
    /**
     * Indicates 
     * whether comments on site pages are disabled or not.
     * @var bool
     */
    public function setCommentsOnSitePagesDisabled($value)
    {
        $this->setProperty("CommentsOnSitePagesDisabled", $value, true);
    }
    /**
     * Gets a 
     * Boolean value that specifies whether the site contains highly confidential 
     * information.If the tenant settings don't allow tagging sites as 
     * confidential, this property will return false.
     * @return bool
     */
    public function getContainsConfidentialInfo()
    {
        if (!$this->isPropertyAvailable("ContainsConfidentialInfo")) {
            return null;
        }
        return $this->getProperty("ContainsConfidentialInfo");
    }
    /**
     * Gets a 
     * Boolean value that specifies whether the site contains highly confidential 
     * information.If the tenant settings don't allow tagging sites as 
     * confidential, this property will return false.
     * @var bool
     */
    public function setContainsConfidentialInfo($value)
    {
        $this->setProperty("ContainsConfidentialInfo", $value, true);
    }
    /**
     * Specifies 
     * when the site (2) was 
     * created.    It MUST NOT be NULL. 
     * @return string
     */
    public function getCreated()
    {
        if (!$this->isPropertyAvailable("Created")) {
            return null;
        }
        return $this->getProperty("Created");
    }
    /**
     * Specifies 
     * when the site (2) was 
     * created.    It MUST NOT be NULL. 
     * @var string
     */
    public function setCreated($value)
    {
        $this->setProperty("Created", $value, true);
    }
    /**
     * Gets the 
     * current change token that is implemented in a query against the change log 
     * through the GetChanges method.An SPChangeToken 
     * object that represents the change token.
     * @return ChangeToken
     */
    public function getCurrentChangeToken()
    {
        if (!$this->isPropertyAvailable("CurrentChangeToken")) {
            return null;
        }
        return $this->getProperty("CurrentChangeToken");
    }
    /**
     * Gets the 
     * current change token that is implemented in a query against the change log 
     * through the GetChanges method.An SPChangeToken 
     * object that represents the change token.
     * @var ChangeToken
     */
    public function setCurrentChangeToken($value)
    {
        $this->setProperty("CurrentChangeToken", $value, true);
    }
    /**
     * Specifies 
     * the URL 
     * for a custom master page to apply 
     * to the Web site.<129>
     * @return string
     */
    public function getCustomMasterUrl()
    {
        if (!$this->isPropertyAvailable("CustomMasterUrl")) {
            return null;
        }
        return $this->getProperty("CustomMasterUrl");
    }
    /**
     * Specifies 
     * the URL 
     * for a custom master page to apply 
     * to the Web site.<129>
     * @var string
     */
    public function setCustomMasterUrl($value)
    {
        $this->setProperty("CustomMasterUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getCustomSiteActionsDisabled()
    {
        if (!$this->isPropertyAvailable("CustomSiteActionsDisabled")) {
            return null;
        }
        return $this->getProperty("CustomSiteActionsDisabled");
    }
    /**
     * @var bool
     */
    public function setCustomSiteActionsDisabled($value)
    {
        $this->setProperty("CustomSiteActionsDisabled", $value, true);
    }
    /**
     * Specifies 
     * the description for the site (2).   
     * @return string
     */
    public function getDescription()
    {
        return $this->getProperty("Description");
    }
    /**
     * Specifies 
     * the description for the site (2).   
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     * Specifies 
     * the URL where the current user can 
     * download a designer.
     * @return string
     */
    public function getDesignerDownloadUrlForCurrentUser()
    {
        return $this->getProperty("DesignerDownloadUrlForCurrentUser");
    }
    /**
     * Specifies 
     * the URL where the current user can 
     * download a designer.
     * @var string
     */
    public function setDesignerDownloadUrlForCurrentUser($value)
    {
        $this->setProperty("DesignerDownloadUrlForCurrentUser", $value, true);
    }
    /**
     * Gets or 
     * sets the ID of the Design Package used in this SPWeb.A value of 
     * Guid.Empty will mean that the default Design Package will be used for this 
     * SPWeb. The default is determined by the SPWebTemplate of this SPWeb.
     * @return string
     */
    public function getDesignPackageId()
    {
        return $this->getProperty("DesignPackageId");
    }
    /**
     * Gets or 
     * sets the ID of the Design Package used in this SPWeb.A value of 
     * Guid.Empty will mean that the default Design Package will be used for this 
     * SPWeb. The default is determined by the SPWebTemplate of this SPWeb.
     * @var string
     */
    public function setDesignPackageId($value)
    {
        $this->setProperty("DesignPackageId", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisableAppViews()
    {
        return $this->getProperty("DisableAppViews");
    }
    /**
     * @var bool
     */
    public function setDisableAppViews($value)
    {
        $this->setProperty("DisableAppViews", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisableFlows()
    {
        return $this->getProperty("DisableFlows");
    }
    /**
     * @var bool
     */
    public function setDisableFlows($value)
    {
        $this->setProperty("DisableFlows", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisableRecommendedItems()
    {
        return $this->getProperty("DisableRecommendedItems");
    }
    /**
     * @var bool
     */
    public function setDisableRecommendedItems($value)
    {
        $this->setProperty("DisableRecommendedItems", $value, true);
    }
    /**
     * Specifies 
     * whether the Office Add-in 
     * previews are disabled for the context menus in a document library.
     * @return bool
     */
    public function getDocumentLibraryCalloutOfficeWebAppPreviewersDisabled()
    {
        return $this->getProperty("DocumentLibraryCalloutOfficeWebAppPreviewersDisabled");
    }
    /**
     * Specifies 
     * whether the Office Add-in 
     * previews are disabled for the context menus in a document library.
     * @var bool
     */
    public function setDocumentLibraryCalloutOfficeWebAppPreviewersDisabled($value)
    {
        $this->setProperty("DocumentLibraryCalloutOfficeWebAppPreviewersDisabled", $value, true);
    }
    /**
     * Specifies 
     * the effective permissions that are 
     * assigned to the current user.  It MUST NOT be NULL. 
     * @return BasePermissions
     */
    public function getEffectiveBasePermissions()
    {
        return $this->getProperty("EffectiveBasePermissions");
    }
    /**
     * Specifies 
     * the effective permissions that are 
     * assigned to the current user.  It MUST NOT be NULL. 
     * @var BasePermissions
     */
    public function setEffectiveBasePermissions($value)
    {
        $this->setProperty("EffectiveBasePermissions", $value, true);
    }
    /**
     * Specifies 
     * whether the site will use the minimal download strategy by default.<127>The 
     * minimal download strategy will use a single .aspx file (start.aspx) for your 
     * pages, with the actual URL encoded in the 
     * text following the hash mark ('#'). When navigating from page to page, only the 
     * changes between two compatible pages will be downloaded. Fewer bytes will be 
     * downloaded and the page will appear more quickly.
     * @return bool
     */
    public function getEnableMinimalDownload()
    {
        return $this->getProperty("EnableMinimalDownload");
    }
    /**
     * Specifies 
     * whether the site will use the minimal download strategy by default.<127>The 
     * minimal download strategy will use a single .aspx file (start.aspx) for your 
     * pages, with the actual URL encoded in the 
     * text following the hash mark ('#'). When navigating from page to page, only the 
     * changes between two compatible pages will be downloaded. Fewer bytes will be 
     * downloaded and the page will appear more quickly.
     * @var bool
     */
    public function setEnableMinimalDownload($value)
    {
        $this->setProperty("EnableMinimalDownload", $value, true);
    }
    /**
     * Indicates 
     * whether the data from the website is to be downloaded to the client during 
     * offline synchronization. A value of "true" means yes.
     * @return bool
     */
    public function getExcludeFromOfflineClient()
    {
        return $this->getProperty("ExcludeFromOfflineClient");
    }
    /**
     * Indicates 
     * whether the data from the website is to be downloaded to the client during 
     * offline synchronization. A value of "true" means yes.
     * @var bool
     */
    public function setExcludeFromOfflineClient($value)
    {
        $this->setProperty("ExcludeFromOfflineClient", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterEmphasis()
    {
        return $this->getProperty("FooterEmphasis");
    }
    /**
     * @var integer
     */
    public function setFooterEmphasis($value)
    {
        $this->setProperty("FooterEmphasis", $value, true);
    }
    /**
     * @return bool
     */
    public function getFooterEnabled()
    {
        return $this->getProperty("FooterEnabled");
    }
    /**
     * @var bool
     */
    public function setFooterEnabled($value)
    {
        $this->setProperty("FooterEnabled", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterLayout()
    {
        return $this->getProperty("FooterLayout");
    }
    /**
     * @var integer
     */
    public function setFooterLayout($value)
    {
        $this->setProperty("FooterLayout", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderEmphasis()
    {
        return $this->getProperty("HeaderEmphasis");
    }
    /**
     * @var integer
     */
    public function setHeaderEmphasis($value)
    {
        $this->setProperty("HeaderEmphasis", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderLayout()
    {
        return $this->getProperty("HeaderLayout");
    }
    /**
     * @var integer
     */
    public function setHeaderLayout($value)
    {
        $this->setProperty("HeaderLayout", $value, true);
    }
    /**
     * @return bool
     */
    public function getHorizontalQuickLaunch()
    {
        return $this->getProperty("HorizontalQuickLaunch");
    }
    /**
     * @var bool
     */
    public function setHorizontalQuickLaunch($value)
    {
        $this->setProperty("HorizontalQuickLaunch", $value, true);
    }
    /**
     * Specifies 
     * the site 
     * identifier for the site (2).  
     * @return string
     */
    public function getId()
    {
        return $this->getProperty("Id");
    }
    /**
     * Specifies 
     * the site 
     * identifier for the site (2).  
     * @var string
     */
    public function setId($value)
    {
        $this->setProperty("Id", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsHomepageModernized()
    {
        return $this->getProperty("IsHomepageModernized");
    }
    /**
     * @var bool
     */
    public function setIsHomepageModernized($value)
    {
        $this->setProperty("IsHomepageModernized", $value, true);
    }
    /**
     * Gets or 
     * sets whether Multilingual UI is turned on for this web or not.
     * @return bool
     */
    public function getIsMultilingual()
    {
        return $this->getProperty("IsMultilingual");
    }
    /**
     * Gets or 
     * sets whether Multilingual UI is turned on for this web or not.
     * @var bool
     */
    public function setIsMultilingual($value)
    {
        $this->setProperty("IsMultilingual", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsProvisioningComplete()
    {
        return $this->getProperty("IsProvisioningComplete");
    }
    /**
     * @var bool
     */
    public function setIsProvisioningComplete($value)
    {
        $this->setProperty("IsProvisioningComplete", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsRevertHomepageLinkHidden()
    {
        return $this->getProperty("IsRevertHomepageLinkHidden");
    }
    /**
     * @var bool
     */
    public function setIsRevertHomepageLinkHidden($value)
    {
        $this->setProperty("IsRevertHomepageLinkHidden", $value, true);
    }
    /**
     * Specifies 
     * the language 
     * code identifier (LCID) for the language that is used on the site (2).  
     * @return integer
     */
    public function getLanguage()
    {
        return $this->getProperty("Language");
    }
    /**
     * Specifies 
     * the language 
     * code identifier (LCID) for the language that is used on the site (2).  
     * @var integer
     */
    public function setLanguage($value)
    {
        $this->setProperty("Language", $value, true);
    }
    /**
     * Specifies 
     * when an item was last 
     * modified in the site (2).  
     * @return string
     */
    public function getLastItemModifiedDate()
    {
        return $this->getProperty("LastItemModifiedDate");
    }
    /**
     * Specifies 
     * when an item was last 
     * modified in the site (2).  
     * @var string
     */
    public function setLastItemModifiedDate($value)
    {
        $this->setProperty("LastItemModifiedDate", $value, true);
    }
    /**
     * Gets the 
     * date and time that an item was last modified in the site by a non-system 
     * update. A non-system update is a change to a list item that is visible to end 
     * users.
     * @return string
     */
    public function getLastItemUserModifiedDate()
    {
        return $this->getProperty("LastItemUserModifiedDate");
    }
    /**
     * Gets the 
     * date and time that an item was last modified in the site by a non-system 
     * update. A non-system update is a change to a list item that is visible to end 
     * users.
     * @var string
     */
    public function setLastItemUserModifiedDate($value)
    {
        $this->setProperty("LastItemUserModifiedDate", $value, true);
    }
    /**
     * Specifies 
     * the URL 
     * for a custom master page to apply 
     * to the Web site.<129>
     * @return string
     */
    public function getMasterUrl()
    {
        return $this->getProperty("MasterUrl");
    }
    /**
     * Specifies 
     * the URL 
     * for a custom master page to apply 
     * to the Web site.<129>
     * @var string
     */
    public function setMasterUrl($value)
    {
        $this->setProperty("MasterUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getMegaMenuEnabled()
    {
        return $this->getProperty("MegaMenuEnabled");
    }
    /**
     * @var bool
     */
    public function setMegaMenuEnabled($value)
    {
        $this->setProperty("MegaMenuEnabled", $value, true);
    }
    /**
     * Specifies 
     * whether to enable site members to invite external users.
     * @return bool
     */
    public function getMembersCanShare()
    {
        return $this->getProperty("MembersCanShare");
    }
    /**
     * Specifies 
     * whether to enable site members to invite external users.
     * @var bool
     */
    public function setMembersCanShare($value)
    {
        $this->setProperty("MembersCanShare", $value, true);
    }
    /**
     * @return bool
     */
    public function getNavAudienceTargetingEnabled()
    {
        return $this->getProperty("NavAudienceTargetingEnabled");
    }
    /**
     * @var bool
     */
    public function setNavAudienceTargetingEnabled($value)
    {
        $this->setProperty("NavAudienceTargetingEnabled", $value, true);
    }
    /**
     * Gets or 
     * sets a Boolean value that specifies whether searching is enabled for the Web 
     * site.
     * @return bool
     */
    public function getNoCrawl()
    {
        return $this->getProperty("NoCrawl");
    }
    /**
     * Gets or 
     * sets a Boolean value that specifies whether searching is enabled for the Web 
     * site.
     * @var bool
     */
    public function setNoCrawl($value)
    {
        $this->setProperty("NoCrawl", $value, true);
    }
    /**
     * Returns if 
     * true if the tenant allowed to send push notifications in ODB.
     * @return bool
     */
    public function getNotificationsInOneDriveForBusinessEnabled()
    {
        return $this->getProperty("NotificationsInOneDriveForBusinessEnabled");
    }
    /**
     * Returns if 
     * true if the tenant allowed to send push notifications in ODB.
     * @var bool
     */
    public function setNotificationsInOneDriveForBusinessEnabled($value)
    {
        $this->setProperty("NotificationsInOneDriveForBusinessEnabled", $value, true);
    }
    /**
     * Returns if 
     * true if the tenant allowed to send push notifications in SharePoint.
     * @return bool
     */
    public function getNotificationsInSharePointEnabled()
    {
        return $this->getProperty("NotificationsInSharePointEnabled");
    }
    /**
     * Returns if 
     * true if the tenant allowed to send push notifications in SharePoint.
     * @var bool
     */
    public function setNotificationsInSharePointEnabled($value)
    {
        $this->setProperty("NotificationsInSharePointEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getObjectCacheEnabled()
    {
        return $this->getProperty("ObjectCacheEnabled");
    }
    /**
     * @var bool
     */
    public function setObjectCacheEnabled($value)
    {
        $this->setProperty("ObjectCacheEnabled", $value, true);
    }
    /**
     * Gets or 
     * sets whether changing the UserResource value in the UICulture of the web 
     * overwrites the values for AdditionalUICultures or not.
     * @return bool
     */
    public function getOverwriteTranslationsOnChange()
    {
        if (!$this->isPropertyAvailable("OverwriteTranslationsOnChange")) {
            return null;
        }
        return $this->getProperty("OverwriteTranslationsOnChange");
    }
    /**
     * Gets or 
     * sets whether changing the UserResource value in the UICulture of the web 
     * overwrites the values for AdditionalUICultures or not.
     * @var bool
     */
    public function setOverwriteTranslationsOnChange($value)
    {
        $this->setProperty("OverwriteTranslationsOnChange", $value, true);
    }
    /**
     * Indicates 
     * whether the tenant administrator has chosen to disable the Preview Features.Defaults 
     * to True: Preview Features are enabled.
     * @return bool
     */
    public function getPreviewFeaturesEnabled()
    {
        if (!$this->isPropertyAvailable("PreviewFeaturesEnabled")) {
            return null;
        }
        return $this->getProperty("PreviewFeaturesEnabled");
    }
    /**
     * Indicates 
     * whether the tenant administrator has chosen to disable the Preview Features.Defaults 
     * to True: Preview Features are enabled.
     * @var bool
     */
    public function setPreviewFeaturesEnabled($value)
    {
        $this->setProperty("PreviewFeaturesEnabled", $value, true);
    }
    /**
     * @return string
     */
    public function getPrimaryColor()
    {
        if (!$this->isPropertyAvailable("PrimaryColor")) {
            return null;
        }
        return $this->getProperty("PrimaryColor");
    }
    /**
     * @var string
     */
    public function setPrimaryColor($value)
    {
        $this->setProperty("PrimaryColor", $value, true);
    }
    /**
     * Specifies 
     * whether the Quick Launch area is 
     * enabled on the site (2).  
     * @return bool
     */
    public function getQuickLaunchEnabled()
    {
        if (!$this->isPropertyAvailable("QuickLaunchEnabled")) {
            return null;
        }
        return $this->getProperty("QuickLaunchEnabled");
    }
    /**
     * Specifies 
     * whether the Quick Launch area is 
     * enabled on the site (2).  
     * @var bool
     */
    public function setQuickLaunchEnabled($value)
    {
        $this->setProperty("QuickLaunchEnabled", $value, true);
    }
    /**
     * Specifies 
     * whether the Recycle Bin is 
     * enabled. 
     * @return bool
     */
    public function getRecycleBinEnabled()
    {
        if (!$this->isPropertyAvailable("RecycleBinEnabled")) {
            return null;
        }
        return $this->getProperty("RecycleBinEnabled");
    }
    /**
     * Specifies 
     * whether the Recycle Bin is 
     * enabled. 
     * @var bool
     */
    public function setRecycleBinEnabled($value)
    {
        $this->setProperty("RecycleBinEnabled", $value, true);
    }
    /**
     * Gets or 
     * sets the e-mail address to which requests for access are sent.
     * @return string
     */
    public function getRequestAccessEmail()
    {
        if (!$this->isPropertyAvailable("RequestAccessEmail")) {
            return null;
        }
        return $this->getProperty("RequestAccessEmail");
    }
    /**
     * Gets or 
     * sets the e-mail address to which requests for access are sent.
     * @var string
     */
    public function setRequestAccessEmail($value)
    {
        $this->setProperty("RequestAccessEmail", $value, true);
    }
    /**
     * Specifies 
     * if the site (2) can be 
     * saved as a site template.A feature 
     * that creates content which is not compatible for a site template can set this 
     * value to false to stop users of this site (2) from generating an invalid site 
     * template.A feature ought to never set this value to true when it is 
     * deactivated or at any other time since another feature might have created 
     * content that is not compatible in a site template.Setting this value to false, if it was true, will result in 
     * a site template that is not supported.
     * @return bool
     */
    public function getSaveSiteAsTemplateEnabled()
    {
        if (!$this->isPropertyAvailable("SaveSiteAsTemplateEnabled")) {
            return null;
        }
        return $this->getProperty("SaveSiteAsTemplateEnabled");
    }
    /**
     * Specifies 
     * if the site (2) can be 
     * saved as a site template.A feature 
     * that creates content which is not compatible for a site template can set this 
     * value to false to stop users of this site (2) from generating an invalid site 
     * template.A feature ought to never set this value to true when it is 
     * deactivated or at any other time since another feature might have created 
     * content that is not compatible in a site template.Setting this value to false, if it was true, will result in 
     * a site template that is not supported.
     * @var bool
     */
    public function setSaveSiteAsTemplateEnabled($value)
    {
        $this->setProperty("SaveSiteAsTemplateEnabled", $value, true);
    }
    /**
     * @return integer
     */
    public function getSearchBoxInNavBar()
    {
        if (!$this->isPropertyAvailable("SearchBoxInNavBar")) {
            return null;
        }
        return $this->getProperty("SearchBoxInNavBar");
    }
    /**
     * @var integer
     */
    public function setSearchBoxInNavBar($value)
    {
        $this->setProperty("SearchBoxInNavBar", $value, true);
    }
    /**
     * @return string
     */
    public function getSearchBoxPlaceholderText()
    {
        if (!$this->isPropertyAvailable("SearchBoxPlaceholderText")) {
            return null;
        }
        return $this->getProperty("SearchBoxPlaceholderText");
    }
    /**
     * @var string
     */
    public function setSearchBoxPlaceholderText($value)
    {
        $this->setProperty("SearchBoxPlaceholderText", $value, true);
    }
    /**
     * @return integer
     */
    public function getSearchScope()
    {
        if (!$this->isPropertyAvailable("SearchScope")) {
            return null;
        }
        return $this->getProperty("SearchScope");
    }
    /**
     * @var integer
     */
    public function setSearchScope($value)
    {
        $this->setProperty("SearchScope", $value, true);
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of the site (2).It MUST 
     * NOT be NULL. It MUST NOT contain any of the reserved Uniform Resource Locators 
     * (URLs). Reserved URLs are implementation-specific and not defined by 
     * this protocol. It MUST NOT contain the following illegal characters: 
     * [!#$&'+:<>?\\{|}~]|(//)|(\.\.)|(/_)|(/wpresources$)|(/wpresources/)
     * @return string
     */
    public function getServerRelativeUrl()
    {
        if (!$this->isPropertyAvailable("ServerRelativeUrl")) {
            return null;
        }
        return $this->getProperty("ServerRelativeUrl");
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of the site (2).It MUST 
     * NOT be NULL. It MUST NOT contain any of the reserved Uniform Resource Locators 
     * (URLs). Reserved URLs are implementation-specific and not defined by 
     * this protocol. It MUST NOT contain the following illegal characters: 
     * [!#$&'+:<>?\\{|}~]|(//)|(\.\.)|(/_)|(/wpresources$)|(/wpresources/)
     * @var string
     */
    public function setServerRelativeUrl($value)
    {
        $this->setProperty("ServerRelativeUrl", $value, true);
    }
    /**
     * Specifies 
     * whether the current user is able 
     * to view the file system structure of this site (2).
     * @return bool
     */
    public function getShowUrlStructureForCurrentUser()
    {
        if (!$this->isPropertyAvailable("ShowUrlStructureForCurrentUser")) {
            return null;
        }
        return $this->getProperty("ShowUrlStructureForCurrentUser");
    }
    /**
     * Specifies 
     * whether the current user is able 
     * to view the file system structure of this site (2).
     * @var bool
     */
    public function setShowUrlStructureForCurrentUser($value)
    {
        $this->setProperty("ShowUrlStructureForCurrentUser", $value, true);
    }
    /**
     * Gets or 
     * sets the description of the Web site logo.
     * @return string
     */
    public function getSiteLogoDescription()
    {
        if (!$this->isPropertyAvailable("SiteLogoDescription")) {
            return null;
        }
        return $this->getProperty("SiteLogoDescription");
    }
    /**
     * Gets or 
     * sets the description of the Web site logo.
     * @var string
     */
    public function setSiteLogoDescription($value)
    {
        $this->setProperty("SiteLogoDescription", $value, true);
    }
    /**
     * Specifies 
     * the server-relative URL of the Web site logo.
     * @return string
     */
    public function getSiteLogoUrl()
    {
        if (!$this->isPropertyAvailable("SiteLogoUrl")) {
            return null;
        }
        return $this->getProperty("SiteLogoUrl");
    }
    /**
     * Specifies 
     * the server-relative URL of the Web site logo.
     * @var string
     */
    public function setSiteLogoUrl($value)
    {
        $this->setProperty("SiteLogoUrl", $value, true);
    }
    /**
     * Accessibility: Read OnlySpecifies 
     * the language 
     * code identifiers (LCIDs) of the languages that are enabled for the site (2).
     * @var array
     */
    public function setSupportedUILanguageIds($value)
    {
        $this->setProperty("SupportedUILanguageIds", $value, true);
    }
    /**
     * Specifies 
     * whether the [RSS2.0] feeds 
     * are enabled on the site (2).
     * @return bool
     */
    public function getSyndicationEnabled()
    {
        if (!$this->isPropertyAvailable("SyndicationEnabled")) {
            return null;
        }
        return $this->getProperty("SyndicationEnabled");
    }
    /**
     * Specifies 
     * whether the [RSS2.0] feeds 
     * are enabled on the site (2).
     * @var bool
     */
    public function setSyndicationEnabled($value)
    {
        $this->setProperty("SyndicationEnabled", $value, true);
    }
    /**
     * @return integer
     */
    public function getTenantAdminMembersCanShare()
    {
        if (!$this->isPropertyAvailable("TenantAdminMembersCanShare")) {
            return null;
        }
        return $this->getProperty("TenantAdminMembersCanShare");
    }
    /**
     * @var integer
     */
    public function setTenantAdminMembersCanShare($value)
    {
        $this->setProperty("TenantAdminMembersCanShare", $value, true);
    }
    /**
     * @return bool
     */
    public function getTenantTagPolicyEnabled()
    {
        return $this->getProperty("TenantTagPolicyEnabled");
    }
    /**
     * @var bool
     */
    public function setTenantTagPolicyEnabled($value)
    {
        $this->setProperty("TenantTagPolicyEnabled", $value, true);
    }
    /**
     * A string 
     * of JSON 
     * representing a theme.
     * @return string
     */
    public function getThemeData()
    {
        return $this->getProperty("ThemeData");
    }
    /**
     * A string 
     * of JSON 
     * representing a theme.
     * @var string
     */
    public function setThemeData($value)
    {
        $this->setProperty("ThemeData", $value, true);
    }
    /**
     * Returns 
     * the URL of the folder containing the themed CSS for the web, null if no theme 
     * is applied.
     * @return string
     */
    public function getThemedCssFolderUrl()
    {
        return $this->getProperty("ThemedCssFolderUrl");
    }
    /**
     * Returns 
     * the URL of the folder containing the themed CSS for the web, null if no theme 
     * is applied.
     * @var string
     */
    public function setThemedCssFolderUrl($value)
    {
        $this->setProperty("ThemedCssFolderUrl", $value, true);
    }
    /**
     * Gets the 
     * value that indicates whether or not the tenant that uses third-party Mobile 
     * Device Management (MDM) have block access to the public OneDrive app, and direct 
     * users to their company version of the app.        
     * @return bool
     */
    public function getThirdPartyMdmEnabled()
    {
        return $this->getProperty("ThirdPartyMdmEnabled");
    }
    /**
     * Gets the 
     * value that indicates whether or not the tenant that uses third-party Mobile 
     * Device Management (MDM) have block access to the public OneDrive app, and direct 
     * users to their company version of the app.        
     * @var bool
     */
    public function setThirdPartyMdmEnabled($value)
    {
        $this->setProperty("ThirdPartyMdmEnabled", $value, true);
    }
    /**
     * Specifies 
     * the title for the site (2).Its length 
     * MUST be equal to or less than 255. 
     * @return string
     */
    public function getTitle()
    {
        return $this->getProperty("Title");
    }
    /**
     * Specifies
     * the title for the site (2).Its length
     * MUST be equal to or less than 255.
     * @return Web
     * @var string
     */
    public function setTitle($value)
    {
        $this->setProperty("Title", $value, true);
        return $this;
    }
    /**
     * Specifies 
     * whether the tree view is enabled on the site (2). 
     * @return bool
     */
    public function getTreeViewEnabled()
    {
        return $this->getProperty("TreeViewEnabled");
    }
    /**
     * Specifies 
     * whether the tree view is enabled on the site (2). 
     * @var bool
     */
    public function setTreeViewEnabled($value)
    {
        $this->setProperty("TreeViewEnabled", $value, true);
    }
    /**
     * Specifies 
     * which version of the user interface (UI) the site (2) is using. 
     * This value MUST be a defined SPValidUIVersion value, as specified in the 
     * following table.SPValidUIVersionDescription3Specifies that the site (2) is using the SharePoint 
     *   2007 user interface (UI).4Specifies that the site (2) is using the SharePoint 
     *   2010 user interface (UI).
     * @return integer
     */
    public function getUIVersion()
    {
        return $this->getProperty("UIVersion");
    }
    /**
     * Specifies 
     * which version of the user interface (UI) the site (2) is using. 
     * This value MUST be a defined SPValidUIVersion value, as specified in the 
     * following table.SPValidUIVersionDescription3Specifies that the site (2) is using the SharePoint 
     *   2007 user interface (UI).4Specifies that the site (2) is using the SharePoint 
     *   2010 user interface (UI).
     * @var integer
     */
    public function setUIVersion($value)
    {
        $this->setProperty("UIVersion", $value, true);
    }
    /**
     * Specifies 
     * whether the settings UI for visual upgrade is 
     * shown or hidden.
     * @return bool
     */
    public function getUIVersionConfigurationEnabled()
    {
        return $this->getProperty("UIVersionConfigurationEnabled");
    }
    /**
     * Specifies 
     * whether the settings UI for visual upgrade is 
     * shown or hidden.
     * @var bool
     */
    public function setUIVersionConfigurationEnabled($value)
    {
        $this->setProperty("UIVersionConfigurationEnabled", $value, true);
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of the site (2).It MUST 
     * NOT be NULL. It MUST NOT contain any of the reserved Uniform Resource Locators 
     * (URLs). Reserved URLs are implementation-specific and not defined by 
     * this protocol. It MUST NOT contain the following illegal characters: 
     * [!#$&'+:<>?\\{|}~]|(//)|(\.\.)|(/_)|(/wpresources$)|(/wpresources/)
     * @return string
     */
    public function getUrl()
    {
        return $this->getProperty("Url");
    }
    /**
     * Specifies 
     * the server-relative 
     * URL of the site (2).It MUST 
     * NOT be NULL. It MUST NOT contain any of the reserved Uniform Resource Locators 
     * (URLs). Reserved URLs are implementation-specific and not defined by 
     * this protocol. It MUST NOT contain the following illegal characters: 
     * [!#$&'+:<>?\\{|}~]|(//)|(\.\.)|(/_)|(/wpresources$)|(/wpresources/)
     * @var string
     */
    public function setUrl($value)
    {
        $this->setProperty("Url", $value, true);
    }
    /**
     * @return bool
     */
    public function getUseAccessRequestDefault()
    {
        return $this->getProperty("UseAccessRequestDefault");
    }
    /**
     * @var bool
     */
    public function setUseAccessRequestDefault($value)
    {
        $this->setProperty("UseAccessRequestDefault", $value, true);
    }
    /**
     * Specifies 
     * the name of the site definition that 
     * was used to create the site (2). If the 
     * site (2) was created with a custom site template this 
     * specifies the name of the site definition from which the custom site template 
     * is derived.
     * @return string
     */
    public function getWebTemplate()
    {
        return $this->getProperty("WebTemplate");
    }
    /**
     * Specifies 
     * the name of the site definition that 
     * was used to create the site (2). If the 
     * site (2) was created with a custom site template this 
     * specifies the name of the site definition from which the custom site template 
     * is derived.
     * @var string
     */
    public function setWebTemplate($value)
    {
        $this->setProperty("WebTemplate", $value, true);
    }
    /**
     * Specifies 
     * the URL 
     * of the Welcome page for the 
     * site 
     * (2).
     * @return string
     */
    public function getWelcomePage()
    {
        return $this->getProperty("WelcomePage");
    }
    /**
     * Specifies
     * the URL
     * of the Welcome page for the
     * site
     * (2).
     *
     * @return self
     * @var string
     */
    public function setWelcomePage($value)
    {
        return $this->setProperty("WelcomePage", $value, true);
    }
    /**
     * Specifies 
     * the default site (2)group 
     * that was created with contribute permissions at the time the site (2) was 
     * created.
     * @return Group
     */
    public function getAssociatedMemberGroup()
    {
        return $this->getProperty("AssociatedMemberGroup", new Group($this->getContext(), new ResourcePath("AssociatedMemberGroup", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the default site (2)group 
     * that was created with full control permissions at the time the site (2) was 
     * created.
     * @return Group
     */
    public function getAssociatedOwnerGroup()
    {
        return $this->getProperty("AssociatedOwnerGroup", new Group($this->getContext(), new ResourcePath("AssociatedOwnerGroup", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the default site (2)group 
     * that was created with read permissions at the time the site (2) was created.
     * @return Group
     */
    public function getAssociatedVisitorGroup()
    {
        return $this->getProperty("AssociatedVisitorGroup", new Group($this->getContext(), new ResourcePath("AssociatedVisitorGroup", $this->getResourcePath())));
    }
    /**
     * Gets a 
     * user object that represents the user who created the Web site.
     * @return User
     */
    public function getAuthor()
    {
        return $this->getProperty("Author", new User($this->getContext(), new ResourcePath("Author", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the collection of all site content types 
     * that apply to the current scope, including those of the current site (2), 
     * as well as any parent sites.   It MUST NOT be NULL. 
     * @return ContentTypeCollection
     */
    public function getAvailableContentTypes()
    {
        return $this->getProperty("AvailableContentTypes", new ContentTypeCollection($this->getContext(), new ResourcePath("AvailableContentTypes", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the collection of all fields (2) available 
     * for the current scope, including those of the current site (2), as well as 
     * any parent 
     * sites.   It MUST NOT be NULL. 
     * @return FieldCollection
     */
    public function getAvailableFields()
    {
        return $this->getProperty("AvailableFields", new FieldCollection($this->getContext(), new ResourcePath("AvailableFields", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * whether the Recycle Bin is 
     * enabled. 
     * @return RecycleBinItemCollection
     */
    public function getRecycleBin()
    {
        return $this->getProperty("RecycleBin", new RecycleBinItemCollection($this->getContext(), new ResourcePath("RecycleBin", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the root 
     * folder for the site (2). 
     * @return Folder
     */
    public function getRootFolder()
    {
        return $this->getProperty("RootFolder", new Folder($this->getContext(), new ResourcePath("RootFolder", $this->getResourcePath())));
    }
    /**
     * @return UserResource
     */
    public function getDescriptionResource()
    {
        return $this->getProperty("DescriptionResource", new UserResource($this->getContext(), new ResourcePath("DescriptionResource", $this->getResourcePath())));
    }
    /**
     * @return UserResource
     */
    public function getTitleResource()
    {
        return $this->getProperty("TitleResource", new UserResource($this->getContext(), new ResourcePath("TitleResource", $this->getResourcePath())));
    }
    /**
     * @return SPDataLeakagePreventionStatusInfo
     */
    public function getDataLeakagePreventionStatusInfo()
    {
        return $this->getProperty("DataLeakagePreventionStatusInfo", new SPDataLeakagePreventionStatusInfo($this->getContext(), new ResourcePath("DataLeakagePreventionStatusInfo", $this->getResourcePath())));
    }
    /**
     * @return MultilingualSettings
     */
    public function getMultilingualSettings()
    {
        return $this->getProperty("MultilingualSettings", new MultilingualSettings($this->getContext(), new ResourcePath("MultilingualSettings", $this->getResourcePath())));
    }
    /**
     * @return Navigation
     */
    public function getNavigation()
    {
        return $this->getProperty("Navigation", new Navigation($this->getContext(), new ResourcePath("Navigation", $this->getResourcePath())));
    }
    /**
     * @return WebInformation
     */
    public function getParentWeb()
    {
        return $this->getProperty("ParentWeb", new WebInformation($this->getContext(), new ResourcePath("ParentWeb", $this->getResourcePath())));
    }
    /**
     * @return RegionalSettings
     */
    public function getRegionalSettings()
    {
        return $this->getProperty("RegionalSettings", new RegionalSettings($this->getContext(), new ResourcePath("RegionalSettings", $this->getResourcePath())));
    }
    /**
     * @return ThemeInfo
     */
    public function getThemeInfo()
    {
        return $this->getProperty("ThemeInfo", new ThemeInfo($this->getContext(), new ResourcePath("ThemeInfo", $this->getResourcePath())));
    }
    /**
     * Specifies 
     * the user 
     * information list for the site collection that 
     * contains the site (2).
     * @return SPList
     */
    public function getSiteUserInfoList()
    {
        return $this->getProperty("SiteUserInfoList", new SPList($this->getContext(), new ResourcePath("SiteUserInfoList", $this->getResourcePath())));
    }
    /**
     * Accessibility: Read OnlySpecifies 
     * the language 
     * code identifiers (LCIDs) of the languages that are enabled for the site (2).
     * @return array
     */
    public function getSupportedUILanguageIds()
    {
        return $this->getProperty("SupportedUILanguageIds");
    }
    /**
     * @return string
     */
    public function getDefaultNewPageTemplateId()
    {
        return $this->getProperty("DefaultNewPageTemplateId");
    }
    /**
     * @var string
     */
    public function setDefaultNewPageTemplateId($value)
    {
        $this->setProperty("DefaultNewPageTemplateId", $value, true);
    }
    /**
     * @return bool
     */
    public function getHideTitleInHeader()
    {
        return $this->getProperty("HideTitleInHeader");
    }
    /**
     * @var bool
     */
    public function setHideTitleInHeader($value)
    {
        $this->setProperty("HideTitleInHeader", $value, true);
    }
    /**
     * @return bool
     */
    public function getNextStepsFirstRunEnabled()
    {
        return $this->getProperty("NextStepsFirstRunEnabled");
    }
    /**
     * @var bool
     */
    public function setNextStepsFirstRunEnabled($value)
    {
        $this->setProperty("NextStepsFirstRunEnabled", $value, true);
    }
    /**
     * @return ModernizeHomepageResult
     */
    public function getCanModernizeHomepage()
    {
        return $this->getProperty("CanModernizeHomepage", new ModernizeHomepageResult($this->getContext(), new ResourcePath("CanModernizeHomepage", $this->getResourcePath())));
    }
    /**
     * @return integer
     */
    public function getLogoAlignment()
    {
        return $this->getProperty("LogoAlignment");
    }
    /**
     * @var integer
     */
    public function setLogoAlignment($value)
    {
        $this->setProperty("LogoAlignment", $value, true);
    }
    /**
     * @return string
     */
    public function getWebTemplateConfiguration()
    {
        return $this->getProperty("WebTemplateConfiguration");
    }
    /**
     * @var string
     */
    public function setWebTemplateConfiguration($value)
    {
        $this->setProperty("WebTemplateConfiguration", $value, true);
    }
    /**
     * @return bool
     */
    public function getWebTemplatesGalleryFirstRunEnabled()
    {
        return $this->getProperty("WebTemplatesGalleryFirstRunEnabled");
    }
    /**
     * @var bool
     */
    public function setWebTemplatesGalleryFirstRunEnabled($value)
    {
        $this->setProperty("WebTemplatesGalleryFirstRunEnabled", $value, true);
    }
    /**
     * @return SPList
     */
    public function getAccessRequestsList()
    {
        return $this->getProperty("AccessRequestsList", new SPList($this->getContext(), new ResourcePath("AccessRequestsList", $this->getResourcePath())));
    }
    /**
     * @param string $url
     * @return SPList
     */
    public function getList($url)
    {
        $qry = new InvokePostMethodQuery($this, "GetList", array(rawurlencode($url)), null, null);
        $list = new SPList($this->getContext());
        $this->getLists()->addChild($list);
        $this->getContext()->addQueryAndResultObject($qry, $list);
        return $list;
    }
    /**
     * The full
     * path pointing to the web. It can be
     * "http://www.office.net:8080/foo/bar" or
     * "http://www.office.net/foo/bar" It will not be
     * "http://www.office.net:8080/site/web/dir1/dir2/a.aspx"
     * @return Web
     * @var SPResourcePath
     */
    public function setResourcePath($value)
    {
        return $this->setProperty("ResourcePath", $value, true);
    }
    /**
     * Gets the 
     * server-relative path of the web site.
     * @return SPResourcePath
     */
    public function getServerRelativePath()
    {
        return $this->getProperty("ServerRelativePath", new SPResourcePath());
    }
    /**
     * Gets the
     * server-relative path of the web site.
     * @return Web
     * @var SPResourcePath
     */
    public function setServerRelativePath($value)
    {
        return $this->setProperty("ServerRelativePath", $value, true);
    }
    /**
     * @return string
     */
    public function getResourceUrl()
    {
        $url = parent::getResourceUrl();
        if (!is_null($this->webUrl)) {
            $urlInfo = parse_url($this->getContext()->getBaseUrl());
            $rootSiteUrl = $urlInfo['scheme'] . '://' . $urlInfo['host'];
            $webPath = str_replace($rootSiteUrl, "", $this->getContext()->getBaseUrl());
            return str_replace("{$webPath}/_api", "{$this->webUrl}/_api", $url);
        }
        return $url;
    }
    /**
     * @return bool
     */
    public function getHasWebTemplateExtension()
    {
        return $this->getProperty("HasWebTemplateExtension");
    }
    /**
     * @var bool
     */
    public function setHasWebTemplateExtension($value)
    {
        $this->setProperty("HasWebTemplateExtension", $value, true);
    }
    /**
     * @return bool
     */
    public function getKeepFieldUserResources()
    {
        return $this->getProperty("KeepFieldUserResources");
    }
    /**
     *
     * @return Web
     * @var bool
     */
    public function setKeepFieldUserResources($value)
    {
        return $this->setProperty("KeepFieldUserResources", $value, true);
    }
    /**
     * @return string
     */
    public function getAcronym()
    {
        return $this->getProperty("Acronym");
    }
    /**
     * @var string
     */
    public function setAcronym($value)
    {
        return $this->setProperty("Acronym", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsEduClass()
    {
        return $this->getProperty("IsEduClass");
    }
    /**
     * @var bool
     */
    public function setIsEduClass($value)
    {
        return $this->setProperty("IsEduClass", $value, true);
    }
    /**
     * @return string
     */
    public function getDescriptionForExistingLanguage()
    {
        return $this->getProperty("DescriptionForExistingLanguage");
    }
    /**
     * @var string
     */
    public function setDescriptionForExistingLanguage($value)
    {
        return $this->setProperty("DescriptionForExistingLanguage", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsEduClassProvisionChecked()
    {
        return $this->getProperty("IsEduClassProvisionChecked");
    }
    /**
     * @var bool
     */
    public function setIsEduClassProvisionChecked($value)
    {
        return $this->setProperty("IsEduClassProvisionChecked", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsEduClassProvisionPending()
    {
        return $this->getProperty("IsEduClassProvisionPending");
    }
    /**
     * @var bool
     */
    public function setIsEduClassProvisionPending($value)
    {
        return $this->setProperty("IsEduClassProvisionPending", $value, true);
    }
    /**
     * @return string
     */
    public function getTitleForExistingLanguage()
    {
        return $this->getProperty("TitleForExistingLanguage");
    }
    /**
     * @var string
     */
    public function setTitleForExistingLanguage($value)
    {
        return $this->setProperty("TitleForExistingLanguage", $value, true);
    }
    /**
     * @return string
     */
    public function getRelatedHubSiteIds()
    {
        return $this->getProperty("RelatedHubSiteIds");
    }
    /**
     * @var string
     */
    public function setRelatedHubSiteIds($value)
    {
        return $this->setProperty("RelatedHubSiteIds", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterAlignment()
    {
        return $this->getProperty("FooterAlignment");
    }
    /**
     * @var integer
     */
    public function setFooterAlignment($value)
    {
        return $this->setProperty("FooterAlignment", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterBlur()
    {
        return $this->getProperty("FooterBlur");
    }
    /**
     * @var integer
     */
    public function setFooterBlur($value)
    {
        return $this->setProperty("FooterBlur", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterColorIndexInDarkMode()
    {
        return $this->getProperty("FooterColorIndexInDarkMode");
    }
    /**
     * @var integer
     */
    public function setFooterColorIndexInDarkMode($value)
    {
        return $this->setProperty("FooterColorIndexInDarkMode", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterColorIndexInLightMode()
    {
        return $this->getProperty("FooterColorIndexInLightMode");
    }
    /**
     * @var integer
     */
    public function setFooterColorIndexInLightMode($value)
    {
        return $this->setProperty("FooterColorIndexInLightMode", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterOverlayColor()
    {
        return $this->getProperty("FooterOverlayColor");
    }
    /**
     * @var integer
     */
    public function setFooterOverlayColor($value)
    {
        return $this->setProperty("FooterOverlayColor", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterOverlayGradientDirection()
    {
        return $this->getProperty("FooterOverlayGradientDirection");
    }
    /**
     * @var integer
     */
    public function setFooterOverlayGradientDirection($value)
    {
        return $this->setProperty("FooterOverlayGradientDirection", $value, true);
    }
    /**
     * @return integer
     */
    public function getFooterOverlayOpacity()
    {
        return $this->getProperty("FooterOverlayOpacity");
    }
    /**
     * @var integer
     */
    public function setFooterOverlayOpacity($value)
    {
        return $this->setProperty("FooterOverlayOpacity", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderColorIndexInDarkMode()
    {
        return $this->getProperty("HeaderColorIndexInDarkMode");
    }
    /**
     * @var integer
     */
    public function setHeaderColorIndexInDarkMode($value)
    {
        return $this->setProperty("HeaderColorIndexInDarkMode", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderColorIndexInLightMode()
    {
        return $this->getProperty("HeaderColorIndexInLightMode");
    }
    /**
     * @var integer
     */
    public function setHeaderColorIndexInLightMode($value)
    {
        return $this->setProperty("HeaderColorIndexInLightMode", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderOverlayColor()
    {
        return $this->getProperty("HeaderOverlayColor");
    }
    /**
     * @var integer
     */
    public function setHeaderOverlayColor($value)
    {
        return $this->setProperty("HeaderOverlayColor", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderOverlayGradientDirection()
    {
        return $this->getProperty("HeaderOverlayGradientDirection");
    }
    /**
     * @var integer
     */
    public function setHeaderOverlayGradientDirection($value)
    {
        return $this->setProperty("HeaderOverlayGradientDirection", $value, true);
    }
    /**
     * @return integer
     */
    public function getHeaderOverlayOpacity()
    {
        return $this->getProperty("HeaderOverlayOpacity");
    }
    /**
     * @var integer
     */
    public function setHeaderOverlayOpacity($value)
    {
        return $this->setProperty("HeaderOverlayOpacity", $value, true);
    }
    /**
     * @return string
     */
    public function getThemeApplicationActionHistory()
    {
        return $this->getProperty("ThemeApplicationActionHistory");
    }
    /**
     * @var string
     */
    public function setThemeApplicationActionHistory($value)
    {
        return $this->setProperty("ThemeApplicationActionHistory", $value, true);
    }
}