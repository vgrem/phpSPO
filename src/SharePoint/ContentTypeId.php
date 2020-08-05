<?php


namespace Office365\SharePoint;
use Office365\Runtime\ClientValue;

/**
 * Represents the content type identifier (ID) of a content type.
 */
class ContentTypeId extends ClientValue
{

    /**
     * @var string A string of hex characters that represents the content type ID.
     */
    public $StringValue;

}