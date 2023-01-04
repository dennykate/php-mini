<?php

    $data= file_get_contents("friend-data.json");
    print_r(json_decode($data,true));

?>