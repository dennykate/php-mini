<?php

if($_SERVER["REQUEST_METHOD"] !== "POST" && $_FILES["fri_photo"]["error"] == 0){
    header("Location:/");
}

$name = $_POST["fri_name"];
$phone= $_POST["fri_phone"];
$address= $_POST["fri_address"];
$isReal= $_POST["isReal"];
$photo= $_FILES["fri_photo"];

$profileDirName= "friend-profile";

if(!is_dir($profileDirName)){
    mkdir($profileDirName);
}

$fileName= $profileDirName."/".uniqid()."-friend-profile".".".pathinfo($photo["name"])["extension"];

move_uploaded_file($photo["tmp_name"],$fileName);

$data = [
    "name" => $name,"phone" => $phone,"address" => $address,"isReal" => $isReal,"photo" => $fileName
];
$encodedData = json_encode($data,JSON_PRETTY_PRINT);
$profileData = "friend-data.json";

$jsonFile = file_get_contents("friend-data.json");
$tmpArray = json_decode($jsonFile,true);
$tmpArray[] = $encodedData;
$jsonData = json_encode($tmpArray);

file_put_contents($profileData,$jsonData);

header("Location:fri-card.php");





?>