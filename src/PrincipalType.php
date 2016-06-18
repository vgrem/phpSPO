<?php


namespace SharePoint\PHP\Client;


class PrincipalType extends EnumType
{
    const None = 0;
    const User = 1;
    const DistributionList = 2;
    const SecurityGroup = 4;
    const SharePointGroup = 8;
    const All = PrincipalType::SharePointGroup | PrincipalType::SecurityGroup | PrincipalType::DistributionList | PrincipalType::User;
}