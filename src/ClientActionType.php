<?php

namespace SharePoint\PHP\Client;

/**
 * Client action type
 */
abstract class ClientActionType
{
    const Read = 1;
    const Create = 2;
    const Update = 4;
    const Delete = 8;
}