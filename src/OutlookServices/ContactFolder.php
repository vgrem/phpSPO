<?php

namespace Office365\OutlookServices;



/**
 * A folder that contains contacts.
 * @package Office365\Outlook
 */
class ContactFolder extends OutlookEntity
{
    /**
     * The collection of child folders in the folder. Navigation property.
     * @var array
     */
    public $ChildFolders;


    /**
     * The contacts in the folder. Navigation property.
     * @var array
     */
    public $Contacts;


    /**
     * The folder's display name.
     * @var string
     */
    public $DisplayName;


    /**
     * The ID of the folder's parent folder.
     * @var string
     */
    public $ParentFolderId;


}