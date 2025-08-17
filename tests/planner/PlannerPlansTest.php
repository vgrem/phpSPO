<?php

namespace Office365;


use Office365\Directory\Groups\Group;
use Office365\GraphTestCase;
use Office365\Planner\Plans\PlannerPlan;
use Office365\Runtime\Http\RequestException;

class PlannerPlansTest extends GraphTestCase
{



    public function testCreateUserPlan ()
    {
        $title = "TestUserPlan_" . rand(1, 100000);
        $user = self::$graphClient->getUsers()->getByUserPrincipalName(self::$settings['UserName']);
        $result = $user->getPlanner()->getPlans()->create($title)->executeQuery();
        self::assertNotNull($result->getResourcePath());
        return $result;
    }

    public function testListUserPlans()
    {
        $user = self::$graphClient->getUsers()->getByUserPrincipalName(self::$settings['UserName']);
        $result = $user->getPlanner()->getPlans()->get()->executeQuery();
        self::assertNotNull($result->getResourcePath());
    }

    /**
     * @depends testCreateUserPlan
     * @param PlannerPlan $plan
     */
    public function testGetUserPlan(PlannerPlan $plan)
    {
        $result = $plan->getDetails()->get()->executeQuery();
        self::assertNotNull($result->getResourcePath());
    }

    /**
     * @depends testCreateUserPlan
     * @param PlannerPlan $plan
     */
    public function testDeleteUserPlan(PlannerPlan $plan)
    {
        $plan->deleteObject()->executeQuery();

        $this->expectException(RequestException::class);
        $this->expectExceptionCode(404);
        $plan->get()->executeQuery();
    }

}