<?php 
require_once "phpwebdriver/WebDriver.php";
 require("phpwebdriver/LocatorStrategy.php");

$webdriver = new WebDriver("localhost", "4444"); $webdriver->connect("chrome");
$webdriver->get("http://google.com"); $element = $webdriver->findElementBy(LocatorStrategy::name, "q"); $element->sendKeys(array("selenium google code" ) ); $element->submit();

$webdriver->close();
?>