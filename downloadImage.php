<?php
require_once "phpwebdriver/WebDriver.php";
// print_r($argv);die();


//check for total no. of arguments must not greater than 3;


if($argv){
    if(sizeof($argv) > 4){
        die('please give topic name under "" (double quotes) ');
    }
}



//check for argument 1

if($argv[1]){
    if($argv[1] == "--help" || $argv[1] == "-h"){
        die("
syntax : php downloadImage.php topicOfImage noOfImagesToBeDownload startNo.
        ");
    }
    $topic = $argv[1];
}else{
    $topic = "animals";
}

//check for argument 2

if($argv[2]){
    $number = $argv[2];
    if($number > 20){
        die("no. of images to be download must not be greater than 20");
    }
}else{
    $number = 5;
}

//check for argument 3

if($argv[3]){
    $start = $argv[3];
    $number = $number + $start;
    if($start < 1){
        die("start value is invalid");
    }
}else{
    $start = 1;
    $number = $number + $start;
}

//starting web driver

// $topic = "buildings";
// $number = 3;
// $start = 3;
// $number = $start + $number;

$webdriver = new WebDriver("localhost", "4444");
$webdriver->connect("chrome");                            
$webdriver->get("http://wallhaven.cc");
$element = $webdriver->findElementBy(LocatorStrategy::name, "q");
if ($element) {
    $element->sendKeys(array($topic));
    $element->submit();
    $links = array();
    for($i = $start;$i < $number; $i++){
        $anchorElement = $webdriver->findElementBy(LocatorStrategy::xpath, '//*[@id="thumbs"]/section/ul/li['.$i.']/figure/a');
        $links[] = $anchorElement->getAttribute("href");
    }
    $webdriver->close();
    for($i = 0;$i < sizeof($links); $i++){
        $webdriver = new WebDriver("localhost", "4444");
        $webdriver->connect("chrome");                            
        $webdriver->get($links[$i]);
        $imgElement = $webdriver->findElementBy(LocatorStrategy::id, "wallpaper");
        $imgSrc = $imgElement->getAttribute("src");
        echo $imgSrc."\n\n";
        file_put_contents("downloads/img".($i+1).".jpg",file_get_contents($imgSrc));
        $webdriver->close();
    }
}
?>