<?php

require_once('SharePointTestCase.php');
require_once('TestUtilities.php');




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


        $users = array_filter(
            $assignments->getData(),
            function (\SharePoint\PHP\Client\RoleAssignment $assignment)  {
                $principal = $assignment->getMember();
                return  $principal->getProperty("PrincipalType") === \SharePoint\PHP\Client\PrincipalType::User;
            }
        );
        //todo
    }
    
    public function testCreateWeb()
    {
        $targetWebUrl = "Workspace_" . date("Y-m-d") . rand(1,10000);
        $targetWeb = TestUtilities::createWeb(self::$context,$targetWebUrl);
        $this->assertEquals($targetWeb->getProperty('Title'),$targetWebUrl);
        return $targetWeb;
    }

    /**
     * @depends testCreateWeb
     * @param \SharePoint\PHP\Client\Web $targetWeb
     * @return \SharePoint\PHP\Client\Web
     */
    public function testIfWebExist(\SharePoint\PHP\Client\Web $targetWeb)
    {
        $ctx = $targetWeb->getContext();
        $webTitle = $targetWeb->getProperty('Title');
        $webs = $ctx->getWeb()->getWebs()->filter("Title eq '$webTitle'");
        $ctx->load($webs);
        $ctx->executeQuery();
        $this->assertCount(1,$webs->getData());
        return $targetWeb;
    }


    /**
     * @depends testCreateWeb
     * @param \SharePoint\PHP\Client\Web $targetWeb
     * @return \SharePoint\PHP\Client\Web
     */
    public function testUpdateWeb(\SharePoint\PHP\Client\Web $targetWeb)
    {
        $ctx = $targetWeb->getContext();
        $targetWeb->setProperty("Description",$targetWeb->getProperty("Title"));
        $targetWeb->update();
        $ctx->executeQuery();

        /*$key = $targetWeb->getProperty("Description");
        $webs = $ctx->getWeb()->getWebs()->filter("Description eq '$key'");
        $ctx->load($webs);
        $ctx->executeQuery();
        $this->assertCount(1,$webs->getData());*/

        return $targetWeb;
    }

    /**
     * @depends testCreateWeb
     * @param \SharePoint\PHP\Client\Web $targetWeb
     */
    public function testTryDeleteWeb(\SharePoint\PHP\Client\Web $targetWeb){
        $title = $targetWeb->getProperty("Title");
        $ctx = $targetWeb->getContext();
        $targetWeb->deleteObject();
        $ctx->executeQuery();

        $webs = $ctx->getWeb()->getWebs()->filter("Title eq '$title'");
        $ctx->load($webs);
        $ctx->executeQuery();
        $this->assertCount(0,$webs->getData());
    }


}
