<?php 

  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();

  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  
  // 입력값 검증
  // 같은 값인지 비교
  $passwordCheck = $decodedData['new_password'] === $decodedData['new_password_check'];
  $passwordValidate = preg_match("/^[a-zA-Z][a-zA-Z0-9]{3,14}$/", $decodedData['new_password']);

  if ($passwordCheck && $passwordValidate) {
    if(mysqli_connect_errno()){ //db연결 실패
      $result['status'] = false;
      $result['message'] = "db연결 실패";
  
    }else { //db 연결성공
      session_start();
      $id =  $_SESSION['id'];
      $newSalt =  bin2hex(random_bytes(32));
      $new_password =  hash('sha256', $decodedData['new_password'].$newSalt);
  
      $strQuery = "UPDATE user set user_password = '".$new_password."', salt = '".$newSalt."'"; // 입력한 id랑 같은 id 조회
      $strQuery = $strQuery."WHERE user_id = '".$id."'";
      
      $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
      $userData = mysqli_fetch_assoc($queryResult); 
  
      if($queryResult){ // 변경 성공
        $result['status'] = true;
        $result['message'] = "변경 성공";
        unset($_SESSION['id']);
      }else{ // 변경 실패
        $result['status'] = false;
        $result['message'] = "변경 실패";
      }
  
      mysqli_close($connect); // db 연결 종료
    }
  } else {
    $result['status'] = false;
    $result['message'] = "유효하지 않은 값";
  }

  $convertJSON = json_encode($result);
	echo $convertJSON;
?>