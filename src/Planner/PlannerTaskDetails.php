<?php

/**
 * Modified: 2020-05-26T22:12:31+00:00 
 */
namespace Office365\Planner;

use Office365\Entity;

/**
 * The **plannerTaskDetails** resource represents the additional information about a task. Each [task](plannertask.md) object has a details object.
 */
class PlannerTaskDetails extends Entity
{
    /**
     * Description of the task
     * @return string
     */
    public function getDescription()
    {
        if (!$this->isPropertyAvailable("Description")) {
            return null;
        }
        return $this->getProperty("Description");
    }
    /**
     * Description of the task
     * @var string
     */
    public function setDescription($value)
    {
        $this->setProperty("Description", $value, true);
    }
    /**
     * The collection of references on the task.
     * @return PlannerExternalReferences
     */
    public function getReferences()
    {
        if (!$this->isPropertyAvailable("References")) {
            return null;
        }
        return $this->getProperty("References");
    }
    /**
     * The collection of references on the task.
     * @var PlannerExternalReferences
     */
    public function setReferences($value)
    {
        $this->setProperty("References", $value, true);
    }
    /**
     * The collection of checklist items on the task.
     * @return PlannerChecklistItems
     */
    public function getChecklist()
    {
        if (!$this->isPropertyAvailable("Checklist")) {
            return null;
        }
        return $this->getProperty("Checklist");
    }
    /**
     * The collection of checklist items on the task.
     * @var PlannerChecklistItems
     */
    public function setChecklist($value)
    {
        $this->setProperty("Checklist", $value, true);
    }
}