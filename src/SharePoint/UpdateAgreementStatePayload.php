<?php

/**
 * Generated  2024-02-24T10:21:51+00:00 16.0.24607.12008
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class UpdateAgreementStatePayload extends ClientValue
{
    /**
     * @var string
     */
    public $AgreementUrl;
    /**
     * @var integer
     */
    public $CurrentState;
    /**
     * @var integer
     */
    public $NextState;
}