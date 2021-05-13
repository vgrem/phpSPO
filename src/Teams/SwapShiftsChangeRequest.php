<?php

/**
 * Modified: 2020-05-29T07:19:37+00:00
 */
namespace Office365\Teams;

use Office365\Entity;


/**
 * Represents a type of shift request to swap a [shift](../resources/shift.md) with another user in the [team](../resources/team.md).
 */
class SwapShiftsChangeRequest extends Entity
{
    /**
     * ShiftId for the recipient user with whom the request is to swap.
     * @return string
     */
    public function getRecipientShiftId()
    {
        if (!$this->isPropertyAvailable("RecipientShiftId")) {
            return null;
        }
        return $this->getProperty("RecipientShiftId");
    }
    /**
     * ShiftId for the recipient user with whom the request is to swap.
     * @var string
     */
    public function setRecipientShiftId($value)
    {
        $this->setProperty("RecipientShiftId", $value, true);
    }
}