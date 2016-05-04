<?php


namespace SharePoint\PHP\Client;

/**
 * Specifies properties that are used as parameters to initialize a new content type.
 */
class ContentTypeCreationInformation extends ClientValueObject
{
    /**
     * Gets or sets a value that specifies the description of the content type that will be constructed.
     * @var string
     */
    public $Description;


    /**
     * Gets or sets a value that specifies the content type group of the content type that will be constructed.
     * @var string
     */
    public $Group;


    /**
     * @var string
     */
    public $Id;


    /**
     * @var string
     */
    public $Name;


    /**
     * @var ContentType
     */
    public $ParentContentType;
}