<?php

/**
 * Updated By PHP Office365 Generator 2019-11-17T16:34:18+00:00 16.0.19506.12022
 */
namespace Office365\PHP\Client\SharePoint;

use Office365\PHP\Client\Runtime\CreateEntityQuery;
use Office365\PHP\Client\Runtime\DeleteEntityQuery;
use Office365\PHP\Client\Runtime\InvokeMethodQuery;
use Office365\PHP\Client\Runtime\InvokePostMethodQuery;
use Office365\PHP\Client\Runtime\ResourcePathServiceOperation;
use Office365\PHP\Client\Runtime\UpdateEntityQuery;
use Office365\PHP\Client\Runtime\ResourcePathEntity;

class SPList extends SecurableObject
{
    /**
     * The recommended way to add a list item is to send a POST request to the ListItemCollection resource endpoint, as shown in ListItemCollection request examples.
     * @param array $listItemCreationInformation Creation information for a List item
     * @return ListItem List Item resource
     */
    public function addItem(array $listItemCreationInformation)
    {
        $items = new ListItemCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "items"));
        $listItem = new ListItem($this->getContext());
        $listItem->parentCollection = $items;
        $listItem->setProperty('ParentList', $this, false);
        foreach ($listItemCreationInformation as $key => $value) {
            $listItem->setProperty($key, $value);
        }
        $qry = new CreateEntityQuery($listItem);
        $this->getContext()->addQuery($qry, $listItem);
        return $listItem;
    }
    /**
     * Returns the list item with the specified list item identifier.
     * @param integer $id  SPList Item id
     * @return ListItem  List Item resource
     */
    public function getItemById($id)
    {
        return new ListItem($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "items({$id})"));
    }
    /**
     * Returns a collection of items from the list based on the specified query.
     * @param CamlQuery $camlQuery
     * @return ListItemCollection
     */
    public function getItems(CamlQuery $camlQuery = null)
    {
        if (isset($camlQuery)) {
            $path = new ResourcePathServiceOperation($this->getContext(), $this->getResourcePath(), "GetItems", $camlQuery);
            return new ListItemCollection($this->getContext(), $path);
        }
        return new ListItemCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "items"));
    }
    /**
     * Updates a list resource
     */
    public function update()
    {
        $qry = new UpdateEntityQuery($this);
        $this->getContext()->addQuery($qry);
    }
    /**
     * The recommended way to delete a list is to send a DELETE request to the List resource endpoint, as shown in List request examples.
     */
    public function deleteObject()
    {
        $qry = new DeleteEntityQuery($this);
        $this->getContext()->addQuery($qry);
        $this->removeFromParentCollection();
    }
    /**
     * Gets the set of permissions for the specified user
     * @param string $loginName
     * @return BasePermissions
     */
    public function getUserEffectivePermissions($loginName)
    {
        $permissions = new BasePermissions();
        $qry = new InvokeMethodQuery($this->getResourcePath(), "GetUserEffectivePermissions", array(rawurlencode($loginName)));
        $this->getContext()->addQuery($qry, $permissions);
        return $permissions;
    }
    /**
     * @param ChangeLogItemQuery $query The query that contains the change token. Pass this parameter in the request body, as shown in the request example.
     * @return ListItemCollection
     */
    public function getListItemChangesSinceToken(ChangeLogItemQuery $query)
    {
        $result = new ListItemCollection($this->getContext(), null);
        $qry = new InvokePostMethodQuery($this->getResourcePath(), "getListItemChangesSinceToken", null, $query);
        $this->getContext()->addQuery($qry, $result);
        return $result;
    }
    /**
     * @param ChangeQuery $query
     * @return ChangeCollection
     */
    public function getChanges(ChangeQuery $query)
    {
        $qry = new InvokePostMethodQuery($this->getResourcePath(), "GetChanges", null, $query);
        $changes = new ChangeCollection($this->getContext(), $qry->getResourcePath());
        $this->getContext()->addQuery($qry, $changes);
        return $changes;
    }
    /**
     * @return ContentTypeCollection
     */
    public function getContentTypes()
    {
        if (!$this->isPropertyAvailable('ContentTypes')) {
            $this->setProperty("ContentTypes", new ContentTypeCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "ContentTypes")), false);
        }
        return $this->getProperty("ContentTypes");
    }
    /**
     * @return FieldCollection
     */
    public function getFields()
    {
        if (!$this->isPropertyAvailable('Fields')) {
            $this->setProperty("Fields", new FieldCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "fields")));
        }
        return $this->getProperty("Fields");
    }
    /**
     * @return Folder
     */
    public function getRootFolder()
    {
        if (!$this->isPropertyAvailable('RootFolder')) {
            $this->setProperty("RootFolder", new Folder($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "rootFolder")));
        }
        return $this->getProperty("RootFolder");
    }
    /**
     * @return ViewCollection
     */
    public function getViews()
    {
        if (!$this->isPropertyAvailable('Views')) {
            $this->setProperty("Views", new ViewCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "views")));
        }
        return $this->getProperty("Views");
    }
    public function getInformationRightsManagementSettings()
    {
        if (!$this->isPropertyAvailable('InformationRightsManagementSettings')) {
            $this->setProperty("InformationRightsManagementSettings", new InformationRightsManagementSettings());
        }
        return $this->getProperty("InformationRightsManagementSettings");
    }
    /**
     * @return Web
     */
    public function getParentWeb()
    {
        if (!$this->isPropertyAvailable('ParentWeb')) {
            $this->setProperty("ParentWeb", new Web($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "ParentWeb")));
        }
        return $this->getProperty("ParentWeb");
    }
    public function getTypeName()
    {
        return "SP.List";
    }
    /**
     * @return bool
     */
    public function getAllowContentTypes()
    {
        if (!$this->isPropertyAvailable("AllowContentTypes")) {
            return null;
        }
        return $this->getProperty("AllowContentTypes");
    }
    /**
     * @var bool
     */
    public function setAllowContentTypes($value)
    {
        $this->setProperty("AllowContentTypes", $value, true);
    }
    /**
     * @return bool
     */
    public function getAllowDeletion()
    {
        if (!$this->isPropertyAvailable("AllowDeletion")) {
            return null;
        }
        return $this->getProperty("AllowDeletion");
    }
    /**
     * @var bool
     */
    public function setAllowDeletion($value)
    {
        $this->setProperty("AllowDeletion", $value, true);
    }
    /**
     * @return integer
     */
    public function getBaseTemplate()
    {
        if (!$this->isPropertyAvailable("BaseTemplate")) {
            return null;
        }
        return $this->getProperty("BaseTemplate");
    }
    /**
     * @var integer
     */
    public function setBaseTemplate($value)
    {
        $this->setProperty("BaseTemplate", $value, true);
    }
    /**
     * @return integer
     */
    public function getBaseType()
    {
        if (!$this->isPropertyAvailable("BaseType")) {
            return null;
        }
        return $this->getProperty("BaseType");
    }
    /**
     * @var integer
     */
    public function setBaseType($value)
    {
        $this->setProperty("BaseType", $value, true);
    }
    /**
     * @return integer
     */
    public function getBrowserFileHandling()
    {
        if (!$this->isPropertyAvailable("BrowserFileHandling")) {
            return null;
        }
        return $this->getProperty("BrowserFileHandling");
    }
    /**
     * @var integer
     */
    public function setBrowserFileHandling($value)
    {
        $this->setProperty("BrowserFileHandling", $value, true);
    }
    /**
     * @return bool
     */
    public function getContentTypesEnabled()
    {
        if (!$this->isPropertyAvailable("ContentTypesEnabled")) {
            return null;
        }
        return $this->getProperty("ContentTypesEnabled");
    }
    /**
     * @var bool
     */
    public function setContentTypesEnabled($value)
    {
        $this->setProperty("ContentTypesEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getCrawlNonDefaultViews()
    {
        if (!$this->isPropertyAvailable("CrawlNonDefaultViews")) {
            return null;
        }
        return $this->getProperty("CrawlNonDefaultViews");
    }
    /**
     * @var bool
     */
    public function setCrawlNonDefaultViews($value)
    {
        $this->setProperty("CrawlNonDefaultViews", $value, true);
    }
    /**
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
     * @var string
     */
    public function setCreated($value)
    {
        $this->setProperty("Created", $value, true);
    }
    /**
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
     * @var ChangeToken
     */
    public function setCurrentChangeToken($value)
    {
        $this->setProperty("CurrentChangeToken", $value, true);
    }
    /**
     * @return CustomActionElementCollection
     */
    public function getCustomActionElements()
    {
        if (!$this->isPropertyAvailable("CustomActionElements")) {
            return null;
        }
        return $this->getProperty("CustomActionElements");
    }
    /**
     * @var CustomActionElementCollection
     */
    public function setCustomActionElements($value)
    {
        $this->setProperty("CustomActionElements", $value, true);
    }
    /**
     * @return ListDataSource
     */
    public function getDataSource()
    {
        if (!$this->isPropertyAvailable("DataSource")) {
            return null;
        }
        return $this->getProperty("DataSource");
    }
    /**
     * @var ListDataSource
     */
    public function setDataSource($value)
    {
        $this->setProperty("DataSource", $value, true);
    }
    /**
     * @return string
     */
    public function getDefaultContentApprovalWorkflowId()
    {
        if (!$this->isPropertyAvailable("DefaultContentApprovalWorkflowId")) {
            return null;
        }
        return $this->getProperty("DefaultContentApprovalWorkflowId");
    }
    /**
     * @var string
     */
    public function setDefaultContentApprovalWorkflowId($value)
    {
        $this->setProperty("DefaultContentApprovalWorkflowId", $value, true);
    }
    /**
     * @return string
     */
    public function getDefaultDisplayFormUrl()
    {
        if (!$this->isPropertyAvailable("DefaultDisplayFormUrl")) {
            return null;
        }
        return $this->getProperty("DefaultDisplayFormUrl");
    }
    /**
     * @var string
     */
    public function setDefaultDisplayFormUrl($value)
    {
        $this->setProperty("DefaultDisplayFormUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getDefaultEditFormUrl()
    {
        if (!$this->isPropertyAvailable("DefaultEditFormUrl")) {
            return null;
        }
        return $this->getProperty("DefaultEditFormUrl");
    }
    /**
     * @var string
     */
    public function setDefaultEditFormUrl($value)
    {
        $this->setProperty("DefaultEditFormUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getDefaultItemOpenUseListSetting()
    {
        if (!$this->isPropertyAvailable("DefaultItemOpenUseListSetting")) {
            return null;
        }
        return $this->getProperty("DefaultItemOpenUseListSetting");
    }
    /**
     * @var bool
     */
    public function setDefaultItemOpenUseListSetting($value)
    {
        $this->setProperty("DefaultItemOpenUseListSetting", $value, true);
    }
    /**
     * @return string
     */
    public function getDefaultNewFormUrl()
    {
        if (!$this->isPropertyAvailable("DefaultNewFormUrl")) {
            return null;
        }
        return $this->getProperty("DefaultNewFormUrl");
    }
    /**
     * @var string
     */
    public function setDefaultNewFormUrl($value)
    {
        $this->setProperty("DefaultNewFormUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getDefaultViewUrl()
    {
        if (!$this->isPropertyAvailable("DefaultViewUrl")) {
            return null;
        }
        return $this->getProperty("DefaultViewUrl");
    }
    /**
     * @var string
     */
    public function setDefaultViewUrl($value)
    {
        $this->setProperty("DefaultViewUrl", $value, true);
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        if (!$this->isPropertyAvailable("Description")) {
            return null;
        }
        return $this->getProperty("Description");
    }
    /**
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     * @return string
     */
    public function getDirection()
    {
        if (!$this->isPropertyAvailable("Direction")) {
            return null;
        }
        return $this->getProperty("Direction");
    }
    /**
     * @var string
     */
    public function setDirection($value)
    {
        $this->setProperty("Direction", $value, true);
    }
    /**
     * @return bool
     */
    public function getDisableGridEditing()
    {
        if (!$this->isPropertyAvailable("DisableGridEditing")) {
            return null;
        }
        return $this->getProperty("DisableGridEditing");
    }
    /**
     * @var bool
     */
    public function setDisableGridEditing($value)
    {
        $this->setProperty("DisableGridEditing", $value, true);
    }
    /**
     * @return string
     */
    public function getDocumentTemplateUrl()
    {
        if (!$this->isPropertyAvailable("DocumentTemplateUrl")) {
            return null;
        }
        return $this->getProperty("DocumentTemplateUrl");
    }
    /**
     * @var string
     */
    public function setDocumentTemplateUrl($value)
    {
        $this->setProperty("DocumentTemplateUrl", $value, true);
    }
    /**
     * @return integer
     */
    public function getDraftVersionVisibility()
    {
        if (!$this->isPropertyAvailable("DraftVersionVisibility")) {
            return null;
        }
        return $this->getProperty("DraftVersionVisibility");
    }
    /**
     * @var integer
     */
    public function setDraftVersionVisibility($value)
    {
        $this->setProperty("DraftVersionVisibility", $value, true);
    }
    /**
     * @return BasePermissions
     */
    public function getEffectiveBasePermissions()
    {
        if (!$this->isPropertyAvailable("EffectiveBasePermissions")) {
            return null;
        }
        return $this->getProperty("EffectiveBasePermissions");
    }
    /**
     * @var BasePermissions
     */
    public function setEffectiveBasePermissions($value)
    {
        $this->setProperty("EffectiveBasePermissions", $value, true);
    }
    /**
     * @return BasePermissions
     */
    public function getEffectiveBasePermissionsForUI()
    {
        if (!$this->isPropertyAvailable("EffectiveBasePermissionsForUI")) {
            return null;
        }
        return $this->getProperty("EffectiveBasePermissionsForUI");
    }
    /**
     * @var BasePermissions
     */
    public function setEffectiveBasePermissionsForUI($value)
    {
        $this->setProperty("EffectiveBasePermissionsForUI", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnableAssignToEmail()
    {
        if (!$this->isPropertyAvailable("EnableAssignToEmail")) {
            return null;
        }
        return $this->getProperty("EnableAssignToEmail");
    }
    /**
     * @var bool
     */
    public function setEnableAssignToEmail($value)
    {
        $this->setProperty("EnableAssignToEmail", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnableAttachments()
    {
        if (!$this->isPropertyAvailable("EnableAttachments")) {
            return null;
        }
        return $this->getProperty("EnableAttachments");
    }
    /**
     * @var bool
     */
    public function setEnableAttachments($value)
    {
        $this->setProperty("EnableAttachments", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnableFolderCreation()
    {
        if (!$this->isPropertyAvailable("EnableFolderCreation")) {
            return null;
        }
        return $this->getProperty("EnableFolderCreation");
    }
    /**
     * @var bool
     */
    public function setEnableFolderCreation($value)
    {
        $this->setProperty("EnableFolderCreation", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnableMinorVersions()
    {
        if (!$this->isPropertyAvailable("EnableMinorVersions")) {
            return null;
        }
        return $this->getProperty("EnableMinorVersions");
    }
    /**
     * @var bool
     */
    public function setEnableMinorVersions($value)
    {
        $this->setProperty("EnableMinorVersions", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnableModeration()
    {
        if (!$this->isPropertyAvailable("EnableModeration")) {
            return null;
        }
        return $this->getProperty("EnableModeration");
    }
    /**
     * @var bool
     */
    public function setEnableModeration($value)
    {
        $this->setProperty("EnableModeration", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnableRequestSignOff()
    {
        if (!$this->isPropertyAvailable("EnableRequestSignOff")) {
            return null;
        }
        return $this->getProperty("EnableRequestSignOff");
    }
    /**
     * @var bool
     */
    public function setEnableRequestSignOff($value)
    {
        $this->setProperty("EnableRequestSignOff", $value, true);
    }
    /**
     * @return bool
     */
    public function getEnableVersioning()
    {
        if (!$this->isPropertyAvailable("EnableVersioning")) {
            return null;
        }
        return $this->getProperty("EnableVersioning");
    }
    /**
     * @var bool
     */
    public function setEnableVersioning($value)
    {
        $this->setProperty("EnableVersioning", $value, true);
    }
    /**
     * @return string
     */
    public function getEntityTypeName()
    {
        if (!$this->isPropertyAvailable("EntityTypeName")) {
            return null;
        }
        return $this->getProperty("EntityTypeName");
    }
    /**
     * @var string
     */
    public function setEntityTypeName($value)
    {
        $this->setProperty("EntityTypeName", $value, true);
    }
    /**
     * @return bool
     */
    public function getExcludeFromOfflineClient()
    {
        if (!$this->isPropertyAvailable("ExcludeFromOfflineClient")) {
            return null;
        }
        return $this->getProperty("ExcludeFromOfflineClient");
    }
    /**
     * @var bool
     */
    public function setExcludeFromOfflineClient($value)
    {
        $this->setProperty("ExcludeFromOfflineClient", $value, true);
    }
    /**
     * @return bool
     */
    public function getExemptFromBlockDownloadOfNonViewableFiles()
    {
        if (!$this->isPropertyAvailable("ExemptFromBlockDownloadOfNonViewableFiles")) {
            return null;
        }
        return $this->getProperty("ExemptFromBlockDownloadOfNonViewableFiles");
    }
    /**
     * @var bool
     */
    public function setExemptFromBlockDownloadOfNonViewableFiles($value)
    {
        $this->setProperty("ExemptFromBlockDownloadOfNonViewableFiles", $value, true);
    }
    /**
     * @return bool
     */
    public function getFileSavePostProcessingEnabled()
    {
        if (!$this->isPropertyAvailable("FileSavePostProcessingEnabled")) {
            return null;
        }
        return $this->getProperty("FileSavePostProcessingEnabled");
    }
    /**
     * @var bool
     */
    public function setFileSavePostProcessingEnabled($value)
    {
        $this->setProperty("FileSavePostProcessingEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getForceCheckout()
    {
        if (!$this->isPropertyAvailable("ForceCheckout")) {
            return null;
        }
        return $this->getProperty("ForceCheckout");
    }
    /**
     * @var bool
     */
    public function setForceCheckout($value)
    {
        $this->setProperty("ForceCheckout", $value, true);
    }
    /**
     * @return bool
     */
    public function getHasExternalDataSource()
    {
        if (!$this->isPropertyAvailable("HasExternalDataSource")) {
            return null;
        }
        return $this->getProperty("HasExternalDataSource");
    }
    /**
     * @var bool
     */
    public function setHasExternalDataSource($value)
    {
        $this->setProperty("HasExternalDataSource", $value, true);
    }
    /**
     * @return bool
     */
    public function getHidden()
    {
        if (!$this->isPropertyAvailable("Hidden")) {
            return null;
        }
        return $this->getProperty("Hidden");
    }
    /**
     * @var bool
     */
    public function setHidden($value)
    {
        $this->setProperty("Hidden", $value, true);
    }
    /**
     * @return string
     */
    public function getId()
    {
        if (!$this->isPropertyAvailable("Id")) {
            return null;
        }
        return $this->getProperty("Id");
    }
    /**
     * @var string
     */
    public function setId($value)
    {
        $this->setProperty("Id", $value, true);
    }
    /**
     * @return string
     */
    public function getImageUrl()
    {
        if (!$this->isPropertyAvailable("ImageUrl")) {
            return null;
        }
        return $this->getProperty("ImageUrl");
    }
    /**
     * @var string
     */
    public function setImageUrl($value)
    {
        $this->setProperty("ImageUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getIrmEnabled()
    {
        if (!$this->isPropertyAvailable("IrmEnabled")) {
            return null;
        }
        return $this->getProperty("IrmEnabled");
    }
    /**
     * @var bool
     */
    public function setIrmEnabled($value)
    {
        $this->setProperty("IrmEnabled", $value, true);
    }
    /**
     * @return bool
     */
    public function getIrmExpire()
    {
        if (!$this->isPropertyAvailable("IrmExpire")) {
            return null;
        }
        return $this->getProperty("IrmExpire");
    }
    /**
     * @var bool
     */
    public function setIrmExpire($value)
    {
        $this->setProperty("IrmExpire", $value, true);
    }
    /**
     * @return bool
     */
    public function getIrmReject()
    {
        if (!$this->isPropertyAvailable("IrmReject")) {
            return null;
        }
        return $this->getProperty("IrmReject");
    }
    /**
     * @var bool
     */
    public function setIrmReject($value)
    {
        $this->setProperty("IrmReject", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsApplicationList()
    {
        if (!$this->isPropertyAvailable("IsApplicationList")) {
            return null;
        }
        return $this->getProperty("IsApplicationList");
    }
    /**
     * @var bool
     */
    public function setIsApplicationList($value)
    {
        $this->setProperty("IsApplicationList", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsCatalog()
    {
        if (!$this->isPropertyAvailable("IsCatalog")) {
            return null;
        }
        return $this->getProperty("IsCatalog");
    }
    /**
     * @var bool
     */
    public function setIsCatalog($value)
    {
        $this->setProperty("IsCatalog", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsEnterpriseGalleryLibrary()
    {
        if (!$this->isPropertyAvailable("IsEnterpriseGalleryLibrary")) {
            return null;
        }
        return $this->getProperty("IsEnterpriseGalleryLibrary");
    }
    /**
     * @var bool
     */
    public function setIsEnterpriseGalleryLibrary($value)
    {
        $this->setProperty("IsEnterpriseGalleryLibrary", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsPrivate()
    {
        if (!$this->isPropertyAvailable("IsPrivate")) {
            return null;
        }
        return $this->getProperty("IsPrivate");
    }
    /**
     * @var bool
     */
    public function setIsPrivate($value)
    {
        $this->setProperty("IsPrivate", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsSiteAssetsLibrary()
    {
        if (!$this->isPropertyAvailable("IsSiteAssetsLibrary")) {
            return null;
        }
        return $this->getProperty("IsSiteAssetsLibrary");
    }
    /**
     * @var bool
     */
    public function setIsSiteAssetsLibrary($value)
    {
        $this->setProperty("IsSiteAssetsLibrary", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsSystemList()
    {
        if (!$this->isPropertyAvailable("IsSystemList")) {
            return null;
        }
        return $this->getProperty("IsSystemList");
    }
    /**
     * @var bool
     */
    public function setIsSystemList($value)
    {
        $this->setProperty("IsSystemList", $value, true);
    }
    /**
     * @return integer
     */
    public function getItemCount()
    {
        if (!$this->isPropertyAvailable("ItemCount")) {
            return null;
        }
        return $this->getProperty("ItemCount");
    }
    /**
     * @var integer
     */
    public function setItemCount($value)
    {
        $this->setProperty("ItemCount", $value, true);
    }
    /**
     * @return string
     */
    public function getLastItemDeletedDate()
    {
        if (!$this->isPropertyAvailable("LastItemDeletedDate")) {
            return null;
        }
        return $this->getProperty("LastItemDeletedDate");
    }
    /**
     * @var string
     */
    public function setLastItemDeletedDate($value)
    {
        $this->setProperty("LastItemDeletedDate", $value, true);
    }
    /**
     * @return string
     */
    public function getLastItemModifiedDate()
    {
        if (!$this->isPropertyAvailable("LastItemModifiedDate")) {
            return null;
        }
        return $this->getProperty("LastItemModifiedDate");
    }
    /**
     * @var string
     */
    public function setLastItemModifiedDate($value)
    {
        $this->setProperty("LastItemModifiedDate", $value, true);
    }
    /**
     * @return string
     */
    public function getLastItemUserModifiedDate()
    {
        if (!$this->isPropertyAvailable("LastItemUserModifiedDate")) {
            return null;
        }
        return $this->getProperty("LastItemUserModifiedDate");
    }
    /**
     * @var string
     */
    public function setLastItemUserModifiedDate($value)
    {
        $this->setProperty("LastItemUserModifiedDate", $value, true);
    }
    /**
     * @return integer
     */
    public function getListExperienceOptions()
    {
        if (!$this->isPropertyAvailable("ListExperienceOptions")) {
            return null;
        }
        return $this->getProperty("ListExperienceOptions");
    }
    /**
     * @var integer
     */
    public function setListExperienceOptions($value)
    {
        $this->setProperty("ListExperienceOptions", $value, true);
    }
    /**
     * @return string
     */
    public function getListItemEntityTypeFullName()
    {
        if (!$this->isPropertyAvailable("ListItemEntityTypeFullName")) {
            return null;
        }
        return $this->getProperty("ListItemEntityTypeFullName");
    }
    /**
     * @var string
     */
    public function setListItemEntityTypeFullName($value)
    {
        $this->setProperty("ListItemEntityTypeFullName", $value, true);
    }
    /**
     * @return integer
     */
    public function getMajorVersionLimit()
    {
        if (!$this->isPropertyAvailable("MajorVersionLimit")) {
            return null;
        }
        return $this->getProperty("MajorVersionLimit");
    }
    /**
     * @var integer
     */
    public function setMajorVersionLimit($value)
    {
        $this->setProperty("MajorVersionLimit", $value, true);
    }
    /**
     * @return integer
     */
    public function getMajorWithMinorVersionsLimit()
    {
        if (!$this->isPropertyAvailable("MajorWithMinorVersionsLimit")) {
            return null;
        }
        return $this->getProperty("MajorWithMinorVersionsLimit");
    }
    /**
     * @var integer
     */
    public function setMajorWithMinorVersionsLimit($value)
    {
        $this->setProperty("MajorWithMinorVersionsLimit", $value, true);
    }
    /**
     * @return bool
     */
    public function getMultipleDataList()
    {
        if (!$this->isPropertyAvailable("MultipleDataList")) {
            return null;
        }
        return $this->getProperty("MultipleDataList");
    }
    /**
     * @var bool
     */
    public function setMultipleDataList($value)
    {
        $this->setProperty("MultipleDataList", $value, true);
    }
    /**
     * @return bool
     */
    public function getNoCrawl()
    {
        if (!$this->isPropertyAvailable("NoCrawl")) {
            return null;
        }
        return $this->getProperty("NoCrawl");
    }
    /**
     * @var bool
     */
    public function setNoCrawl($value)
    {
        $this->setProperty("NoCrawl", $value, true);
    }
    /**
     * @return bool
     */
    public function getOnQuickLaunch()
    {
        if (!$this->isPropertyAvailable("OnQuickLaunch")) {
            return null;
        }
        return $this->getProperty("OnQuickLaunch");
    }
    /**
     * @var bool
     */
    public function setOnQuickLaunch($value)
    {
        $this->setProperty("OnQuickLaunch", $value, true);
    }
    /**
     * @return integer
     */
    public function getPageRenderType()
    {
        if (!$this->isPropertyAvailable("PageRenderType")) {
            return null;
        }
        return $this->getProperty("PageRenderType");
    }
    /**
     * @var integer
     */
    public function setPageRenderType($value)
    {
        $this->setProperty("PageRenderType", $value, true);
    }
    /**
     * @return string
     */
    public function getParentWebUrl()
    {
        if (!$this->isPropertyAvailable("ParentWebUrl")) {
            return null;
        }
        return $this->getProperty("ParentWebUrl");
    }
    /**
     * @var string
     */
    public function setParentWebUrl($value)
    {
        $this->setProperty("ParentWebUrl", $value, true);
    }
    /**
     * @return bool
     */
    public function getParserDisabled()
    {
        if (!$this->isPropertyAvailable("ParserDisabled")) {
            return null;
        }
        return $this->getProperty("ParserDisabled");
    }
    /**
     * @var bool
     */
    public function setParserDisabled($value)
    {
        $this->setProperty("ParserDisabled", $value, true);
    }
    /**
     * @return integer
     */
    public function getReadSecurity()
    {
        if (!$this->isPropertyAvailable("ReadSecurity")) {
            return null;
        }
        return $this->getProperty("ReadSecurity");
    }
    /**
     * @var integer
     */
    public function setReadSecurity($value)
    {
        $this->setProperty("ReadSecurity", $value, true);
    }
    /**
     * @return string
     */
    public function getSchemaXml()
    {
        if (!$this->isPropertyAvailable("SchemaXml")) {
            return null;
        }
        return $this->getProperty("SchemaXml");
    }
    /**
     * @var string
     */
    public function setSchemaXml($value)
    {
        $this->setProperty("SchemaXml", $value, true);
    }
    /**
     * @return bool
     */
    public function getServerTemplateCanCreateFolders()
    {
        if (!$this->isPropertyAvailable("ServerTemplateCanCreateFolders")) {
            return null;
        }
        return $this->getProperty("ServerTemplateCanCreateFolders");
    }
    /**
     * @var bool
     */
    public function setServerTemplateCanCreateFolders($value)
    {
        $this->setProperty("ServerTemplateCanCreateFolders", $value, true);
    }
    /**
     * @return string
     */
    public function getTemplateFeatureId()
    {
        if (!$this->isPropertyAvailable("TemplateFeatureId")) {
            return null;
        }
        return $this->getProperty("TemplateFeatureId");
    }
    /**
     * @var string
     */
    public function setTemplateFeatureId($value)
    {
        $this->setProperty("TemplateFeatureId", $value, true);
    }
    /**
     * @return string
     */
    public function getTitle()
    {
        if (!$this->isPropertyAvailable("Title")) {
            return null;
        }
        return $this->getProperty("Title");
    }
    /**
     * @var string
     */
    public function setTitle($value)
    {
        $this->setProperty("Title", $value, true);
    }
    /**
     * @return string
     */
    public function getValidationFormula()
    {
        if (!$this->isPropertyAvailable("ValidationFormula")) {
            return null;
        }
        return $this->getProperty("ValidationFormula");
    }
    /**
     * @var string
     */
    public function setValidationFormula($value)
    {
        $this->setProperty("ValidationFormula", $value, true);
    }
    /**
     * @return string
     */
    public function getValidationMessage()
    {
        if (!$this->isPropertyAvailable("ValidationMessage")) {
            return null;
        }
        return $this->getProperty("ValidationMessage");
    }
    /**
     * @var string
     */
    public function setValidationMessage($value)
    {
        $this->setProperty("ValidationMessage", $value, true);
    }
    /**
     * @return integer
     */
    public function getWriteSecurity()
    {
        if (!$this->isPropertyAvailable("WriteSecurity")) {
            return null;
        }
        return $this->getProperty("WriteSecurity");
    }
    /**
     * @var integer
     */
    public function setWriteSecurity($value)
    {
        $this->setProperty("WriteSecurity", $value, true);
    }
    /**
     * @return CreatablesInfo
     */
    public function getCreatablesInfo()
    {
        if (!$this->isPropertyAvailable("CreatablesInfo")) {
            $this->setProperty("CreatablesInfo", new CreatablesInfo($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "CreatablesInfo")));
        }
        return $this->getProperty("CreatablesInfo");
    }
    /**
     * @return View
     */
    public function getDefaultView()
    {
        if (!$this->isPropertyAvailable("DefaultView")) {
            $this->setProperty("DefaultView", new View($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "DefaultView")));
        }
        return $this->getProperty("DefaultView");
    }
    /**
     * @return UserResource
     */
    public function getDescriptionResource()
    {
        if (!$this->isPropertyAvailable("DescriptionResource")) {
            $this->setProperty("DescriptionResource", new UserResource($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "DescriptionResource")));
        }
        return $this->getProperty("DescriptionResource");
    }
    /**
     * @return UserResource
     */
    public function getTitleResource()
    {
        if (!$this->isPropertyAvailable("TitleResource")) {
            $this->setProperty("TitleResource", new UserResource($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "TitleResource")));
        }
        return $this->getProperty("TitleResource");
    }
    /**
     * @return UserCustomActionCollection
     */
    public function getUserCustomActions()
    {
        if (!$this->isPropertyAvailable("UserCustomActions")) {
            $this->setProperty("UserCustomActions", new UserCustomActionCollection($this->getContext(), new ResourcePathEntity($this->getContext(), $this->getResourcePath(), "UserCustomActions")));
        }
        return $this->getProperty("UserCustomActions");
    }
}