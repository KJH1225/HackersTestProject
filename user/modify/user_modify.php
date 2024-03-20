<?php 
  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();
  
  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  session_start();
  $user_id = $_SESSION['loginUser'];
  
  //비밀번호 맞는지 조회
  //맞으면 update
  //아니면 false

  
  //유효성검사
  $passwordValidate = preg_match("/^[a-zA-Z][a-zA-Z0-9]{3,14}$/", $decodedData['password']);
  $mail_firstValidate = preg_match("/^[a-zA-Z0-9]+$/", $decodedData['mail_first']);
  $mail_lastValidate = preg_match("/^[a-z]+(\.[a-z]+)*\.[a-z]{2,6}$/", $decodedData['mail_last']);
  $tel_num_firstValidate = preg_match("/^[0-9]{0,3}$/", $decodedData['tel_num_first']);
  $tel_num_middeleValidate = preg_match("/^[0-9]{0,4}$/", $decodedData['tel_num_middele']);
  $tel_num_lastValidate = preg_match("/^[0-9]{0,4}$/", $decodedData['tel_num_last']);
  $post_codeValidate = preg_match("/(\d{3}-\d{3}|\d{5})/", $decodedData['post_code']);
  $addressValidate = preg_match("/[가-힣0-9\s]$/", $decodedData['address']);
  $detail_addressValidate = preg_match("/[가-힣0-9\s]$/", $decodedData['detail_address']);
  $sms_status = preg_match("/^(1|0)$/", $decodedData['sms_status']);
  $mail_status = preg_match("/^(1|0)$/", $decodedData['mail_status']);

  if($passwordValidate && $mail_firstValidate && $mail_lastValidate && $tel_num_firstValidate && $tel_num_middeleValidate && $tel_num_lastValidate && $post_codeValidate && $addressValidate && $detail_addressValidate && $sms_status && $mail_status) {

    if(mysqli_connect_errno()){ //db연결 실패
      $result['status'] = false;
      $result['message'] = "db연결 실패";
  
    }else { //db 연결성공

      //비밀번호 비교
      $strQuery = "SELECT user_password, salt FROM user WHERE user_id = '".$user_id."'"; 
      $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
      $userData = mysqli_fetch_assoc($queryResult);
      $numRow = mysqli_num_rows($queryResult); //조회한 행의 개수 
  
      if($numRow > 0){ // 사용자 있음
        // 비밀번호 비교
        $inputPassword = hash('sha256', $decodedData['password'].$userData['salt']);
        if ($inputPassword === $userData['user_password']) { // 비밀번호 맞음
          //업데이트
          $updateQuery = "UPDATE user set mail_first = '".$decodedData['mail_first']."', mail_last = '".$decodedData['mail_last']."', tel_num_first = '".$decodedData['tel_num_first']."', tel_num_middele = '".$decodedData['tel_num_middele']."', tel_num_last = '".$decodedData['tel_num_last']."', post_code = '".$decodedData['post_code']."', address = '".$decodedData['address']."', detail_address = '".$decodedData['detail_address']."', sms_status = '".$decodedData['sms_status']."', mail_status = '".$decodedData['mail_status']."' "; // 입력한 id랑 같은 id 조회
          $updateQuery = $updateQuery." WHERE user_id = '".$user_id."'";
          $queryResult = mysqli_query($connect, $updateQuery); // 쿼리 실행
          $userData = mysqli_fetch_assoc($queryResult);
          if($queryResult) {
            $result['status'] = true;
            $result['message'] = "정보수정 성공";
          } else {
            $result['status'] = false;
            $result['message'] = "정보수정 실패";
            $result['error'] = mysqli_error($connect);
          }
        }else {
          $result['status'] = false;
          $result['message'] = "비밀번호가 일치하지 않습니다.";
        }
      }else{ // 가입안함
        $result['status'] = false;
        $result['message'] = "사용자가 없습니다.";
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