<?php 
  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();

  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';
  
  if(mysqli_connect_errno()){ //db연결 실패
    $result['status'] = false;
    $result['message'] = "db연결 실패";

  }else { //db 연결성공
    $strQuery = "SELECT user_id FROM user WHERE user_name = '".$decodedData['name']."' AND mail_first = '".$decodedData['mail_first']."' AND mail_last = '".$decodedData['mail_last']."'"; // 입력한 id랑 같은 id 조회
    $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
    $userData = mysqli_fetch_assoc($queryResult);
    $numRow = mysqli_num_rows($queryResult); //조회한 행의 개수 

    if($numRow > 0){ // 가입했음 인증번호 생성
      session_start();
      $_SESSION['authCode'] = '123456';
      $_SESSION['id'] = $userData['user_id'];
      $result['status'] = true;
      $result['message'] = "인증번호를 입력해주세요";
    }else{ // 가입안함
      $result['status'] = false;
      $result['message'] = "가입하지 않은 사용자 입니다";
    }

    mysqli_close($connect); // db 연결 종료
  }

  $convertJSON = json_encode($result);
	echo $convertJSON;
?>