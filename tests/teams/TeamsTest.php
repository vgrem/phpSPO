<?php

namespace Office365;


use Office365\Directory\Users\User;
use Office365\Runtime\Http\RequestException;
use Office365\Teams\Team;
use Office365\Teams\TeamGuestSettings;

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
     * @return Team
     * @throws \Exception
     */
    public function testGetTeam(Team $team)
    {
        /** @var Team $team */
        $team = self::$graphClient->getTeams()->getById($team->getId())->get()->executeQueryRetry();
        self::assertNotNull($team->getResourcePath());
        self::assertInstanceOf(Team::class, $team);
        return $team;
    }

    /**
     * @depends testGetTeam
     * @param Team $team
     * @throws \Exception
     */
    public function testUpdateTeam(Team $team)
    {
        $settings = new TeamGuestSettings();
        $settings->AllowDeleteChannels = true;
        $team->setGuestSettings($settings)->update()->executeQuery();
        self::assertNotNull($team->getResourcePath());
    }

    /**
     * @depends testGetTeam
     * @param Team $team
     * @throws \Exception
     */
    public function testAddTeamMember(Team $team)
    {
        /** @var User $user */
        $user = self::$graphClient->getUsers()->getById(self::$testAccountName);
        $member = $team->addMember($user, ["owner"])->executeQuery();
        self::assertNotNull($member->getResourcePath());
        return $member;
    }

    /**
     * @depends testGetTeam
     * @param Team $team
     * @throws \Exception
     */
    public function testListTeamMembers(Team $team)
    {
        $members = $team->getMembers()->get()->executeQueryRetry(3,5);
        self::assertNotNull($members->getResourcePath());
    }

    /**
     * @depends testAddTeamMember
     * @param Entity $member
     * @throws \Exception
     */
    public function testRemoveTeamMember(Entity $member)
    {
        $member->deleteObject()->executeQuery();
    }

    /**
     * @depends testGetTeam
     * @param Team $team
     * @throws \Exception
     */
    public function testDeleteTeam(Team $team)
    {
        $deletedId = $team->getId();
        $team->deleteObject()->executeQueryRetry();
        try {
            self::$graphClient->getGroups()->getById($deletedId)->get()->executeQuery();
        }
        catch (RequestException $ex){
            self::assertEquals(404, $ex->getCode());
        }
    }

}