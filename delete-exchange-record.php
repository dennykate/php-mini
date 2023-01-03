<?php

$file = $_GET["name"];

if(is_file("exchange-records/".$file)){
    unlink("exchange-records/".$file);
}

header("Location:exchange.php");

?>