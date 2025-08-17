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

require_once '../vendor/autoload.php';

$settings = include('../../tests/Settings.php');
$client = GraphServiceClient::withClientSecret($settings['TenantName'], $settings['ClientId'], $settings['ClientSecret']);

# 1. Get all Microsoft 365 groups (that might contain plans)
$groups = $client->getGroups()->get()->top(10)->filter("groupTypes/any(c:c eq 'Unified')")->executeQuery();

/** @var Group $grp */
foreach ($groups as $grp) {
    echo sprintf("\nProcessing group: %s \n", $grp->getProperty("DisplayName"));
    $plans = $grp->getPlanner()->getPlans()->get()->executeQuery();

    /** @var PlannerPlan $plan */
    foreach ($plans as $plan) {
        echo sprintf("\tPlan: %s \n", $plan->getProperty("Title"));
    }
}



