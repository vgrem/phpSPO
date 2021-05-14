<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\OneDrive;

use Office365\Runtime\ClientValue;
class ResourceVisualization extends ClientValue
{
    /**
     * @var string
     */
    public $Title;
    /**
     * @var string
     */
    public $Type;
    /**
     * @var string
     */
    public $MediaType;
    /**
     * @var string
     */
    public $PreviewImageUrl;
    /**
     * @var string
     */
    public $PreviewText;
    /**
     * @var string
     */
    public $ContainerWebUrl;
    /**
     * @var string
     */
    public $ContainerDisplayName;
    /**
     * @var string
     */
    public $ContainerType;
}