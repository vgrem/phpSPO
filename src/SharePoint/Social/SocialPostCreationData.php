<?php

/**
 * Updated By PHP Office365 Generator 2019-10-12T19:41:09+00:00 16.0.19402.12016
 */
namespace Office365\PHP\Client\SharePoint\Social;

use Office365\PHP\Client\Runtime\ClientValueObject;

class SocialPostCreationData extends ClientValueObject
{
    /**
     * @var SocialAttachment
     */
    public $Attachment;
    /**
     * @var array
     */
    public $ContentItems;
    /**
     * @var string
     */
    public $ContentText;
    
    public $DefinitionData;
    /**
     * @var array
     */
    public $SecurityUris;
    
    public $Source;
    /**
     * @var bool
     */
    public $UpdateStatusText;
}
