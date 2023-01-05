<?php

$friends = [];
$dataFileName = "friend-detail.json";

if(is_file($dataFileName) ){
    $friends= json_decode(file_get_contents($dataFileName),true);
}

if($_SERVER["REQUEST_METHOD"] !== "POST" && $_FILES["photo"]["name"] !== 0){
    header("Location:/");
}

$name = $_POST["fri_name"];
$phone= $_POST["fri_phone"];
$address= $_POST["fri_address"];
$isReal= $_POST["isReal"];
$photo= $_FILES["fri_photo"];

$dirName= "friend-profile";

if(!is_dir($dirName)){
    mkdir($dirName);
}

$fileName = $dirName."/".uniqid()."-profile".".".pathinfo($photo["name"])['extension'];

move_uploaded_file($photo["tmp_name"],$fileName);

$data = [
    "name"=> $name,"phone"=>$phone,"address"=> $address,"isReal"=> $isReal,"photo"=> $fileName
];

array_push($friends,$data);
$fileOpen = fopen($dataFileName,"w");
fwrite($fileOpen,json_encode($friends));

fclose($fileOpen);

?>