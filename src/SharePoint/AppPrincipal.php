<?php

/**
 * Generated  2024-02-24T10:21:51+00:00 16.0.24607.12008
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientObject;
use Office365\Runtime\Actions\DeleteEntityQuery;
use Office365\Runtime\ResourcePath;
use Office365\Runtime\Actions\UpdateEntityQuery;
class AppPrincipal extends BaseEntity
{
    /**
     * The 
     * display name of the app principal.
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }
    /**
     * The 
     * display name of the app principal.
     * @var string
     */
    public function setDisplayName($value)
    {
        return $this->setProperty("DisplayName", $value, true);
    }
    /**
     * Accessibility: Read OnlyThe 
     * endpoints of the app.The value 
     * is a list of hostname[:port].
     * @return array
     */
    public function getEndpointAuthorities()
    {
        return $this->getProperty("EndpointAuthorities");
    }
    /**
     * Accessibility: Read OnlyThe 
     * endpoints of the app.The value 
     * is a list of hostname[:port].
     * @var array
     */
    public function setEndpointAuthorities($value)
    {
        return $this->setProperty("EndpointAuthorities", $value, true);
    }
    /**
     * The name 
     * identifier of the app principal.
     * @return string
     */
    public function getNameIdentifier()
    {
        return $this->getProperty("NameIdentifier");
    }
    /**
     * The name 
     * identifier of the app principal.
     * @var string
     */
    public function setNameIdentifier($value)
    {
        return $this->setProperty("NameIdentifier", $value, true);
    }
    /**
     * Accessibility: Read OnlyThe 
     * redirect URI associated with the app.The 
     * authorization server sends the end user back to the redirect URI once the 
     * access is granted or denied.
     * @return array
     */
    public function getRedirectAddresses()
    {
        return $this->getProperty("RedirectAddresses");
    }
    /**
     * Accessibility: Read OnlyThe 
     * redirect URI associated with the app.The 
     * authorization server sends the end user back to the redirect URI once the 
     * access is granted or denied.
     * @var array
     */
    public function setRedirectAddresses($value)
    {
        return $this->setProperty("RedirectAddresses", $value, true);
    }
}