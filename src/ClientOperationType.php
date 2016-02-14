<?php

namespace SharePoint\PHP\Client;

/**
 * Client operation type
 */
abstract class ClientOperationType
{
    const Read = 1;
    const Create = 2;
    const Update = 4;
    const Delete = 8;
}