<?php


namespace SharePoint\PHP\Client;

/**
 * Represents the content type identifier (ID) of a content type.
 */
class ContentTypeId extends ClientValueObject
{

    /**
     * @var string A string of hex characters that represents the content type ID.
     */
    public $StringValue;

}