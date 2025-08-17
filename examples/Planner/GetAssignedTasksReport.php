<?php

/**
 *
 * Description:
 * - List all groups containing Planner plans
 * - Identify plans accessible to the specific group
 * - Extract all tasks from qualifying plans
 *
 * Permissions:
 * Accessing group plans requires both Group.Read.All and Tasks.Read.All permissions.
 */


use Office365\Directory\Groups\Group;
use Office365\GraphServiceClient;
use Office365\Planner\Plans\PlannerPlan;
use Office365\Planner\Tasks\PlannerTask;

require_once '../vendor/autoload.php';

$settings = include('../../tests/Settings.php');
$client = GraphServiceClient::withClientSecret($settings['TenantName'], $settings['ClientId'], $settings['ClientSecret']);

# 1. Get all Microsoft 365 groups (that might contain plans)
$groups = $client->getGroups()->get()->top(10)->filter("groupTypes/any(c:c eq 'Unified')")->executeQuery();

/** @var Group $grp */
foreach ($groups as $grp) {
    $groupName = $grp->getProperty("DisplayName");
    echo "\nChecking group: {$groupName}\n";

    $plans = $grp->getPlanner()->getPlans()->get()->executeQuery();

    /** @var PlannerPlan $plan */
    foreach ($plans as $plan) {
        $planName = $plan->getProperty("Title");
        echo "  - Plan: {$planName}\n";

        // Get all tasks in this plan
        $tasks = $plan->getTasks()->get()->executeQuery();

        /** @var PlannerTask $task */
        foreach ($tasks as $task) {
            $assignments = $task->getAssignments();

            // Check each assignment to see if it matches our target users
            foreach ($assignments as $userId => $assignment) {

                echo "  - Assignment: {$userId}\n";

            }
        }



    }
}



