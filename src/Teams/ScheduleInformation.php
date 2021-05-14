<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Teams;

use Office365\Common\WorkingHours;
use Office365\Runtime\ClientValue;
class ScheduleInformation extends ClientValue
{
    /**
     * @var string
     */
    public $ScheduleId;
    /**
     * @var string
     */
    public $AvailabilityView;
    /**
     * @var WorkingHours
     */
    public $WorkingHours;
    /**
     * @var FreeBusyError
     */
    public $Error;
}