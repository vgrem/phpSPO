<?php


namespace Office365\SharePoint;
use Office365\Runtime\ClientValue;

/**
 * Contains properties that are used as parameters to initialize a role definition.
 */
class RoleDefinitionCreationInformation extends ClientValue
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
