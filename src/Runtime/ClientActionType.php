<?php

namespace Office365\PHP\Client\Runtime;

/**
 * Action type
 */
abstract class ClientActionType
{
    const Create = 2;
    const Update = 4;
    const Delete = 8;
    const Post = 16;
    const Get = 32;
}