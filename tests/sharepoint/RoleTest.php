<?php

namespace Office365;

use Office365\SharePoint\ListTemplateType;
use Office365\SharePoint\RoleAssignment;
use Office365\SharePoint\RoleDefinition;

class RoleTest extends SharePointTestCase
{

    private static $securedTargetObject;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        $listTitle = "Documents_" . rand(1, 100000);
        self::$securedTargetObject = self::ensureList(self::$context->getWeb(), $listTitle, ListTemplateType::DocumentLibrary);
    }

    public static function tearDownAfterClass(): void
    {
        self::$securedTargetObject->deleteObject()->executeQuery();
        parent::tearDownAfterClass();
    }

    public function testSetUniquePerms()
    {
        self::$securedTargetObject->breakRoleInheritance(false)->executeQuery();

        self::$context->load(self::$securedTargetObject,["HasUniqueRoleAssignments"]);
        self::$context->executeQuery();
        $value = self::$securedTargetObject->getHasUniqueRoleAssignments();
        self::assertTrue($value);
    }

    /**
     * @depends testSetUniquePerms
     */
    public function testGetRoleDefinition()
    {
        $roleName = "Edit";
        $roleDef = self::$context->getWeb()->getRoleDefinitions()->getByName($roleName); //get role definition by name
        self::$context->load($roleDef);
        self::$context->executeQuery();
        self::assertNotNull($roleDef);
        self::assertEquals($roleDef->getProperty("Name"),$roleName);
        return $roleDef;
    }

    /**
     * @depends testGetRoleDefinition
     * @param RoleDefinition $targetRole
     * @return RoleAssignment
     */
    public function  testAddRoleAssignment(RoleDefinition $targetRole){
        $users = self::$context->getWeb()->getSiteUsers()->filter("Title eq 'Jon Doe'")->get()->executeQuery();
        self::assertGreaterThanOrEqual(1,$users->getCount());

        self::$securedTargetObject->getRoleAssignments()->addRoleAssignment($users->getItem(0)->getProperty("Id"),$targetRole->getProperty("Id"));
        self::$context->executeQuery();

        $roleAssignment = self::$securedTargetObject->getRoleAssignments()->getByPrincipalId($users->getItem(0)->getProperty("Id"));
        self::$context->load($roleAssignment);
        self::$context->executeQuery();
        self::assertNotNull($roleAssignment);
        return $roleAssignment;
    }

    /**
     * @depends testAddRoleAssignment
     * @param RoleAssignment $roleAssignment
     */
    public function  testRemoveRoleAssignment(RoleAssignment $roleAssignment)
    {
        $roleDef = self::$context->getWeb()->getRoleDefinitions()->getByName("Edit"); //get role definition by name
        self::$context->load($roleDef);
        $roleAssignmentsBefore = self::$securedTargetObject->getRoleAssignments()->get()->executeQuery();
        self::assertNotNull($roleDef);

        $rolesCount = $roleAssignmentsBefore->getCount();
        self::$securedTargetObject->getRoleAssignments()->removeRoleAssignment($roleAssignment->getPrincipalId(),$roleDef->getProperty("Id"));
        self::$context->executeQuery();

        $roleAssignmentsAfter = self::$securedTargetObject->getRoleAssignments()->get()->executeQuery();
        self::assertEquals($roleAssignmentsAfter->getCount(),$rolesCount -1);
    }

}
