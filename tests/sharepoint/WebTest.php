<?php

namespace Office365;

use Office365\SharePoint\PrincipalType;
use Office365\SharePoint\RoleAssignment;
use Office365\SharePoint\Web;


class WebTest extends SharePointTestCase
{

    public function testGetWebByAbsUrl()
    {
        $settings = include(__DIR__ . '/../../Settings.php');
        $pageAbsUrl = $settings["Url"] . "/sites/team/SitePages/Home.aspx";
        $result = Web::getWebUrlFromPageUrl(self::$context,$pageAbsUrl);
        self::$context->executeQuery();
        self::assertNotEmpty($result->getValue());
    }

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
                return  ($principal->getPrincipalType() === PrincipalType::SharePointGroup
                    || $principal->getPrincipalType() === PrincipalType::User);
            }
        );
        self::assertGreaterThanOrEqual(1,count($result));
    }
    
    public function testCreateWeb()
    {
        $targetWebUrl = "Workspace_" . date("Y-m-d") . rand(1,10000);
        $targetWeb = self::createWeb(self::$context,$targetWebUrl);
        $this->assertEquals($targetWebUrl,$targetWeb->getTitle());
        return $targetWeb;
    }

    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     * @return Web
     */
    public function testIfWebExist(Web $targetWeb)
    {
        $webTitle = $targetWeb->getTitle();
        $webs = self::$context->getWeb()->getWebs()->filter("Title eq '$webTitle'");
        self::$context->load($webs);
        self::$context->executeQuery();
        $this->assertEquals(1, $webs->getCount());
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
        $targetWeb->setTitle($webTitle);
        $targetWeb->update();
        $ctx->executeQuery();


        $webs = self::$context->getWeb()->getWebs()->filter("Title eq '$webTitle'");
        $ctx->load($webs);
        $ctx->executeQuery();
        $this->assertEquals(1,$webs->getCount());

        return $targetWeb;
    }


    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     */
    public function testAssignUniquePermissions(Web $targetWeb){
        $targetWeb->breakRoleInheritance(true);
        self::$context->executeQuery();


        $web = self::$context->getSite()->openWebById($targetWeb->getId());
        self::$context->executeQuery();
        self::assertTrue(true);
        self::assertNotNull($web->getResourcePath());
    }

    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     */
    public function testTryDeleteWeb(Web $targetWeb){
        $title = $targetWeb->getTitle();
        $targetWeb->deleteObject();
        self::$context->executeQuery();

        $webs = self::$context->getWeb()->getWebs()->filter("Title eq '$title'");
        self::$context->load($webs);
        self::$context->executeQuery();
        $this->assertEquals(0,$webs->getCount());
    }

}
