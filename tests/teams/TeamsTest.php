<?php

namespace Office365;


use Office365\Teams\Team;

class TeamsTest extends GraphTestCase
{

    public function testGetJoinedTeams()
    {
        $myTeams = self::$graphClient->getMe()->getJoinedTeams()->get()->executeQuery();
        self::assertNotNull($myTeams->getResourcePath());
    }

    public function testGetAllTeams()
    {
        $teams = self::$graphClient->getTeams()->getAll(array("displayName"))->executeQuery();
        self::assertNotNull($teams->getResourcePath());
    }

    public function testCreateTeam()
    {
        $teamName = self::createUniqueName("Team");
        $newTeam = self::$graphClient->getTeams()->add($teamName)->executeQuery();
        self::assertNotNull($newTeam->getResourcePath());
        return $newTeam;
    }

    /**
     * @depends testCreateTeam
     * @param Team $team
     * @throws \Exception
     */
    public function testDeleteTeam(Team $team)
    {
        $teamToDel = $team->get()->executeQueryRetry();
        $teamToDel->deleteObject()->executeQuery();
    }

}