<?php


namespace Office365\SharePoint;

/**
 * Specifies the types of roles that are available for users and groups.
 */
class RoleType
{
    /**
     * Enumeration whose values specify that there are no rights on the Web site.
     */
    const None = 0;

    /**
     * Has limited rights to view pages and specific page elements.
     * This role is used to give users access to a particular page, list, or item in a list,
     * without granting rights to view the entire site. Users cannot be added explicitly to the Guest role;
     * users who are given access to lists or document libraries by way of per-list permissions are added automatically
     * to the Guest role. The Guest role cannot be customized or deleted.
     */
    const Guest = 1;


    /**
     * Has rights to view items, personalize Web parts, use alerts,
     * and create a top-level Web site using Self-Service Site Creation.
     * A reader can only read a site; the reader cannot add content.
     * When a reader creates a site using Self-Service Site Creation,
     * the reader becomes the site owner and a member of the Administrator role for the new site.
     * This does not affect the user's role membership for any other site.
     * Rights included: CreateSSCSite, ViewListItems, ViewPages.
     */
    const Reader = 2;

    /**
     * Has Reader rights, plus rights to add items, edit items, delete items, manage list permissions,
     * manage personal views, personalize Web Part Pages,
     * and browse directories. Includes all rights in the Reader role, plus the following:
     * AddDelPrivateWebParts, AddListItems, BrowseDirectories, CreatePersonalGroups, DeleteListItems, EditListItems,
     * ManagePersonalViews, UpdatePersonalWebParts. Contributors cannot create new lists or document libraries,
     * but they can add content to existing lists and document libraries
     */
    const Contributor = 3;

    /**
     * Has Contributor rights, plus rights to cancel check-out, delete items, manage lists, add and customize pages,
     * define and apply themes and borders, and link style sheets. Includes all rights in the Contributor role,
     * plus the following: AddAndCustomizePages, ApplyStyleSheets, ApplyThemeAndBorder, CancelCheckout, ManageLists.
     * WebDesigners can modify the structure of the site and create new lists or document libraries.
     */
    const WebDesigner = 4;

    /**
     * Has all rights from other roles, plus rights to manage roles and view usage analysis data.
     * Includes all rights in the WebDesigner role, plus the following:
     * ManageListPermissions, ManageRoles, ManageSubwebs, ViewUsageData.
     * The Administrator role cannot be customized or deleted, and must always contain at least one member.
     * Members of the Administrator role always have access to, or can grant themselves access to,
     * any item in the Web site.
     */
    const Administrator = 5;
}
