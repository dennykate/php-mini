<?php

$name = $_POST["fri_name"];
$phone= $_POST["fri_phone"];
$address= $_POST["fri_address"];
$isReal= $_POST["isReal"];

$data = [
    "name"=>$name,"phone"=>$phone,"address"=>$address,"isReal"=>$isReal
];
$encodedData = json_encode($data);

$files = [];
$folderName = "friend-records";
if(!is_dir($folderName)){
    mkdir($folderName);
}

if(is_dir($folderName)){
    $files = scandir($folderName);
}

$fileCount = count($files) - 1;
$fileOpen = fopen($folderName."/"."record-$fileCount.json","w");
fwrite($fileOpen,$encodedData);

fclose($fileOpen);


?>