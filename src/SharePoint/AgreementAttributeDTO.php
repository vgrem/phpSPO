<?php

/**
 * Generated  2024-10-28T18:15:51+00:00 16.0.25409.12005
 */
namespace Office365\SharePoint;

use Office365\Runtime\ClientValue;
class AgreementAttributeDTO extends ClientValue
{
    /**
     * @var string
     */
    public $ReviewId;
    /**
     * @var string
     */
    public $ReviewSubmissionDate;
    /**
     * @var string
     */
    public $ReviewCompleteDate;
    /**
     * @var UserDTO
     */
    public $Reviewer;
    /**
     * @var string
     */
    public $ReviewStartDate;
    /**
     * @var integer
     */
    public $State;
}