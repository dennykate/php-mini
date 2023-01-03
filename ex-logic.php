<?php 

$apiData = file_get_contents('http://forex.cbm.gov.mm/api/latest');
$apiData = json_decode($apiData,true);
$rates = $apiData['rates'];

if(isset($_POST["calc"])):
    $amount = $_POST["amount"];
    $from = $_POST["from"];
    $to = $_POST["to"];

    $mmk = $amount * str_replace(",","",$rates[$from]);
    $result = $mmk / str_replace(",","",$rates[$to]);
?>

<div class="bg-light border-3 p-3">
    <p class="mb-0 text-black-50">From <?= $amount ?><?= $from ?> to <?= $to ?></p>
    <h1 class="fw-bold "><?= round($result,2) ?> <?= $to ?></h1>
</div>

<?php
    $data = ["amount"=> $amount,"from"=> $from,"to"=> $to,"result"=> round($result,2)." ".$to];
    $encodedData = json_encode($data);

    $folderName= "exchange-records";
    $files = [];

    if(!is_dir($folderName)){
        mkdir($folderName);
    }

    if(is_dir($folderName)){
        $files = scandir($folderName);
    }

    $fileCount = count($files) - 1;

    $fileName = $folderName."/"."record-".$fileCount.".json";
    $fileOpen = fopen($fileName,"w");
    fwrite($fileOpen,$encodedData);

    fclose($fileOpen);

?>

<?php endif ?>