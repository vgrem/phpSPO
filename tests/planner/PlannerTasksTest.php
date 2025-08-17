<?php

namespace Office365;


use Office365\Directory\Groups\Group;
use Office365\GraphTestCase;
use Office365\Planner\Plans\PlannerPlan;
use Office365\Runtime\Http\RequestException;

class PlannerTasksTest extends GraphTestCase
{

    /**
     * @var PlannerPlan
     */
    private static $targetPlan;

    public static function setUpBeforeClass(): void
    {
        $title = "TestPlan_" . rand(1, 100000);
        parent::setUpBeforeClass();
        $currentUser = self::$graphClient->getUsers()->getByUserPrincipalName(self::$settings['UserName']);
        self::$targetPlan = $currentUser->getPlanner()->getPlans()->create($title)->executeQuery();
    }

    public static function tearDownAfterClass(): void
    {
        self::$targetPlan->deleteObject()->executeQuery();
        parent::tearDownAfterClass();
    }

    public function testCreateMyTask()
    {
        $result =  self::$targetPlan->getTasks()->create("Update client list")->executeQuery();
        self::assertNotNull($result->getResourcePath());
    }


    public function testGetMyTasks()
    {
        $result = self::$targetPlan->getTasks()->get()->executeQuery();
        self::assertNotNull($result->getResourcePath());
        self::assertNotEmpty($result->getData());
    }

}