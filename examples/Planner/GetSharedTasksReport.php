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


use Office365\GraphServiceClient;
use Office365\Planner\Plans\PlannerPlan;
use Office365\Planner\Tasks\PlannerTask;

require_once '../vendor/autoload.php';

$settings = include('../../tests/Settings.php');
$client = GraphServiceClient::withClientSecret($settings['TenantName'], $settings['ClientId'], $settings['ClientSecret']);


// 1. Get the specific group
$groups = $client->getGroups()
    ->filter("displayName eq 'PlanGroup'")
    ->get()
    ->executeQuery();

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