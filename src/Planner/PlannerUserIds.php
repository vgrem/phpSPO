<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Planner;

use Office365\Runtime\ClientValue;
class PlannerUserIds extends ClientValue
{

    /**
     * Checks if the object is empty (has no GUIDs set)
     * @return bool
     */
    public function isEmpty(): bool
    {
        foreach ($this as $value) {
            if ($value === true) {
                return false;
            }
        }
        return true;
    }

    /**
     * Returns array of all User Ids
     * @return array
     */
    public function getIds(): array
    {
        $guids = [];
        foreach ($this as $guid => $value) {
            if ($value === true) {
                $guids[] = $guid;
            }
        }
        return $guids;
    }
}