<?php


namespace Office365\Runtime;

abstract class ClientRequestStatus
{
    const Active = 1;
    const InProgress = 2;
    const CompletedSuccess = 3;
    const CompletedException = 4;
}

