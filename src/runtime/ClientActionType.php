<?php

namespace SharePoint\PHP\Client;

/**
 * Action type
 */
abstract class ClientActionType
{
    const ReadEntry = 1;
    const CreateEntry = 2;
    const UpdateEntry = 4;
    const DeleteEntry = 8;
    const PostMethod = 16;
    const GetMethod = 32;
}