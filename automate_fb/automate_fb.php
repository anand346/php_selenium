<?php
require_once "phpwebdriver/WebDriver.php";

$webdriver = new WebDriver("localhost", "4444");
$webdriver->connect("chrome");
$webdriver->get("http://facebook.com"); 
$element_email_input = $webdriver->findElementBy(LocatorStrategy::id, "email");
if($element_email_input){
    $element_email_input->sendKeys(array("rajanandrajanand346@gmail.com"));
}
$element_pass_input = $webdriver->findElementBy(LocatorStrategy::id, "pass");
if($element_pass_input){
    $element_pass_input->sendKeys(array("Raj@anand"));
}
$element_email_input->submit();
$element_search_input = $webdriver->findElementBy(LocatorStrategy::xpath, "/html/body/div[1]/div/div[1]/div/div[2]/div[2]/div/div/div[1]/div/div/label/input");
$element_search_input->sendKeys(array("drop email"));
$element_search_input->submit();
$webdriver->dismissAlert();
?>