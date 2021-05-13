<?php

/**
 * Modified: 2020-05-24T22:08:35+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ResourcePath;
/**
 *  "Represents an organizational contact"
 */
class OrgContact extends DirectoryObject
{
    /**
     * @return string
     */
    public function getCompanyName()
    {
        return $this->getProperty("CompanyName");
    }
    /**
     * @var string
     */
    public function setCompanyName($value)
    {
        $this->setProperty("CompanyName", $value, true);
    }
    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->getProperty("Department");
    }
    /**
     * @var string
     */
    public function setDepartment($value)
    {
        $this->setProperty("Department", $value, true);
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
    public function getGivenName()
    {
        return $this->getProperty("GivenName");
    }
    /**
     * @var string
     */
    public function setGivenName($value)
    {
        $this->setProperty("GivenName", $value, true);
    }
    /**
     * @return string
     */
    public function getJobTitle()
    {

        return $this->getProperty("JobTitle");
    }
    /**
     * @var string
     */
    public function setJobTitle($value)
    {
        $this->setProperty("JobTitle", $value, true);
    }
    /**
     *  The SMTP address for the contact, for example, "jeff@contoso.onmicrosoft.com". 
     * @return string
     */
    public function getMail()
    {
        return $this->getProperty("Mail");
    }
    /**
     *  The SMTP address for the contact, for example, "jeff@contoso.onmicrosoft.com". 
     * @var string
     */
    public function setMail($value)
    {
        $this->setProperty("Mail", $value, true);
    }
    /**
     * @return string
     */
    public function getMailNickname()
    {
        return $this->getProperty("MailNickname");
    }
    /**
     * @var string
     */
    public function setMailNickname($value)
    {
        $this->setProperty("MailNickname", $value, true);
    }
    /**
     * **true** if this object is synced from an on-premises directory; **false** if this object was originally synced from an on-premises directory but is no longer synced and now mastered in Exchange; **null** if this object has never been synced from an on-premises directory (default).
     * @return bool
     */
    public function getOnPremisesSyncEnabled()
    {
        return $this->getProperty("OnPremisesSyncEnabled");
    }
    /**
     * **true** if this object is synced from an on-premises directory; **false** if this object was originally synced from an on-premises directory but is no longer synced and now mastered in Exchange; **null** if this object has never been synced from an on-premises directory (default).
     * @var bool
     */
    public function setOnPremisesSyncEnabled($value)
    {
        $this->setProperty("OnPremisesSyncEnabled", $value, true);
    }
    /**
     * @return array
     */
    public function getProxyAddresses()
    {
        return $this->getProperty("ProxyAddresses");
    }
    /**
     * @var array
     */
    public function setProxyAddresses($value)
    {
        $this->setProperty("ProxyAddresses", $value, true);
    }
    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->getProperty("Surname");
    }
    /**
     * @var string
     */
    public function setSurname($value)
    {
        $this->setProperty("Surname", $value, true);
    }
    /**
     *  The user or contact that is this contact's manager. Read-only.
     * @return DirectoryObject
     */
    public function getManager()
    {
        return $this->getProperty("Manager",
            new DirectoryObject($this->getContext(), new ResourcePath("Manager", $this->getResourcePath())));
    }
}