<?php 
  $result = array();

  session_start();
  $result['status'] = false;
  $loginUser = $_SESSION['loginUser'];
  $result['message'] = "test";

  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  if(mysqli_connect_errno()){ //db연결 실패
    $result['status'] = false;
    $result['message'] = "db연결 실패";

  }else { //db 연결성공
    $strQuery = "SELECT user_name, user_id, mail_first, mail_last, phone_num_first, phone_num_middele, phone_num_last, tel_num_first, tel_num_middele, tel_num_last, post_code, address, detail_address, sms_status, mail_status ";
    $strQuery = $strQuery."FROM user WHERE user_id = '".$loginUser."'";
    $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
    $numRow = mysqli_num_rows($queryResult); //조회한 행의 개수 
    $userData = mysqli_fetch_assoc($queryResult);

    if($loginUser && $numRow > 0){ // 사용자 있으면 
      $result['status'] = true;
      $result['message'] = "조회성공";
      foreach ($userData as $key => $value) {
        $result[$key] = $value;
      }
    }else{ // 가입안함
      $result['status'] = false;
      $result['message'] = "조회실패";
      // $result['loginUser'] = $loginUser;
      // $result['strQuery'] = $strQuery;
    }

    mysqli_close($connect); // db 연결 종료
  }
  $convertJSON = json_encode($result);
	echo $convertJSON;
?>