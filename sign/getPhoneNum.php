<?php 

    session_start();

    $result = array();
    $result['firstPhoneNum'] = $_SESSION['firstPhoneNum'];;
    $result['middelePhoneNum'] = $_SESSION['middelePhoneNum'];
    $result['lastPhoneNum'] = $_SESSION['lastPhoneNum'];

    $convertJSON = json_encode($result);
    echo $convertJSON;
    
?>