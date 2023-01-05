<?php

$firends = [];
$dataFileName = "friend-data.json";

if(file_exists($dataFileName) && filesize($dataFileName)){
   $firends= json_decode(file_get_contents($dataFileName),true);
}

if($_SERVER["REQUEST_METHOD"] !== "POST" && $_FILES["fri_photo"]["error"] !== 0){
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

array_push($firends,$data);

$fileOpen = fopen($dataFileName,"w");
fwrite($fileOpen,json_encode($firends));

fclose($fileOpen);











header("Location:fri-card.php?success=true");





?>