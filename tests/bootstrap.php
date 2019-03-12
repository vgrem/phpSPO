<?php

require_once('OutlookServicesTestCase.php');
require_once('SharePointTestCase.php');
require_once('ListItemExtensions.php');
require_once('ListExtensions.php');
require_once('WebExtensions.php');
require_once(__DIR__ . '/../vendor/autoload.php');

// PHPUnit backward compatibility
if (!class_exists('\PHPUnit\Framework\TestCase') &&
    class_exists('\PHPUnit_Framework_TestCase')) {
    class_alias('\PHPUnit_Framework_TestCase', '\PHPUnit\Framework\TestCase');
}


