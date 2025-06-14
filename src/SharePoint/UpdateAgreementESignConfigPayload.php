<?php

/**
 * Generated  2025-06-14T08:50:37+00:00 16.0.26121.12017
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
    /**
     * @var bool
     */
    public $MoveStateToInESign;
}