<?php

/**
 * Generated  2024-03-17T10:39:33+00:00 16.0.24628.12008
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class UpdateAgreementESignConfigPayload extends ClientValue
{
    /**
     * @var string
     */
    public $AgreementId;
    /**
     * @var string
     */
    public $AgreementUrl;
    /**
     * @var string
     */
    public $DocumentId;
    /**
     * @var string
     */
    public $eSignStatus;
    /**
     * @var string
     */
    public $RequestorEmail;
    /**
     * @var array
     */
    public $SignersEmail;
}