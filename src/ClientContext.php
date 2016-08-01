<?php

namespace SharePoint\PHP\Client;

use SharePoint\PHP\Client\Runtime\ContextWebInformation;

require_once('runtime/ClientRuntimeContext.php');
require_once('SecurableObject.php');
require_once('File.php');
require_once('Folder.php');
require_once('Web.php');
require_once('Site.php');
require_once('FieldType.php');
require_once('CheckOutType.php');
require_once('Field.php');
require_once('FieldLookup.php');
require_once('FieldText.php');
require_once('taxonomy/TaxonomyField.php');
require_once('FieldNumber.php');
require_once('FieldDateTime.php');
require_once('FieldGuid.php');
require_once('FieldUser.php');
require_once('FieldComputed.php');
require_once('FieldMultiLineText.php');
require_once('FieldUrl.php');
require_once('FieldChoice.php');
require_once('FieldCalculated.php');
require_once('FieldMultiChoice.php');
require_once('FieldGeolocation.php');
require_once('PrincipalType.php');
require_once('Principal.php');
require_once('User.php');
require_once('Group.php');
require_once('RoleAssignment.php');
require_once('FieldCollection.php');
require_once('AddFieldOptions.php');
require_once('List.php');
require_once('ListCollection.php');
require_once('InformationRightsManagementSettings.php');
require_once('View.php');
require_once('ViewCollection.php');
require_once('ViewFieldCollection.php');
require_once('Attachment.php');
require_once('AttachmentCollection.php');
require_once('ListItem.php');
require_once('ListItemCollection.php');
require_once('WebCollection.php');
require_once('FileCollection.php');
require_once('FolderCollection.php');
require_once('UserCollection.php');
require_once('GroupCollection.php');
require_once('RoleAssignmentCollection.php');
require_once('RoleDefinition.php');
require_once('RoleDefinitionCollection.php');
require_once('UserCustomAction.php');
require_once('UserCustomActionCollection.php');
require_once('RecycleBinItem.php');
require_once('RecycleBinItemCollection.php');
require_once('FileVersion.php');
require_once('FileVersionCollection.php');
require_once('ContentType.php');
require_once('ContentTypeCollection.php');
require_once('AppInstance.php');
require_once('ChangeToken.php');
require_once('Change.php');
require_once('ChangeFile.php');
require_once('ChangeFolder.php');
require_once('ChangeField.php');
require_once('ChangeItem.php');
require_once('ChangeList.php');
require_once('ChangeWeb.php');
require_once('ChangeCollection.php');
require_once('ChangeType.php');
require_once('ChangeLogItemQuery.php');
require_once('PermissionKind.php');
require_once('BasePermissions.php');
require_once('AttachmentCreationInformation.php');
require_once('ViewCreationInformation.php');
require_once('WebCreationInformation.php');
require_once('ChangeQuery.php');
require_once('GroupCreationInformation.php');
require_once('ListCreationInformation.php');
require_once('ListTemplateType.php');
require_once('ListItemCollectionPosition.php');
require_once('CamlQuery.php');
require_once('FileCreationInformation.php');
require_once('FieldCreationInformation.php');
require_once('FieldLookupValue.php');
require_once('FieldUrlValue.php');
require_once('FieldUserValue.php');
require_once('FieldGeolocationValue.php');
require_once('RoleDefinitionCreationInformation.php');
require_once('ContentTypeId.php');
require_once('ContentTypeCreationInformation.php');
require_once('webparts/LimitedWebPartManager.php');
require_once('TemplateFileType.php');
require_once('CustomActionElement.php');
require_once('CustomActionElementCollection.php');
require_once('UserIdInfo.php');

/**
 * Client context for SharePoint
 */
class ClientContext extends ClientRuntimeContext
{
    /**
     * @var Site
     */
    private $site;

    /**
     * @var Web
     */
    private $web;


    /**
     * @var ContextWebInformation
     */
    private $contextWebInformation;


    /**
     * OData service path for Office365
     * @var string
     */
    public static $ServicePath = "/_api/";

    /**
     * ClientContext constructor.
     * @param string $url
     * @param IAuthenticationContext $authCtx
     */
    public function __construct($url, IAuthenticationContext $authCtx)
    {
        $serviceRootUrl = $url . self::$ServicePath;
        parent::__construct($serviceRootUrl,$authCtx);
    }


    /**
     * Ensure form digest value for POST request
     * @param RequestOptions $request
     */
    public function ensureFormDigest(RequestOptions $request)
    {
        if (!isset($this->contextWebInformation)) {
            $this->requestFormDigest();
        }
        $request->addCustomHeader("X-RequestDigest",$this->getContextWebInformation()->FormDigestValue);
    }


    /**
     * Request the SharePoint Context Info
     */
    protected function requestFormDigest()
    {
        $url = $this->getServiceRootUrl() . "contextinfo";
        $request = new RequestOptions($url);
        $request->setCustomHeaders($this->JsonFormat->buildHeaders());
        $request->PostMethod = true;
        //authenticate request
        $this->authenticateRequest($request);
        $response = Requests::execute($request);
        $data = json_decode($response);
        $this->contextWebInformation = new ContextWebInformation();
        $this->contextWebInformation->fromJson($data);
    }


    /**
     * @return Web
     */
    public function getWeb()
    {
        if(!isset($this->web)){
            $this->web = new Web($this,new ResourcePathEntry($this,null,"Web"));
        }
        return $this->web;
    }


    /**
     * @return Site
     */
    public function getSite()
    {
        if(!isset($this->site)){
            $this->site = new Site($this, new ResourcePathEntry($this,null,"Site"));
        }
        return $this->site;
    }


    /**
     * @return ContextWebInformation
     */
    public function getContextWebInformation()
    {
        return $this->contextWebInformation;
    }

}