<?php


namespace Office365\PHP\Client\SharePoint;

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

    const WebDesigner = 4;

    const Administrator = 5;
}
