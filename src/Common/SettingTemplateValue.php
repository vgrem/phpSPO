<?php

/**
 * Modified: 2020-05-24T22:10:26+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class SettingTemplateValue extends ClientValue
{
    /**
     * @var string
     */
    public $Name;
    /**
     * @var string
     */
    public $Type;
    /**
     * @var string
     */
    public $DefaultValue;
    /**
     * @var string
     */
    public $Description;
}