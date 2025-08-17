<?php

/**
 * Planner Plan and Task Report
 *
 * This script:
 * 1. Retrieves all Planner plans associated with the group
 * 2. Extracts all tasks for each plan with relevant details
 * 3. Returns structured JSON output containing plans with their tasks
 *
 * Required Permissions:
 * - Group.Read.All (to read group information)
 * - Tasks.Read.All (to read Planner tasks)
 *
 * Note: The service principal/app registration must have these permissions granted
 * with admin consent in the Azure AD portal.
 */


use Office365\GraphServiceClient;
use Office365\Planner\Plans\PlannerPlan;
use Office365\Planner\Tasks\PlannerTask;

require_once '../vendor/autoload.php';

$settings = include('../../tests/Settings.php');
$client = GraphServiceClient::withClientSecret($settings['TenantName'], $settings['ClientId'], $settings['ClientSecret']);

$groupName = "TestSharedGroup";

// 1. Get the specific group
$groups = $client->getGroups()
    ->filter("displayName eq '$groupName'")
    ->get()
    ->executeQuery();

if (count($groups->getData()) === 0) {
    throw new Exception("Group '$groupName' not found");
}


// 2. Get all plans in this group
$plans = $groups[0]->getPlanner()
    ->getPlans()
    ->get()
    ->executeQuery();

$allPlansWithTasks = [];

/** @var PlannerPlan $plan */
foreach ($plans as $plan) {
    try {
        // 3. Get all tasks for each plan
        $tasks = $plan->getTasks()
            ->get()
            ->executeQuery();

        $planData = [
            'plan_id' => $plan->getId(),
            'plan_title' => $plan->getTitle(),
            //'plan_created' => $plan->getOwner()->getCreatedDateTime(),
            'tasks' => []
        ];

        /** @var PlannerTask $task */
        foreach ($tasks as $task) {
            $planData['tasks'][] = [
                'task_id' => $task->getId(),
                'task_title' => $task->getTitle(),
                'assignments' => $task->getAssignments(),
                'created_date' => $task->getCreatedDateTime(),
                'completed_date' => $task->getCompletedDateTime(),
            ];
        }

        $allPlansWithTasks[] = $planData;

    } catch (\Exception $e) {
        echo "Error processing plan {$plan->getTitle()}: {$e->getMessage()}\n";
        continue;
    }
}

// Output the results
echo json_encode($allPlansWithTasks, JSON_PRETTY_PRINT);