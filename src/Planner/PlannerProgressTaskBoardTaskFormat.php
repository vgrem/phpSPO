<?php

/**
 * Modified: 2020-05-26T22:10:14+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;

/**
 * The **plannerProgressTaskBoardTaskFormat** resource represents the information used to render a task correctly in the Progress view of the Task Board (a view organized by the state of the PercentComplete field on the task object, with columns for Not Started, In Progress and Complete). Each [task](plannertask.md) will have one **plannerProgressTaskBoardTaskFormat** object associated with it.
 */
class PlannerProgressTaskBoardTaskFormat extends Entity
{
    /**
     * Hint value used to order the task on the Progress view of the Task Board. The format is defined as outlined [here](planner-order-hint-format.md).
     * @return string
     */
    public function getOrderHint()
    {
        return $this->getProperty("OrderHint");
    }

    /**
     * Hint value used to order the task on the Progress view of the Task Board. The format is defined as outlined [here](planner-order-hint-format.md).
     *
     * @return self
     * @var string
     */
    public function setOrderHint($value)
    {
        return $this->setProperty("OrderHint", $value, true);
    }
}