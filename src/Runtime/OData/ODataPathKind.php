<?php


namespace Office365\Runtime\OData;

/**
 * Enumerates the different kinds of payloads
 */
class ODataPathKind
{
    /**
     * Specifies an unknown path.
     */
    const Unknown = -1;


    /**
     * Represents an entity set path. for example: /users
     */
    const EntitySet = 1;


    /**
     * Represents an entity path, for example: /users/{id}.
     */
    const Entity = 2;


    /**
     * Represents an operation (function or action) path, for example: ~/web/getFileByServerRelativeUrl(url={url})
     */
    const Operation = 3;


    /**
     * Represents an operation import (function import or action import path), for example: ~/approve
     */
    const OperationImport = 4;

}
