<?php

namespace Office365\planner;


use Office365\GraphTestCase;

class PlannerTest extends GraphTestCase
{


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



}