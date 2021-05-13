<?php

/**
 * Modified: 2020-05-24T21:37:20+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class ModifiedProperty extends ClientValue
{
    /**
     * @var string
     */
    public $DisplayName;
    /**
     * @var string
     */
    public $OldValue;
    /**
     * @var string
     */
    public $NewValue;
}