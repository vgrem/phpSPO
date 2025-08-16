<?php

namespace Office365\planner;


use Office365\Directory\Groups\Group;
use Office365\GraphTestCase;
use Office365\Planner\Plans\PlannerPlan;

class PlannerTest extends GraphTestCase
{
    /**
     * @var Group
     */
    private static $targetGroup;

    public static function setUpBeforeClass(): void
    {
        $grpName = "TestGroup_" . rand(1, 100000);
        parent::setUpBeforeClass();
        self::$targetGroup = self::$graphClient->getGroups()->createM365($grpName)->executeQuery();
    }

    public static function tearDownAfterClass(): void
    {
       self::$targetGroup->deleteObject()->executeQuery();
       parent::tearDownAfterClass();
    }

    public function testGetMyPlans()
    {
        $result = self::$graphClient->getMe()->getPlanner()->getPlans()->get()->executeQuery();
        self::assertNotNull($result->getResourcePath());
    }


    public function testGetMyTasks()
    {
        $result = self::$graphClient->getMe()->getPlanner()->getTasks()->get()->executeQuery();
        self::assertNotNull($result->getResourcePath());
    }

    /*public function testCreateGroupPlan()
    {
        $planTitle = "TestPlan_" . rand(1, 100000);
        $result = self::$targetGroup->getPlanner()->getPlans()->create($planTitle)->executeQuery();
        self::assertNotNull($result->getResourcePath());
        return $result;
    }*/

    public function testGetGroupPlans()
    {
        $result = self::$targetGroup->getPlanner()->getPlans()->get()->executeQuery();
        self::assertNotNull($result->getResourcePath());
    }

    /**
     * @depends testCreateGroupPlan
     * @param PlannerPlan $plan
     */
    /*public function testDeleteGroupPlan(PlannerPlan $plan)
    {
        $plan->deleteObject()->executeQuery();
    }*/

}