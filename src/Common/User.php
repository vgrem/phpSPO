<?php

/**
 * Modified: 2020-05-27T07:36:43+00:00
 */
namespace Office365\Common;


use Office365\EntityCollection;
use Office365\OneDrive\Drive;
use Office365\OneDrive\DriveCollection;
use Office365\OneNote\Onenote;
use Office365\OutlookServices\Calendar;
use Office365\OutlookServices\Contact;
use Office365\OutlookServices\Event;
use Office365\OutlookServices\MailboxSettings;
use Office365\OutlookServices\MailFolder;
use Office365\OutlookServices\Message;
use Office365\OutlookServices\ProfilePhoto;
use Office365\Planner\PlannerUser;
use Office365\Runtime\Actions\InvokePostMethodQuery;
use Office365\Runtime\ResourcePath;
use Office365\Teams\TeamCollection;

/**
 *  "Represents an Azure AD user account. Inherits from directoryObject."
 */
class User extends DirectoryObject
{

    /**
     * Send the message specified in the request body. The message is saved in the Sent Items folder by default.
     * @param Message $message
     * @param bool $saveToSentItems
     * @return self
     */
    public function sendEmail(Message $message, $saveToSentItems)
    {
        $payload = array();
        $payload["Message"] = $message;
        $payload["SaveToSentItems"] = $saveToSentItems;
        $action = new InvokePostMethodQuery($this, "SendMail", null, null, $payload);
        $this->getContext()->addQuery($action);
        return $this;
    }

    /**
     *  **true** if the account is enabled; otherwise, **false**. This property is required when a user is created. Supports $filter.    
     * @return bool
     */
    public function getAccountEnabled()
    {
        return $this->getProperty("AccountEnabled");
    }
    /**
     *  **true** if the account is enabled; otherwise, **false**. This property is required when a user is created. Supports $filter.    
     * @var bool
     */
    public function setAccountEnabled($value)
    {
        $this->setProperty("AccountEnabled", $value, true);
    }
    /**
     * Sets the age group of the user. Allowed values: `null`, `minor`, `notAdult` and `adult`. Refer to the [legal age group property definitions](#legal-age-group-property-definitions) for further information. 
     * @return string
     */
    public function getAgeGroup()
    {
        return $this->getProperty("AgeGroup");
    }
    /**
     * Sets the age group of the user. Allowed values: `null`, `minor`, `notAdult` and `adult`. Refer to the [legal age group property definitions](#legal-age-group-property-definitions) for further information. 
     * @var string
     */
    public function setAgeGroup($value)
    {
        $this->setProperty("AgeGroup", $value, true);
    }
    /**
     * The telephone numbers for the user. NOTE: Although this is a string collection, only one number can be set for this property.
     * @return array
     */
    public function getBusinessPhones()
    {
        return $this->getProperty("BusinessPhones");
    }
    /**
     * The telephone numbers for the user. NOTE: Although this is a string collection, only one number can be set for this property.
     * @var array
     */
    public function setBusinessPhones($value)
    {
        $this->setProperty("BusinessPhones", $value, true);
    }
    /**
     * The city in which the user is located. Supports $filter.
     * @return string
     */
    public function getCity()
    {
        return $this->getProperty("City");
    }
    /**
     * The city in which the user is located. Supports $filter.
     * @var string
     */
    public function setCity($value)
    {
        $this->setProperty("City", $value, true);
    }
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
     * Sets whether consent has been obtained for minors. Allowed values: `null`, `granted`, `denied` and `notRequired`. Refer to the [legal age group property definitions](#legal-age-group-property-definitions) for further information.
     * @return string
     */
    public function getConsentProvidedForMinor()
    {
        return $this->getProperty("ConsentProvidedForMinor");
    }
    /**
     * Sets whether consent has been obtained for minors. Allowed values: `null`, `granted`, `denied` and `notRequired`. Refer to the [legal age group property definitions](#legal-age-group-property-definitions) for further information.
     * @var string
     */
    public function setConsentProvidedForMinor($value)
    {
        $this->setProperty("ConsentProvidedForMinor", $value, true);
    }
    /**
     * The country/region in which the user is located; for example, “US” or “UK”. Supports $filter.
     * @return string
     */
    public function getCountry()
    {
        return $this->getProperty("Country");
    }
    /**
     * The country/region in which the user is located; for example, “US” or “UK”. Supports $filter.
     * @var string
     */
    public function setCountry($value)
    {
        $this->setProperty("Country", $value, true);
    }
    /**
     * Indicates whether the user account was created as a regular school or work account (`null`), an external account (`Invitation`), a local account for an Azure Active Directory B2C tenant (`LocalAccount`) or self-service sign-up using email verification (`EmailVerified`). Read-only.
     * @return string
     */
    public function getCreationType()
    {
        return $this->getProperty("CreationType");
    }
    /**
     * Indicates whether the user account was created as a regular school or work account (`null`), an external account (`Invitation`), a local account for an Azure Active Directory B2C tenant (`LocalAccount`) or self-service sign-up using email verification (`EmailVerified`). Read-only.
     * @var string
     */
    public function setCreationType($value)
    {
        $this->setProperty("CreationType", $value, true);
    }
    /**
     * The name for the department in which the user works. Supports $filter.
     * @return string
     */
    public function getDepartment()
    {
        return $this->getProperty("Department");
    }
    /**
     * The name for the department in which the user works. Supports $filter.
     * @var string
     */
    public function setDepartment($value)
    {
        $this->setProperty("Department", $value, true);
    }
    /**
     * The name displayed in the address book for the user. This is usually the combination of the user's first name, middle initial and last name. This property is required when a user is created and it cannot be cleared during updates. Supports $filter and $orderby.
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }
    /**
     * The name displayed in the address book for the user. This is usually the combination of the user's first name, middle initial and last name. This property is required when a user is created and it cannot be cleared during updates. Supports $filter and $orderby.
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * The employee identifier assigned to the user by the organization. Supports $filter.
     * @return string
     */
    public function getEmployeeId()
    {
        return $this->getProperty("EmployeeId");
    }
    /**
     * The employee identifier assigned to the user by the organization. Supports $filter.
     * @var string
     */
    public function setEmployeeId($value)
    {
        $this->setProperty("EmployeeId", $value, true);
    }
    /**
     * The fax number of the user.
     * @return string
     */
    public function getFaxNumber()
    {
        return $this->getProperty("FaxNumber");
    }
    /**
     * The fax number of the user.
     * @var string
     */
    public function setFaxNumber($value)
    {
        $this->setProperty("FaxNumber", $value, true);
    }
    /**
     * The given name (first name) of the user. Supports $filter.
     * @return string
     */
    public function getGivenName()
    {
        return $this->getProperty("GivenName");
    }
    /**
     * The given name (first name) of the user. Supports $filter.
     * @var string
     */
    public function setGivenName($value)
    {
        $this->setProperty("GivenName", $value, true);
    }
    /**
     * The instant message voice over IP (VOIP) session initiation protocol (SIP) addresses for the user. Read-only.
     * @return array
     */
    public function getImAddresses()
    {
        return $this->getProperty("ImAddresses");
    }
    /**
     * The instant message voice over IP (VOIP) session initiation protocol (SIP) addresses for the user. Read-only.
     * @var array
     */
    public function setImAddresses($value)
    {
        $this->setProperty("ImAddresses", $value, true);
    }
    /**
     *  **true** if the user is a resource account; otherwise, **false**. Null value should be considered **false**.
     * @return bool
     */
    public function getIsResourceAccount()
    {
        return $this->getProperty("IsResourceAccount");
    }
    /**
     *  **true** if the user is a resource account; otherwise, **false**. Null value should be considered **false**.
     * @var bool
     */
    public function setIsResourceAccount($value)
    {
        $this->setProperty("IsResourceAccount", $value, true);
    }
    /**
     * The user’s job title. Supports $filter.
     * @return string
     */
    public function getJobTitle()
    {
        return $this->getProperty("JobTitle");
    }
    /**
     * The user’s job title. Supports $filter.
     * @var string
     */
    public function setJobTitle($value)
    {
        $this->setProperty("JobTitle", $value, true);
    }
    /**
     *  Used by enterprise applications to determine the legal age group of the user. This property is read-only and calculated based on `ageGroup` and `consentProvidedForMinor` properties. Allowed values: `null`, `minorWithOutParentalConsent`, `minorWithParentalConsent`, `minorNoParentalConsentRequired`, `notAdult` and `adult`. Refer to the [legal age group property definitions](#legal-age-group-property-definitions) for further information.)
     * @return string
     */
    public function getLegalAgeGroupClassification()
    {
        return $this->getProperty("LegalAgeGroupClassification");
    }
    /**
     *  Used by enterprise applications to determine the legal age group of the user. This property is read-only and calculated based on `ageGroup` and `consentProvidedForMinor` properties. Allowed values: `null`, `minorWithOutParentalConsent`, `minorWithParentalConsent`, `minorNoParentalConsentRequired`, `notAdult` and `adult`. Refer to the [legal age group property definitions](#legal-age-group-property-definitions) for further information.)
     * @var string
     */
    public function setLegalAgeGroupClassification($value)
    {
        $this->setProperty("LegalAgeGroupClassification", $value, true);
    }
    /**
     * The SMTP address for the user, for example, "jeff@contoso.onmicrosoft.com". Read-Only. Supports $filter.
     * @return string
     */
    public function getMail()
    {
        return $this->getProperty("Mail");
    }
    /**
     * The SMTP address for the user, for example, "jeff@contoso.onmicrosoft.com". Read-Only. Supports $filter.
     * @var string
     */
    public function setMail($value)
    {
        $this->setProperty("Mail", $value, true);
    }
    /**
     * The mail alias for the user. This property must be specified when a user is created. Supports $filter.
     * @return string
     */
    public function getMailNickname()
    {
        if (!$this->isPropertyAvailable("MailNickname")) {
            return null;
        }
        return $this->getProperty("MailNickname");
    }
    /**
     * The mail alias for the user. This property must be specified when a user is created. Supports $filter.
     * @var string
     */
    public function setMailNickname($value)
    {
        $this->setProperty("MailNickname", $value, true);
    }
    /**
     * The primary cellular telephone number for the user.
     * @return string
     */
    public function getMobilePhone()
    {
        if (!$this->isPropertyAvailable("MobilePhone")) {
            return null;
        }
        return $this->getProperty("MobilePhone");
    }
    /**
     * The primary cellular telephone number for the user.
     * @var string
     */
    public function setMobilePhone($value)
    {
        $this->setProperty("MobilePhone", $value, true);
    }
    /**
     *  Contains the on-premises Active Directory `distinguished name` or `DN`. The property is only populated for customers who are synchronizing their on-premises directory to Azure Active Directory via Azure AD Connect. Read-only. 
     * @return string
     */
    public function getOnPremisesDistinguishedName()
    {
        if (!$this->isPropertyAvailable("OnPremisesDistinguishedName")) {
            return null;
        }
        return $this->getProperty("OnPremisesDistinguishedName");
    }
    /**
     *  Contains the on-premises Active Directory `distinguished name` or `DN`. The property is only populated for customers who are synchronizing their on-premises directory to Azure Active Directory via Azure AD Connect. Read-only. 
     * @var string
     */
    public function setOnPremisesDistinguishedName($value)
    {
        $this->setProperty("OnPremisesDistinguishedName", $value, true);
    }
    /**
     * This property is used to associate an on-premises Active Directory user account to their Azure AD user object. This property must be specified when creating a new user account in the Graph if you are using a federated domain for the user’s **userPrincipalName** (UPN) property. **Important:** The **$** and **\_** characters cannot be used when specifying this property. Supports $filter.                            
     * @return string
     */
    public function getOnPremisesImmutableId()
    {
        return $this->getProperty("OnPremisesImmutableId");
    }
    /**
     * This property is used to associate an on-premises Active Directory user account to their Azure AD user object. This property must be specified when creating a new user account in the Graph if you are using a federated domain for the user’s **userPrincipalName** (UPN) property. **Important:** The **$** and **\_** characters cannot be used when specifying this property. Supports $filter.                            
     * @var string
     */
    public function setOnPremisesImmutableId($value)
    {
        $this->setProperty("OnPremisesImmutableId", $value, true);
    }
    /**
     * Contains the on-premises security identifier (SID) for the user that was synchronized from on-premises to the cloud. Read-only.
     * @return string
     */
    public function getOnPremisesSecurityIdentifier()
    {
        return $this->getProperty("OnPremisesSecurityIdentifier");
    }
    /**
     * Contains the on-premises security identifier (SID) for the user that was synchronized from on-premises to the cloud. Read-only.
     * @var string
     */
    public function setOnPremisesSecurityIdentifier($value)
    {
        $this->setProperty("OnPremisesSecurityIdentifier", $value, true);
    }
    /**
     *  **true** if this object is synced from an on-premises directory; **false** if this object was originally synced from an on-premises directory but is no longer synced; **null** if this object has never been synced from an on-premises directory (default). Read-only 
     * @return bool
     */
    public function getOnPremisesSyncEnabled()
    {
        return $this->getProperty("OnPremisesSyncEnabled");
    }
    /**
     *  **true** if this object is synced from an on-premises directory; **false** if this object was originally synced from an on-premises directory but is no longer synced; **null** if this object has never been synced from an on-premises directory (default). Read-only 
     * @var bool
     */
    public function setOnPremisesSyncEnabled($value)
    {
        $this->setProperty("OnPremisesSyncEnabled", $value, true);
    }
    /**
     *  Contains the on-premises `domainFQDN`, also called dnsDomainName synchronized from the on-premises directory. The property is only populated for customers who are synchronizing their on-premises directory to Azure Active Directory via Azure AD Connect. Read-only. 
     * @return string
     */
    public function getOnPremisesDomainName()
    {
        return $this->getProperty("OnPremisesDomainName");
    }
    /**
     *  Contains the on-premises `domainFQDN`, also called dnsDomainName synchronized from the on-premises directory. The property is only populated for customers who are synchronizing their on-premises directory to Azure Active Directory via Azure AD Connect. Read-only. 
     * @var string
     */
    public function setOnPremisesDomainName($value)
    {
        $this->setProperty("OnPremisesDomainName", $value, true);
    }
    /**
     *  Contains the on-premises `samAccountName` synchronized from the on-premises directory. The property is only populated for customers who are synchronizing their on-premises directory to Azure Active Directory via Azure AD Connect. Read-only. 
     * @return string
     */
    public function getOnPremisesSamAccountName()
    {
        return $this->getProperty("OnPremisesSamAccountName");
    }
    /**
     *  Contains the on-premises `samAccountName` synchronized from the on-premises directory. The property is only populated for customers who are synchronizing their on-premises directory to Azure Active Directory via Azure AD Connect. Read-only. 
     * @var string
     */
    public function setOnPremisesSamAccountName($value)
    {
        $this->setProperty("OnPremisesSamAccountName", $value, true);
    }
    /**
     *  Contains the on-premises `userPrincipalName` synchronized from the on-premises directory. The property is only populated for customers who are synchronizing their on-premises directory to Azure Active Directory via Azure AD Connect. Read-only. 
     * @return string
     */
    public function getOnPremisesUserPrincipalName()
    {
        if (!$this->isPropertyAvailable("OnPremisesUserPrincipalName")) {
            return null;
        }
        return $this->getProperty("OnPremisesUserPrincipalName");
    }
    /**
     *  Contains the on-premises `userPrincipalName` synchronized from the on-premises directory. The property is only populated for customers who are synchronizing their on-premises directory to Azure Active Directory via Azure AD Connect. Read-only.
     * @var string
     */
    public function setOnPremisesUserPrincipalName($value)
    {
        $this->setProperty("OnPremisesUserPrincipalName", $value, true);
    }
    /**
     *  A list of additional email addresses for the user; for example: `["bob@contoso.com", "Robert@fabrikam.com"]`. Supports $filter.
     * @return array
     */
    public function getOtherMails()
    {
        if (!$this->isPropertyAvailable("OtherMails")) {
            return null;
        }
        return $this->getProperty("OtherMails");
    }
    /**
     *  A list of additional email addresses for the user; for example: `["bob@contoso.com", "Robert@fabrikam.com"]`. Supports $filter.
     * @var array
     */
    public function setOtherMails($value)
    {
        $this->setProperty("OtherMails", $value, true);
    }
    /**
     * Specifies password policies for the user. This value is an enumeration with one possible value being “DisableStrongPassword”, which allows weaker passwords than the default policy to be specified. “DisablePasswordExpiration” can also be specified. The two may be specified together; for example: "DisablePasswordExpiration, DisableStrongPassword".
     * @return string
     */
    public function getPasswordPolicies()
    {
        return $this->getProperty("PasswordPolicies");
    }
    /**
     * Specifies password policies for the user. This value is an enumeration with one possible value being “DisableStrongPassword”, which allows weaker passwords than the default policy to be specified. “DisablePasswordExpiration” can also be specified. The two may be specified together; for example: "DisablePasswordExpiration, DisableStrongPassword".
     * @var string
     */
    public function setPasswordPolicies($value)
    {
        $this->setProperty("PasswordPolicies", $value, true);
    }
    /**
     * The office location in the user's place of business.
     * @return string
     */
    public function getOfficeLocation()
    {
        return $this->getProperty("OfficeLocation");
    }
    /**
     * The office location in the user's place of business.
     * @var string
     */
    public function setOfficeLocation($value)
    {
        $this->setProperty("OfficeLocation", $value, true);
    }
    /**
     * The postal code for the user's postal address. The postal code is specific to the user's country/region. In the United States of America, this attribute contains the ZIP code.
     * @return string
     */
    public function getPostalCode()
    {
        return $this->getProperty("PostalCode");
    }
    /**
     * The postal code for the user's postal address. The postal code is specific to the user's country/region. In the United States of America, this attribute contains the ZIP code.
     * @var string
     */
    public function setPostalCode($value)
    {
        $this->setProperty("PostalCode", $value, true);
    }
    /**
     * The preferred language for the user. Should follow ISO 639-1 Code; for example "en-US".
     * @return string
     */
    public function getPreferredLanguage()
    {
        return $this->getProperty("PreferredLanguage");
    }
    /**
     * The preferred language for the user. Should follow ISO 639-1 Code; for example "en-US".
     * @var string
     */
    public function setPreferredLanguage($value)
    {
        $this->setProperty("PreferredLanguage", $value, true);
    }
    /**
     * For example: `["SMTP: bob@contoso.com", "smtp: bob@sales.contoso.com"]` The **any** operator is required for filter expressions on multi-valued properties. Read-only, Not nullable. Supports $filter.
     * @return array
     */
    public function getProxyAddresses()
    {
        return $this->getProperty("ProxyAddresses");
    }
    /**
     * For example: `["SMTP: bob@contoso.com", "smtp: bob@sales.contoso.com"]` The **any** operator is required for filter expressions on multi-valued properties. Read-only, Not nullable. Supports $filter.
     * @var array
     */
    public function setProxyAddresses($value)
    {
        $this->setProperty("ProxyAddresses", $value, true);
    }
    /**
     * **true** if the Outlook global address list should contain this user, otherwise **false**. If not set, this will be treated as **true**. For users invited through the invitation manager, this property will be set to **false**.
     * @return bool
     */
    public function getShowInAddressList()
    {
        return $this->getProperty("ShowInAddressList");
    }
    /**
     * **true** if the Outlook global address list should contain this user, otherwise **false**. If not set, this will be treated as **true**. For users invited through the invitation manager, this property will be set to **false**.
     * @var bool
     */
    public function setShowInAddressList($value)
    {
        $this->setProperty("ShowInAddressList", $value, true);
    }
    /**
     * The state or province in the user's address. Supports $filter.
     * @return string
     */
    public function getState()
    {
        return $this->getProperty("State");
    }
    /**
     * The state or province in the user's address. Supports $filter.
     * @var string
     */
    public function setState($value)
    {
        $this->setProperty("State", $value, true);
    }
    /**
     * The street address of the user's place of business.
     * @return string
     */
    public function getStreetAddress()
    {
        return $this->getProperty("StreetAddress");
    }
    /**
     * The street address of the user's place of business.
     * @var string
     */
    public function setStreetAddress($value)
    {
        $this->setProperty("StreetAddress", $value, true);
    }
    /**
     * The user's surname (family name or last name). Supports $filter.
     * @return string
     */
    public function getSurname()
    {
        return $this->getProperty("Surname");
    }
    /**
     * The user's surname (family name or last name). Supports $filter.
     * @var string
     */
    public function setSurname($value)
    {
        $this->setProperty("Surname", $value, true);
    }
    /**
     * A two letter country code (ISO standard 3166). Required for users that will be assigned licenses due to legal requirement to check for availability of services in countries.  Examples include: "US", "JP", and "GB". Not nullable. Supports $filter.
     * @return string
     */
    public function getUsageLocation()
    {
        return $this->getProperty("UsageLocation");
    }
    /**
     * A two letter country code (ISO standard 3166). Required for users that will be assigned licenses due to legal requirement to check for availability of services in countries.  Examples include: "US", "JP", and "GB". Not nullable. Supports $filter.
     * @var string
     */
    public function setUsageLocation($value)
    {
        $this->setProperty("UsageLocation", $value, true);
    }
    /**
     * The user principal name (UPN) of the user. The UPN is an Internet-style login name for the user based on the Internet standard RFC 822. By convention, this should map to the user's email name. The general format is alias@domain, where domain must be present in the tenant’s collection of verified domains. This property is required when a user is created. The verified domains for the tenant can be accessed from the **verifiedDomains** property of [organization](organization.md). Supports $filter and $orderby.
     * @return string
     */
    public function getUserPrincipalName()
    {
        return $this->getProperty("UserPrincipalName");
    }
    /**
     * The user principal name (UPN) of the user. The UPN is an Internet-style login name for the user based on the Internet standard RFC 822. By convention, this should map to the user's email name. The general format is alias@domain, where domain must be present in the tenant’s collection of verified domains. This property is required when a user is created. The verified domains for the tenant can be accessed from the **verifiedDomains** property of [organization](organization.md). Supports $filter and $orderby.
     * @var string
     */
    public function setUserPrincipalName($value)
    {
        $this->setProperty("UserPrincipalName", $value, true);
    }
    /**
     * A string value that can be used to classify user types in your directory, such as “Member” and “Guest”. Supports $filter.          
     * @return string
     */
    public function getUserType()
    {
        return $this->getProperty("UserType");
    }
    /**
     * A string value that can be used to classify user types in your directory, such as “Member” and “Guest”. Supports $filter.          
     * @var string
     */
    public function setUserType($value)
    {
        $this->setProperty("UserType", $value, true);
    }
    /**
     * @return integer
     */
    public function getDeviceEnrollmentLimit()
    {
        return $this->getProperty("DeviceEnrollmentLimit");
    }
    /**
     * @var integer
     */
    public function setDeviceEnrollmentLimit($value)
    {
        $this->setProperty("DeviceEnrollmentLimit", $value, true);
    }
    /**
     * A freeform text entry field for the user to describe themselves.
     * @return string
     */
    public function getAboutMe()
    {
        return $this->getProperty("AboutMe");
    }
    /**
     * A freeform text entry field for the user to describe themselves.
     * @var string
     */
    public function setAboutMe($value)
    {
        $this->setProperty("AboutMe", $value, true);
    }
    /**
     * A list for the user to describe their interests.
     * @return array
     */
    public function getInterests()
    {
        return $this->getProperty("Interests");
    }
    /**
     * A list for the user to describe their interests.
     * @var array
     */
    public function setInterests($value)
    {
        $this->setProperty("Interests", $value, true);
    }
    /**
     * The URL for the user's personal site.
     * @return string
     */
    public function getMySite()
    {
        return $this->getProperty("MySite");
    }
    /**
     * The URL for the user's personal site.
     * @var string
     */
    public function setMySite($value)
    {
        $this->setProperty("MySite", $value, true);
    }
    /**
     * A list for the user to enumerate their past projects.
     * @return array
     */
    public function getPastProjects()
    {
        return $this->getProperty("PastProjects");
    }
    /**
     * A list for the user to enumerate their past projects.
     * @var array
     */
    public function setPastProjects($value)
    {
        $this->setProperty("PastProjects", $value, true);
    }
    /**
     * The preferred name for the user.
     * @return string
     */
    public function getPreferredName()
    {
        return $this->getProperty("PreferredName");
    }
    /**
     * The preferred name for the user.
     * @var string
     */
    public function setPreferredName($value)
    {
        $this->setProperty("PreferredName", $value, true);
    }
    /**
     * A list for the user to enumerate their responsibilities.
     * @return array
     */
    public function getResponsibilities()
    {
        return $this->getProperty("Responsibilities");
    }
    /**
     * A list for the user to enumerate their responsibilities.
     * @var array
     */
    public function setResponsibilities($value)
    {
        $this->setProperty("Responsibilities", $value, true);
    }
    /**
     * A list for the user to enumerate the schools they have attended.
     * @return array
     */
    public function getSchools()
    {
        return $this->getProperty("Schools");
    }

    /**
     * A list for the user to enumerate the schools they have attended.
     *
     * @return self
     * @var array
     */
    public function setSchools($value)
    {
        return $this->setProperty("Schools", $value, true);
    }
    /**
     * A list for the user to enumerate their skills.
     * @return array
     */
    public function getSkills()
    {
        return $this->getProperty("Skills");
    }
    /**
     * A list for the user to enumerate their skills.
     * @var array
     */
    public function setSkills($value)
    {
        $this->setProperty("Skills", $value, true);
    }
    /**
     * The user or contact that is this user’s manager. Read-only. (HTTP Methods: GET, PUT, DELETE.)
     * @return DirectoryObject
     */
    public function getManager()
    {
        return $this->getProperty("Manager",
            new DirectoryObject($this->getContext(), new ResourcePath("Manager", $this->getResourcePath())));
    }

    /**
     * Specifies the password profile for the user. The profile contains the user’s password. This property is required when a user is created. The password in the profile must satisfy minimum requirements as specified by the **passwordPolicies** property. By default, a strong password is required.
     * @return PasswordProfile
     */
    public function getPasswordProfile()
    {
        return $this->getProperty("PasswordProfile", new PasswordProfile());
    }

    /**
     * Specifies the password profile for the user. The profile contains the user’s password. This property is required when a user is created. The password in the profile must satisfy minimum requirements as specified by the **passwordPolicies** property. By default, a strong password is required.
     *
     * @return self
     * @var PasswordProfile
     */
    public function setPasswordProfile($value)
    {
        return $this->setProperty("PasswordProfile", $value, true);
    }
    /**
     * Settings for the primary mailbox of the signed-in user. You can [get](../api/user-get-mailboxsettings.md) or [update](../api/user-update-mailboxsettings.md) settings for sending automatic replies to incoming messages, locale and time zone.
     * @return MailboxSettings
     */
    public function getMailboxSettings()
    {
        return $this->getProperty("MailboxSettings", new MailboxSettings());
    }
    /**
     * Settings for the primary mailbox of the signed-in user. You can [get](../api/user-get-mailboxsettings.md) or [update](../api/user-update-mailboxsettings.md) settings for sending automatic replies to incoming messages, locale and time zone.
     * @var MailboxSettings
     */
    public function setMailboxSettings($value)
    {
        $this->setProperty("MailboxSettings", $value, true);
    }

    /**
     * The user's primary calendar. Read-only.
     * @return Calendar
     */
    public function getCalendar()
    {
        return $this->getProperty("Calendar",
            new Calendar($this->getContext(), new ResourcePath("Calendar", $this->getResourcePath())));
    }
    /**
     * @return InferenceClassification
     */
    public function getInferenceClassification()
    {
        return $this->getProperty("InferenceClassification",
            new InferenceClassification($this->getContext(),
                new ResourcePath("InferenceClassification", $this->getResourcePath())));
    }
    /**
     *  The user's profile photo. Read-only.
     * @return ProfilePhoto
     */
    public function getPhoto()
    {
        return $this->getProperty("Photo",
            new ProfilePhoto($this->getContext(), new ResourcePath("Photo", $this->getResourcePath())));
    }
    /**
     * The user's OneDrive. Read-only.
     * @return Drive
     */
    public function getDrive()
    {
        return $this->getProperty("Drive",
            new Drive($this->getContext(), new ResourcePath("Drive", $this->getResourcePath())));
    }
    /**
     *  Entry-point to the Planner resource that might exist for a user. Read-only.
     * @return PlannerUser
     */
    public function getPlanner()
    {
        return $this->getProperty("Planner",
            new PlannerUser($this->getContext(), new ResourcePath("Planner", $this->getResourcePath())));
    }
    /**
     *  Read-only. Nullable.
     * @return OfficeGraphInsights
     */
    public function getInsights()
    {
        return $this->getProperty("Insights",
            new OfficeGraphInsights($this->getContext(), new ResourcePath("Insights", $this->getResourcePath())));
    }
    /**
     * @return UserSettings
     */
    public function getSettings()
    {
        return $this->getProperty("Settings",
            new UserSettings($this->getContext(), new ResourcePath("Settings", $this->getResourcePath())));
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
     *  A collection of drives available for this user. Read-only. 
     * @return DriveCollection
     */
    public function getDrives()
    {
        return $this->getProperty("Drives",
            new DriveCollection($this->getContext(), new ResourcePath("Drives", $this->getResourcePath())));
    }

    /**
     * @return EntityCollection
     */
    public function getEvents()
    {
        return $this->getProperty("Events",
            new EntityCollection($this->getContext(),
                new ResourcePath("Events", $this->getResourcePath()),Event::class));
    }

    /**
     * @return EntityCollection
     */
    public function getContacts()
    {
        return $this->getProperty("Contacts",
            new EntityCollection($this->getContext(),
                new ResourcePath("Contacts", $this->getResourcePath()),Contact::class));
    }


    /**
     * @return EntityCollection
     */
    public function getMessages()
    {
        return $this->getProperty("Messages",
            new EntityCollection($this->getContext(),
                new ResourcePath("Messages", $this->getResourcePath()),Message::class));
    }

    /**
     * @return TeamCollection
     */
    public function getJoinedTeams()
    {
        return $this->getProperty("JoinedTeams",
            new TeamCollection($this->getContext(),new ResourcePath("joinedTeams", $this->getResourcePath())));
    }

    /**
     * @return EntityCollection
     */
    public function getMailFolders()
    {
        return $this->getProperty("MailFolders",
            new EntityCollection($this->getContext(),
                new ResourcePath("MailFolders", $this->getResourcePath()),MailFolder::class));
    }
}