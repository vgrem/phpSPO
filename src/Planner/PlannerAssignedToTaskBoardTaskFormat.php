<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;

/**
 * The **plannerAssignedToTaskBoardTaskFormat** resource represents the information used to render a task correctly in the AssignedTo view of the Task Board (a view organized by users to whom tasks are assigned to). Each [task](plannertask.md) will have one **plannerAssignedToTaskBoardTaskFormat** object associated with it.
 */
class PlannerAssignedToTaskBoardTaskFormat extends Entity
{
    /**
     * Hint value used to order the task on the AssignedTo view of the Task Board when the task is not assigned to anyone, or if the orderHintsByAssignee dictionary does not provide an order hint for the user the task is assigned to. The format is defined as outlined [here](planner-order-hint-format.md).
     * @return string
     */
    public function getUnassignedOrderHint()
    {
        return $this->getProperty("UnassignedOrderHint");
    }
    /**
     * Hint value used to order the task on the AssignedTo view of the Task Board when the task is not assigned to anyone, or if the orderHintsByAssignee dictionary does not provide an order hint for the user the task is assigned to. The format is defined as outlined [here](planner-order-hint-format.md).
     * @var string
     */
    public function setUnassignedOrderHint($value)
    {
        $this->setProperty("UnassignedOrderHint", $value, true);
    }
    /**
     * Dictionary of hints used to order tasks on the AssignedTo view of the Task Board. The key of each entry is one of the users the task is assigned to and the value is the order hint. The format of each value is defined as outlined [here](planner-order-hint-format.md).
     * @return PlannerOrderHintsByAssignee
     */
    public function getOrderHintsByAssignee()
    {
        return $this->getProperty("OrderHintsByAssignee", new PlannerOrderHintsByAssignee());
    }
    /**
     * Dictionary of hints used to order tasks on the AssignedTo view of the Task Board. The key of each entry is one of the users the task is assigned to and the value is the order hint. The format of each value is defined as outlined [here](planner-order-hint-format.md).
     * @var PlannerOrderHintsByAssignee
     */
    public function setOrderHintsByAssignee($value)
    {
        $this->setProperty("OrderHintsByAssignee", $value, true);
    }
}