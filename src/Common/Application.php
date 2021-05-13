<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00 
 */
namespace Office365\Common;

use Office365\Runtime\ResourcePath;
/**
 *  "Represents an application."
 */
class Application extends DirectoryObject
{
    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->getProperty("AppId");
    }
    /**
     * @var string
     */
    public function setAppId($value)
    {
        $this->setProperty("AppId", $value, true);
    }
    /**
     * @return string
     */
    public function getApplicationTemplateId()
    {
        return $this->getProperty("ApplicationTemplateId");
    }
    /**
     * @var string
     */
    public function setApplicationTemplateId($value)
    {
        $this->setProperty("ApplicationTemplateId", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsFallbackPublicClient()
    {
        return $this->getProperty("IsFallbackPublicClient");
    }
    /**
     * @var bool
     */
    public function setIsFallbackPublicClient($value)
    {
        $this->setProperty("IsFallbackPublicClient", $value, true);
    }
    /**
     * @return array
     */
    public function getIdentifierUris()
    {
        return $this->getProperty("IdentifierUris");
    }
    /**
     * @var array
     */
    public function setIdentifierUris($value)
    {
        $this->setProperty("IdentifierUris", $value, true);
    }
    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }
    /**
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * @return string
     */
    public function getGroupMembershipClaims()
    {
        return $this->getProperty("GroupMembershipClaims");
    }
    /**
     * @var string
     */
    public function setGroupMembershipClaims($value)
    {
        $this->setProperty("GroupMembershipClaims", $value, true);
    }
    /**
     * @return bool
     */
    public function getIsDeviceOnlyAuthSupported()
    {
        return $this->getProperty("IsDeviceOnlyAuthSupported");
    }
    /**
     * @var bool
     */
    public function setIsDeviceOnlyAuthSupported($value)
    {
        $this->setProperty("IsDeviceOnlyAuthSupported", $value, true);
    }
    /**
     * @return bool
     */
    public function getOauth2RequirePostResponse()
    {
        return $this->getProperty("Oauth2RequirePostResponse");
    }
    /**
     * @var bool
     */
    public function setOauth2RequirePostResponse($value)
    {
        $this->setProperty("Oauth2RequirePostResponse", $value, true);
    }
    /**
     * @return string
     */
    public function getPublisherDomain()
    {
        return $this->getProperty("PublisherDomain");
    }
    /**
     * @var string
     */
    public function setPublisherDomain($value)
    {
        $this->setProperty("PublisherDomain", $value, true);
    }
    /**
     * @return string
     */
    public function getSignInAudience()
    {
        return $this->getProperty("SignInAudience");
    }
    /**
     * @var string
     */
    public function setSignInAudience($value)
    {
        $this->setProperty("SignInAudience", $value, true);
    }
    /**
     * @return array
     */
    public function getTags()
    {
        return $this->getProperty("Tags");
    }
    /**
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
        return $this->getProperty("TokenEncryptionKeyId");
    }
    /**
     * @var string
     */
    public function setTokenEncryptionKeyId($value)
    {
        $this->setProperty("TokenEncryptionKeyId", $value, true);
    }
    /**
     *  Read-only.
     * @return DirectoryObject
     */
    public function getCreatedOnBehalfOf()
    {
        return $this->getProperty("CreatedOnBehalfOf",
            new DirectoryObject($this->getContext(), new ResourcePath("CreatedOnBehalfOf", $this->getResourcePath())));
    }
    /**
     * @return ApiApplication
     */
    public function getApi()
    {
        return $this->getProperty("Api", new ApiApplication());
    }
    /**
     * @var ApiApplication
     */
    public function setApi($value)
    {
        $this->setProperty("Api", $value, true);
    }
    /**
     * @return PublicClientApplication
     */
    public function getPublicClient()
    {
        return $this->getProperty("PublicClient", new PublicClientApplication());
    }
    /**
     * @var PublicClientApplication
     */
    public function setPublicClient($value)
    {
        $this->setProperty("PublicClient", $value, true);
    }
    /**
     * @return InformationalUrl
     */
    public function getInfo()
    {
        return $this->getProperty("Info", new InformationalUrl());
    }
    /**
     * @var InformationalUrl
     */
    public function setInfo($value)
    {
        $this->setProperty("Info", $value, true);
    }
    /**
     * @return OptionalClaims
     */
    public function getOptionalClaims()
    {
        return $this->getProperty("OptionalClaims", new OptionalClaims());
    }
    /**
     * @var OptionalClaims
     */
    public function setOptionalClaims($value)
    {
        $this->setProperty("OptionalClaims", $value, true);
    }
    /**
     * @return ParentalControlSettings
     */
    public function getParentalControlSettings()
    {
        return $this->getProperty("ParentalControlSettings", new ParentalControlSettings());
    }
    /**
     * @var ParentalControlSettings
     */
    public function setParentalControlSettings($value)
    {
        $this->setProperty("ParentalControlSettings", $value, true);
    }
    /**
     * @return WebApplication
     */
    public function getWeb()
    {
        return $this->getProperty("Web", new WebApplication());
    }
    /**
     * @var WebApplication
     */
    public function setWeb($value)
    {
        $this->setProperty("Web", $value, true);
    }
}