<?php 
require_once "phpwebdriver/WebDriver.php";
//  require("phpwebdriver/LocatorStrategy.php");
include "test/PHPWebdriverTest.php";
$driver = new PHPWebDriverTest();
$driver->testWindowHandling();
?>