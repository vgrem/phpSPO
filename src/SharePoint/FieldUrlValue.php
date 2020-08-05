<?php
/**
 * Specifies the hyperlink and the description values for FieldURL.
 */

namespace Office365\SharePoint;


use Office365\Runtime\ClientValue;

class FieldUrlValue extends ClientValue
{

    /**
     * Specifies the URI.
     * @var string
     */
    public $Url;

    /**
     * Gets or sets a value that specifies the description for the URI.
     * @var string
     */
    public $Description;

}