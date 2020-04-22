<?php


namespace Office365\SharePoint;


use Office365\Runtime\Types\EnumType;

class AddFieldOptions extends EnumType
{
    const DefaultValue = 0;
    const AddToDefaultContentType = 1;
    const AddToNoContentType = 2;
    const AddToAllContentTypes = 4;
    const AddFieldInternalNameHint = 8;
    const AddFieldToDefaultView = 16;
    const AddFieldCheckDisplayName = 32;
}