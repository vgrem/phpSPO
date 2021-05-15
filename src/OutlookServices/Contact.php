<?php

/**
 * Modified: 2020-05-25T05:58:15+00:00 
 */
namespace Office365\OutlookServices;

use Office365\Entity;
use Office365\Runtime\ClientValueCollection;
use Office365\Runtime\ResourcePath;
/**
 *  "A contact is an item in Outlook where you can organize and save information about the people and organizations you communicate with. Contacts are contained in contact folders."
 */
class Contact extends Entity
{
    /**
     * The ID of the contact's parent folder.
     * @return string
     */
    public function getParentFolderId()
    {
        return $this->getProperty("ParentFolderId");
    }
    /**
     * The ID of the contact's parent folder.
     * @var string
     */
    public function setParentFolderId($value)
    {
        $this->setProperty("ParentFolderId", $value, true);
    }
    /**
     * The name the contact is filed under.
     * @return string
     */
    public function getFileAs()
    {
        return $this->getProperty("FileAs");
    }
    /**
     * The name the contact is filed under.
     * @var string
     */
    public function setFileAs($value)
    {
        $this->setProperty("FileAs", $value, true);
    }
    /**
     * The contact's display name. You can specify the display name in a [create](../api/user-post-contacts.md) or [update](../api/contact-update.md) operation. Note that later updates to other properties may cause an automatically generated value to overwrite the displayName value you have specified. To preserve a pre-existing value, always include it as displayName in an [update](../api/contact-update.md) operation.
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getProperty("DisplayName");
    }
    /**
     * The contact's display name. You can specify the display name in a [create](../api/user-post-contacts.md) or [update](../api/contact-update.md) operation. Note that later updates to other properties may cause an automatically generated value to overwrite the displayName value you have specified. To preserve a pre-existing value, always include it as displayName in an [update](../api/contact-update.md) operation.
     * @var string
     */
    public function setDisplayName($value)
    {
        $this->setProperty("DisplayName", $value, true);
    }
    /**
     * The contact's given name.
     * @return string
     */
    public function getGivenName()
    {
        return $this->getProperty("GivenName");
    }

    /**
     * The contact's given name.
     *
     * @return self
     * @var string
     */
    public function setGivenName($value)
    {
        return $this->setProperty("GivenName", $value, true);
    }
    /**
     * The contact's initials.
     * @return string
     */
    public function getInitials()
    {
        return $this->getProperty("Initials");
    }

    /**
     * The contact's initials.
     *
     * @return self
     * @var string
     */
    public function setInitials($value)
    {
        return $this->setProperty("Initials", $value, true);
    }
    /**
     * The contact's middle name.
     * @return string
     */
    public function getMiddleName()
    {
        return $this->getProperty("MiddleName");
    }

    /**
     * The contact's middle name.
     *
     * @return self
     * @var string
     */
    public function setMiddleName($value)
    {
        return $this->setProperty("MiddleName", $value, true);
    }
    /**
     * The contact's nickname.
     * @return string
     */
    public function getNickName()
    {
        return $this->getProperty("NickName");
    }

    /**
     * The contact's nickname.
     *
     * @return self
     * @var string
     */
    public function setNickName($value)
    {
        return $this->setProperty("NickName", $value, true);
    }
    /**
     * The contact's surname.
     * @return string
     */
    public function getSurname()
    {
        return $this->getProperty("Surname");
    }

    /**
     * The contact's surname.
     *
     * @return self
     * @var string
     */
    public function setSurname($value)
    {
        return $this->setProperty("Surname", $value, true);
    }
    /**
     * The contact's title.
     * @return string
     */
    public function getTitle()
    {
        return $this->getProperty("Title");
    }

    /**
     * The contact's title.
     *
     * @return self
     * @var string
     */
    public function setTitle($value)
    {
        return $this->setProperty("Title", $value, true);
    }
    /**
     * The phonetic Japanese given name (first name) of the contact.
     * @return string
     */
    public function getYomiGivenName()
    {
        return $this->getProperty("YomiGivenName");
    }
    /**
     * The phonetic Japanese given name (first name) of the contact.
     * @var string
     */
    public function setYomiGivenName($value)
    {
        $this->setProperty("YomiGivenName", $value, true);
    }
    /**
     * The phonetic Japanese surname (last name)  of the contact.
     * @return string
     */
    public function getYomiSurname()
    {
        return $this->getProperty("YomiSurname");
    }
    /**
     * The phonetic Japanese surname (last name)  of the contact.
     * @var string
     */
    public function setYomiSurname($value)
    {
        $this->setProperty("YomiSurname", $value, true);
    }
    /**
     * The phonetic Japanese company name of the contact.
     * @return string
     */
    public function getYomiCompanyName()
    {
        return $this->getProperty("YomiCompanyName");
    }
    /**
     * The phonetic Japanese company name of the contact.
     * @var string
     */
    public function setYomiCompanyName($value)
    {
        $this->setProperty("YomiCompanyName", $value, true);
    }
    /**
     * The contact's generation.
     * @return string
     */
    public function getGeneration()
    {
        return $this->getProperty("Generation");
    }
    /**
     * The contact's generation.
     * @var string
     */
    public function setGeneration($value)
    {
        $this->setProperty("Generation", $value, true);
    }
    /**
     * The contact's instant messaging (IM) addresses.
     * @return array
     */
    public function getImAddresses()
    {
        return $this->getProperty("ImAddresses");
    }
    /**
     * The contact's instant messaging (IM) addresses.
     * @var array
     */
    public function setImAddresses($value)
    {
        $this->setProperty("ImAddresses", $value, true);
    }
    /**
     * The contact’s job title.
     * @return string
     */
    public function getJobTitle()
    {
        return $this->getProperty("JobTitle");
    }

    /**
     * The contact’s job title.
     *
     * @return self
     * @var string
     */
    public function setJobTitle($value)
    {
        return $this->setProperty("JobTitle", $value, true);
    }
    /**
     * The name of the contact's company.
     * @return string
     */
    public function getCompanyName()
    {
        return $this->getProperty("CompanyName");
    }

    /**
     * The name of the contact's company.
     *
     * @return self
     * @var string
     */
    public function setCompanyName($value)
    {
        return $this->setProperty("CompanyName", $value, true);
    }
    /**
     * The contact's department.
     * @return string
     */
    public function getDepartment()
    {
        return $this->getProperty("Department");
    }

    /**
     * The contact's department.
     *
     * @return self
     * @var string
     */
    public function setDepartment($value)
    {
        return $this->setProperty("Department", $value, true);
    }
    /**
     * The location of the contact's office.
     * @return string
     */
    public function getOfficeLocation()
    {
        return $this->getProperty("OfficeLocation");
    }
    /**
     * The location of the contact's office.
     * @var string
     */
    public function setOfficeLocation($value)
    {
        $this->setProperty("OfficeLocation", $value, true);
    }
    /**
     * The contact's profession.
     * @return string
     */
    public function getProfession()
    {
        return $this->getProperty("Profession");
    }

    /**
     * The contact's profession.
     *
     * @return self
     * @var string
     */
    public function setProfession($value)
    {
        return $this->setProperty("Profession", $value, true);
    }
    /**
     * The business home page of the contact.
     * @return string
     */
    public function getBusinessHomePage()
    {
        return $this->getProperty("BusinessHomePage");
    }
    /**
     * The business home page of the contact.
     * @var string
     */
    public function setBusinessHomePage($value)
    {
        $this->setProperty("BusinessHomePage", $value, true);
    }
    /**
     * The name of the contact's assistant.
     * @return string
     */
    public function getAssistantName()
    {
        return $this->getProperty("AssistantName");
    }
    /**
     * The name of the contact's assistant.
     * @var string
     */
    public function setAssistantName($value)
    {
        $this->setProperty("AssistantName", $value, true);
    }
    /**
     * The name of the contact's manager.
     * @return string
     */
    public function getManager()
    {
        return $this->getProperty("Manager");
    }

    /**
     * The name of the contact's manager.
     *
     * @return self
     * @var string
     */
    public function setManager($value)
    {
        return $this->setProperty("Manager", $value, true);
    }
    /**
     * The contact's home phone numbers.
     * @return array
     */
    public function getHomePhones()
    {
        return $this->getProperty("HomePhones");
    }
    /**
     * The contact's home phone numbers.
     * @var array
     */
    public function setHomePhones($value)
    {
        $this->setProperty("HomePhones", $value, true);
    }
    /**
     * The contact's mobile phone number.
     * @return string
     */
    public function getMobilePhone()
    {
        return $this->getProperty("MobilePhone");
    }

    /**
     * The contact's mobile phone number.
     *
     * @return self
     * @var string
     */
    public function setMobilePhone($value)
    {
        return $this->setProperty("MobilePhone", $value, true);
    }
    /**
     * The contact's business phone numbers.
     * @return string[]
     */
    public function getBusinessPhones()
    {
        return $this->getProperty("BusinessPhones");
    }

    /**
     * The contact's business phone numbers.
     *
     * @return self
     * @var array
     */
    public function setBusinessPhones($value)
    {
        return $this->setProperty("BusinessPhones", $value, true);
    }
    /**
     * The name of the contact's spouse/partner.
     * @return string
     */
    public function getSpouseName()
    {
        return $this->getProperty("SpouseName");
    }

    /**
     * The name of the contact's spouse/partner.
     *
     * @return self
     * @var string
     */
    public function setSpouseName($value)
    {
        return $this->setProperty("SpouseName", $value, true);
    }
    /**
     * The user's notes about the contact.
     * @return string
     */
    public function getPersonalNotes()
    {
        return $this->getProperty("PersonalNotes");
    }

    /**
     * The user's notes about the contact.
     *
     * @return self
     * @var string
     */
    public function setPersonalNotes($value)
    {
        return $this->setProperty("PersonalNotes", $value, true);
    }
    /**
     * The names of the contact's children.
     * @return array
     */
    public function getChildren()
    {
        return $this->getProperty("Children");
    }
    /**
     * The names of the contact's children.
     * @var array
     */
    public function setChildren($value)
    {
        $this->setProperty("Children", $value, true);
    }
    /**
     *  Optional contact picture. You can get or set a photo for a contact.
     * @return ProfilePhoto
     */
    public function getPhoto()
    {
        return $this->getProperty("Photo",
            new ProfilePhoto($this->getContext(), new ResourcePath("Photo", $this->getResourcePath())));
    }
    /**
     * The contact's home address.
     * @return PhysicalAddress
     */
    public function getHomeAddress()
    {
        return $this->getProperty("HomeAddress", new PhysicalAddress());
    }
    /**
     * The contact's home address.
     * @var PhysicalAddress
     */
    public function setHomeAddress($value)
    {
        $this->setProperty("HomeAddress", $value, true);
    }
    /**
     * The contact's business address.
     * @return PhysicalAddress
     */
    public function getBusinessAddress()
    {
        return $this->getProperty("BusinessAddress", new PhysicalAddress());
    }
    /**
     * The contact's business address.
     * @var PhysicalAddress
     */
    public function setBusinessAddress($value)
    {
        $this->setProperty("BusinessAddress", $value, true);
    }
    /**
     * Other addresses for the contact.
     * @return PhysicalAddress
     */
    public function getOtherAddress()
    {
        return $this->getProperty("OtherAddress", new PhysicalAddress());
    }

    /**
     * Other addresses for the contact.
     *
     * @var PhysicalAddress
     * @return self
     */
    public function setOtherAddress($value)
    {
        $this->setProperty("OtherAddress", $value, true);
        return $this;
    }

    /**
     * @return ClientValueCollection
     */
    public function getEmailAddresses(){
        return $this->getProperty("EmailAddresses",new ClientValueCollection(EmailAddress::class));
    }

    /**
     * @param EmailAddress[] $values
     * @return Contact
     */
    public function setEmailAddresses($values){
        return $this->setProperty("EmailAddresses",
            ClientValueCollection::fromArray(EmailAddress::class,$values));
    }
}