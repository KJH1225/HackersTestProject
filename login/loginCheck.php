<?php 

  session_start();
  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();

  

?>