<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Common;

use Office365\Entity;


/**
 * Represents an instance of an application in a directory. Inherits from [directoryObject](directoryobject.md).
 */
class ServicePrincipal extends Entity
{
    /**
     *  **true** if the service principal account is enabled; otherwise, **false**.
     * @return bool
     */
    public function getAccountEnabled()
    {
        if (!$this->isPropertyAvailable("AccountEnabled")) {
            return null;
        }
        return $this->getProperty("AccountEnabled");
    }
    /**
     *  **true** if the service principal account is enabled; otherwise, **false**.
     * @var bool
     */
    public function setAccountEnabled($value)
    {
        $this->setProperty("AccountEnabled", $value, true);
    }
    /**
     *  Used to retrieve service principals by subscription, identify resource group and full resource ids for [managed identities](https://aka.ms/azuremanagedidentity).
     * @return array
     */
    public function getAlternativeNames()
    {
        if (!$this->isPropertyAvailable("AlternativeNames")) {
            return null;
        }
        return $this->getProperty("AlternativeNames");
    }
    /**
     *  Used to retrieve service principals by subscription, identify resource group and full resource ids for [managed identities](https://aka.ms/azuremanagedidentity).
     * @var array
     */
    public function setAlternativeNames($value)
    {
        $this->setProperty("AlternativeNames", $value, true);
    }
    /**
     * The display name exposed by the associated application.
     * @return string
     */
    public function getAppDisplayName()
    {
        if (!$this->isPropertyAvailable("AppDisplayName")) {
            return null;
        }
        return $this->getProperty("AppDisplayName");
    }
    /**
     * The display name exposed by the associated application.
     * @var string
     */
    public function setAppDisplayName($value)
    {
        $this->setProperty("AppDisplayName", $value, true);
    }
    /**
     * The unique identifier for the associated application (its **appId** property).
     * @return string
     */
    public function getAppId()
    {
        if (!$this->isPropertyAvailable("AppId")) {
            return null;
        }
        return $this->getProperty("AppId");
    }
    /**
     * The unique identifier for the associated application (its **appId** property).
     * @var string
     */
    public function setAppId($value)
    {
        $this->setProperty("AppId", $value, true);
    }
    /**
     * Contains the tenant id where the application is registered. This is applicable only to service principals backed by applications.
     * @return string
     */
    public function getAppOwnerOrganizationId()
    {
        if (!$this->isPropertyAvailable("AppOwnerOrganizationId")) {
            return null;
        }
        return $this->getProperty("AppOwnerOrganizationId");
    }
    /**
     * Contains the tenant id where the application is registered. This is applicable only to service principals backed by applications.
     * @var string
     */
    public function setAppOwnerOrganizationId($value)
    {
        $this->setProperty("AppOwnerOrganizationId", $value, true);
    }
    /**
     * Specifies whether users or other service principals need to be granted an app role assignment for this service principal before users can sign in or apps can get tokens. The default value is **false**. Not nullable. 
     * @return bool
     */
    public function getAppRoleAssignmentRequired()
    {
        if (!$this->isPropertyAvailable("AppRoleAssignmentRequired")) {
            return null;
        }
        return $this->getProperty("AppRoleAssignmentRequired");
    }
    /**
     * Specifies whether users or other service principals need to be granted an app role assignment for this service principal before users can sign in or apps can get tokens. The default value is **false**. Not nullable. 
     * @var bool
     */
    public function setAppRoleAssignmentRequired($value)
    {
        $this->setProperty("AppRoleAssignmentRequired", $value, true);
    }
    /**
     * The display name for the service principal.
     * @return string
     */
    public function getDisplayName()
    {
        if (!$this->isPropertyAvailable("DisplayName")) {
            return null;
        }
        return $this->getProperty("DisplayName");
    }
    /**
     * The display name for the service principal.
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * Home page or landing page of the application.
     * @return string
     */
    public function getHomepage()
    {
        if (!$this->isPropertyAvailable("Homepage")) {
            return null;
        }
        return $this->getProperty("Homepage");
    }
    /**
     * Home page or landing page of the application.
     * @var string
     */
    public function setHomepage($value)
    {
        $this->setProperty("Homepage", $value, true);
    }
    /**
     *  Specifies the URL that will be used by Microsoft's authorization service to logout an user using OpenId Connect [front-channel](https://openid.net/specs/openid-connect-frontchannel-1_0.html), [back-channel](https://openid.net/specs/openid-connect-backchannel-1_0.html) or SAML logout protocols.
     * @return string
     */
    public function getLogoutUrl()
    {
        if (!$this->isPropertyAvailable("LogoutUrl")) {
            return null;
        }
        return $this->getProperty("LogoutUrl");
    }
    /**
     *  Specifies the URL that will be used by Microsoft's authorization service to logout an user using OpenId Connect [front-channel](https://openid.net/specs/openid-connect-frontchannel-1_0.html), [back-channel](https://openid.net/specs/openid-connect-backchannel-1_0.html) or SAML logout protocols.
     * @var string
     */
    public function setLogoutUrl($value)
    {
        $this->setProperty("LogoutUrl", $value, true);
    }
    /**
     * The URLs that user tokens are sent to for sign in with the associated application, or the redirect URIs that OAuth 2.0 authorization codes and access tokens are sent to for the associated application. Not nullable. 
     * @return array
     */
    public function getReplyUrls()
    {
        if (!$this->isPropertyAvailable("ReplyUrls")) {
            return null;
        }
        return $this->getProperty("ReplyUrls");
    }
    /**
     * The URLs that user tokens are sent to for sign in with the associated application, or the redirect URIs that OAuth 2.0 authorization codes and access tokens are sent to for the associated application. Not nullable. 
     * @var array
     */
    public function setReplyUrls($value)
    {
        $this->setProperty("ReplyUrls", $value, true);
    }
    /**
     * Contains the list of **identifiersUris**, copied over from the associated [application](application.md). Additional values can be added to hybrid applications. These values can be used to identify the permissions exposed by this app within Azure AD. For example,<ul><li>Client apps can specify a resource URI which is based on the values of this property to acquire an access token, which is the URI returned in the “aud” claim.</li></ul><br>The any operator is required for filter expressions on multi-valued properties. Not nullable.
     * @return array
     */
    public function getServicePrincipalNames()
    {
        if (!$this->isPropertyAvailable("ServicePrincipalNames")) {
            return null;
        }
        return $this->getProperty("ServicePrincipalNames");
    }
    /**
     * Contains the list of **identifiersUris**, copied over from the associated [application](application.md). Additional values can be added to hybrid applications. These values can be used to identify the permissions exposed by this app within Azure AD. For example,<ul><li>Client apps can specify a resource URI which is based on the values of this property to acquire an access token, which is the URI returned in the “aud” claim.</li></ul><br>The any operator is required for filter expressions on multi-valued properties. Not nullable.
     * @var array
     */
    public function setServicePrincipalNames($value)
    {
        $this->setProperty("ServicePrincipalNames", $value, true);
    }
    /**
     * Identifies if the service principal represents an application or a managed identity. This is set by Azure AD internally. For a service principal that represents an [application](./application.md) this is set as __Application__. For a service principal that represent a [managed identity](https://docs.microsoft.com/azure/active-directory/managed-identities-azure-resources/overview) this is set as __ManagedIdentity__.
     * @return string
     */
    public function getServicePrincipalType()
    {
        if (!$this->isPropertyAvailable("ServicePrincipalType")) {
            return null;
        }
        return $this->getProperty("ServicePrincipalType");
    }
    /**
     * Identifies if the service principal represents an application or a managed identity. This is set by Azure AD internally. For a service principal that represents an [application](./application.md) this is set as __Application__. For a service principal that represent a [managed identity](https://docs.microsoft.com/azure/active-directory/managed-identities-azure-resources/overview) this is set as __ManagedIdentity__.
     * @var string
     */
    public function setServicePrincipalType($value)
    {
        $this->setProperty("ServicePrincipalType", $value, true);
    }
    /**
     *  Custom strings that can be used to categorize and identify the service principal. Not nullable. 
     * @return array
     */
    public function getTags()
    {
        if (!$this->isPropertyAvailable("Tags")) {
            return null;
        }
        return $this->getProperty("Tags");
    }
    /**
     *  Custom strings that can be used to categorize and identify the service principal. Not nullable. 
     * @var array
     */
    public function setTags($value)
    {
        $this->setProperty("Tags", $value, true);
    }
    /**
     * @return string
     */
    public function getTokenEncryptionKeyId()
    {
        if (!$this->isPropertyAvailable("TokenEncryptionKeyId")) {
            return null;
        }
        return $this->getProperty("TokenEncryptionKeyId");
    }
    /**
     * @var string
     */
    public function setTokenEncryptionKeyId($value)
    {
        $this->setProperty("TokenEncryptionKeyId", $value, true);
    }
}