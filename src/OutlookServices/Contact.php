<?php

namespace Office365\PHP\Client\OutlookServices;
use Office365\PHP\Client\Runtime\ClientActionDeleteEntity;
use Office365\PHP\Client\Runtime\ClientActionUpdateEntity;
use Office365\PHP\Client\Runtime\ClientObject;


/**
 * A contact, which is an item in Outlook for users to organize and save information about the people and organizations
 * that they communicate with. Contacts are contained in contact folders.
 */
class Contact extends ClientObject
{

    public function deleteObject()
    {
        $qry = new ClientActionDeleteEntity($this);
        $this->getContext()->addQuery($qry);
    }


    /**
     * Updates a Contact resource
     */
    public function update()
    {
        $qry = new ClientActionUpdateEntity($this);
        $this->getContext()->addQuery($qry);
    }


    /**
     * @var string
     */
    public $ParentFolderId;


    /**
     * @var string
     */
    public $Birthday;


    /**
     * @var string
     */
    public $GivenName;


    /**
     * @var string
     */
    public $Initials;


    /**
     * @var string
     */
    public $Surname;


    /**
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