<?php

/**
 * Modified: 2020-05-24T21:39:44+00:00
 */
namespace Office365\Common;

use Office365\Runtime\ClientValue;
class AppliedConditionalAccessPolicy extends ClientValue
{
    /**
     * @var string
     */
    public $Id;
    /**
     * @var string
     */
    public $DisplayName;
    /**
     * @var array
     */
    public $EnforcedGrantControls;
    /**
     * @var array
     */
    public $EnforcedSessionControls;
}