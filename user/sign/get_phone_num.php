<?php 

    session_start();

    $result = array();
    $result['phone_num_first'] = $_SESSION['phone_num_first'];;
    $result['phone_num_middele'] = $_SESSION['phone_num_middele'];
    $result['phone_num_last'] = $_SESSION['phone_num_last'];

    $convertJSON = json_encode($result);
    echo $convertJSON;
    
?>