<?php

namespace Office365;

use Office365\SharePoint\PrincipalType;
use Office365\SharePoint\RoleAssignment;
use Office365\SharePoint\Web;
use Office365\SharePoint\WebCreationInformation;


class WebTest extends SharePointTestCase
{

    public function testGetWebByAbsUrl()
    {
        $pageAbsUrl = self::$settings["Url"] . "/sites/team/SitePages/Home.aspx";
        $result = Web::getWebUrlFromPageUrl(self::$context,$pageAbsUrl)->executeQuery();
        self::assertNotEmpty($result->getValue());
    }

    public function testGetWebGroups()
    {
        $groups = self::$context->getWeb()->getRoleAssignments()->getGroups()->get()->executeQuery();
        self::assertNotEmpty($groups->getData());
    }

    public function testGetWebUsers()
    {
        $assignments = self::$context->getWeb()->getRoleAssignments()
            ->expand("Member")
            ->get()
            ->executeQuery();

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
        $info = new WebCreationInformation($targetWebUrl,$targetWebUrl);
        $targetWeb = self::$context->getWeb()->getWebs()->add($info)->executeQuery();
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
        $webs = self::$context->getWeb()->getWebs()
            ->filter("Title eq '$webTitle'")
            ->get()
            ->executeQuery();
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
        $webTitle = self::createUniqueName("WS_Updated");
        $targetWeb->setTitle($webTitle)->update()->executeQuery();

        $webs = self::$context->getWeb()->getWebs()
            ->filter("Title eq '$webTitle'")
            ->get()
            ->executeQuery();
        $this->assertEquals(1,$webs->getCount());

        return $targetWeb;
    }


    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     */
    public function testAssignUniquePermissions(Web $targetWeb)
    {
        $targetWeb
            ->breakRoleInheritance(true)
            ->executeQuery();

        $result = $targetWeb->select(["HasUniqueRoleAssignments"])->get()->executeQuery();
        self::assertTrue($result->getHasUniqueRoleAssignments());
    }

    /**
     * @depends testCreateWeb
     * @param Web $targetWeb
     */
    public function testTryDeleteWeb(Web $targetWeb){
        $title = $targetWeb->getTitle();
        $targetWeb->deleteObject()->executeQuery();

        $webs = self::$context->getWeb()->getWebs()
            ->filter("Title eq '$title'")
            ->get()
            ->executeQuery();
        $this->assertEquals(0,$webs->getCount());
    }

}
