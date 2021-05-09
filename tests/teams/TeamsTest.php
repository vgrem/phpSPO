<?php

namespace Office365;


class TeamsTest extends GraphTestCase
{

    public function testGetJoinedTeams(){
        $myTeams = self::$graphClient->getMe()->getJoinedTeams()->get()->executeQuery();
        self::assertNotNull($myTeams->getResourcePath());
    }

    public function testCreateTeam(){

    }

    public function testDeleteTeam(){

    }

}