<?php


namespace SharePoint\PHP\Client\Runtime;

/**
 * Enumerates the different kinds of payloads
 */
class ODataPayloadKind
{
    /**
     *
     */
    const Unsupported = -1;

    /**
     *
     */
    const Error = 0;

    /**
     *
     */
    const Collection = 1;

    /**
     *
     */
    const Entry = 2;

    /**
     * Specifies a payload kind for writing a collection.
     */
    const Value = 3;

    /**
     * Specifies the payload kind for writing a batch.
     */
    const Batch = 3;
}