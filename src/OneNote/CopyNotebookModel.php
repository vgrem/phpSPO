<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\OneNote;

use Office365\Common\IdentitySet;
use Office365\Runtime\ClientValue;
class CopyNotebookModel extends ClientValue
{
    /**
     * @var bool
     */
    public $IsDefault;
    /**
     * @var bool
     */
    public $IsShared;
    /**
     * @var string
     */
    public $SectionsUrl;
    /**
     * @var string
     */
    public $SectionGroupsUrl;
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $CreatedBy;
    /**
     * @var IdentitySet
     */
    public $CreatedByIdentity;
    /**
     * @var string
     */
    public $LastModifiedBy;
    /**
     * @var IdentitySet
     */
    public $LastModifiedByIdentity;
    /**
     * @var string
     */
    public $Id;
    /**
     * @var string
     */
    public $Self;
    /**
     * @var NotebookLinks
     */
    public $Links;
}