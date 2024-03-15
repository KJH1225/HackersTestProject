<?php 
  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();

  session_start();

  
  if ($_SESSION['authCode'] === $decodedData['authCode']) {
    $result['status'] = true;
    $result['message'] = "인증 성공!";
    $result['url'] = "/member/index.php?mode=step_03";
    $result['id'] = $_SESSION['id'];
    unset($_SESSION['authCode'], $_SESSION['id']);
  } else {
    $result['status'] = false;
    $result['message'] = "인증 번호가 틀렸습니다!";
  }

  $convertJSON = json_encode($result);
  echo $convertJSON;
?>