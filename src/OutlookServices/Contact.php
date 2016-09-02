<?php

namespace Office365\PHP\Client\OutlookServices;


/**
 * A contact, which is an item in Outlook for users to organize and save information about the people and organizations
 * that they communicate with. Contacts are contained in contact folders.
 */
class Contact extends OutlookEntity
{

    /**
     * The contact's unique identifier.
     * @var string
     */
    public $Id;

    /**
     * The ID of the contact's parent folder.
     * @var string
     */
    public $ParentFolderId;


    /**
     * The contact's birthday.
     * @var string
     */
    public $Birthday;


    /**
     * The contact's given name.
     * @var string
     */
    public $GivenName;


    /**
     * The contact's initials.
     * @var string
     */
    public $Initials;


    /**
     * The contact's surname.
     * @var string
     */
    public $Surname;


    /**
     * The contact's job title.
     * @var string
     */
    public $JobTitle;


    /**
     * @var string
     */
    public $Department;


    /**
     * @var array
     */
    public $BusinessPhones;


    /**
     * @var string
     */
    public $MobilePhone1;


    /**
     * @var array
     */
    public $EmailAddresses;


}