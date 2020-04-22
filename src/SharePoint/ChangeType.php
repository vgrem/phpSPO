<?php

namespace Office365\SharePoint;

use Office365\Runtime\Types\EnumType;

class ChangeType extends EnumType
{
    const NoChange = 0;
    const Add = 1;
    const Update = 2;
    const DeleteObject = 3;
    const Rename = 4;
}