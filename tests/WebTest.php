<?php

use Office365\PHP\Client\SharePoint\PrincipalType;
use Office365\PHP\Client\SharePoint\RoleAssignment;
use Office365\PHP\Client\SharePoint\Web;


class WebTest extends SharePointTestCase
{

    public function testGetWebGroups()
    {
        $groups = self::$context->getWeb()->getRoleAssignments()->getGroups();
        self::$context->load($groups);
        self::$context->executeQuery();

        self::assertNotEmpty($groups->getData());
    }

    public function testGetWebUsers()
    {
        $assignments = self::$context->getWeb()->getRoleAssignments()->expand("Member");
        self::$context->load($assignments);
        self::$context->executeQuery();


        $result = array_filter(
            $assignments->getData(),
            function (RoleAssignment $assignment)  {
                $principal = $assignment->getMember();
                return  ($principal->getProperty("PrincipalType") === PrincipalType::SharePointGroup
                    || $principal->getProperty("PrincipalType") === PrincipalType::User);
            }
        );
        self::assertGreaterThanOrEqual(1,count($result));
    }
    
    public function testCreateWeb()
    {
        $targetWebUrl = "Workspace_" . date("Y-m-d") . rand(1,10000);
        $targetWeb = self::createWeb(self::$context,$targetWebUrl);
        $this->assertEquals($targetWebUrl,$targetWeb->getProperty('Title'));
        return $targetWeb;
    }

    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     * @return Web
     */
    public function testIfWebExist(Web $targetWeb)
    {
        $webTitle = $targetWeb->getProperty('Title');
        $webs = self::$context->getWeb()->getWebs()->filter("Title eq '$webTitle'");
        self::$context->load($webs);
        self::$context->executeQuery();
        $this->assertCount(1,$webs->getData());
        return $targetWeb;
    }


    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     * @return Web
     */
    public function testUpdateWeb(Web $targetWeb)
    {
        $ctx = $targetWeb->getContext();
        $webTitle = self::createUniqueName("WS_Updated");
        $targetWeb->setProperty("Title",$webTitle);
        $targetWeb->update();
        $ctx->executeQuery();


        $webs = self::$context->getWeb()->getWebs()->filter("Title eq '$webTitle'");
        $ctx->load($webs);
        $ctx->executeQuery();
        $this->assertCount(1,$webs->getData());

        return $targetWeb;
    }


    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     */
    public function testAssignUniquePermissions(Web $targetWeb){
        $targetWeb->breakRoleInheritance(true);
        self::$context->executeQuery();


        $web = self::$context->getSite()->openWebById($targetWeb->getProperty("Id"));
        self::$context->executeQuery();
        self::assertTrue(true);
    }

    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     */
    public function testTryDeleteWeb(Web $targetWeb){
        $title = $targetWeb->getProperty("Title");
        $targetWeb->deleteObject();
        self::$context->executeQuery();

        $webs = self::$context->getWeb()->getWebs()->filter("Title eq '$title'");
        self::$context->load($webs);
        self::$context->executeQuery();
        $this->assertCount(0,$webs->getData());
    }

}
