<?php


namespace Office365\PHP\Client\SharePoint;
use Office365\PHP\Client\Runtime\ClientValueObject;

/**
 * Contains properties that are used as parameters to initialize a role definition.
 */
class RoleDefinitionCreationInformation extends ClientValueObject
{

    /**
     * @var string Gets or sets a value that specifies the name of the role definition.
     */
    public $Name;


    /**
     * @var string Gets or sets a value that specifies a description of the role definition.
     */
    public $Description;


    /**
     * @var integer Gets or sets a value that specifies the order in which roles are displayed.
     */
    public $Order;


    /**
     * @var BasePermissions Gets or sets a value that specifies the permissions for the role definition.
     */
    public $BasePermissions;

}
