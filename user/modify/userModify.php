<?php 
  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();
  
  require $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  session_start();
  $userId = $_SESSION['loginUser'];
  
  //비밀번호 맞는지 조회
  //맞으면 update
  //아니면 false

  
  //유효성검사
  $passwordValidate = preg_match("/^[a-zA-Z][a-zA-Z0-9]{3,14}$/", $decodedData['password']);
  $mailFirstValidate = preg_match("/^[a-zA-Z0-9]+$/", $decodedData['mailFirst']);
  $mailLastValidate = preg_match("/^[a-z]+(\.[a-z]+)*\.[a-z]{2,6}$/", $decodedData['mailLast']);
  $firstTelNumValidate = preg_match("/^[0-9]{0,3}$/", $decodedData['firstTelNum']);
  $middeleTelNumValidate = preg_match("/^[0-9]{0,4}$/", $decodedData['middeleTelNum']);
  $lastTelNumValidate = preg_match("/^[0-9]{0,4}$/", $decodedData['lastTelNum']);
  $postCodeValidate = preg_match("/(\d{3}-\d{3}|\d{5})/", $decodedData['postCode']);
  $addressValidate = preg_match("/[가-힣0-9\s]$/", $decodedData['address']);
  $detailAddressValidate = preg_match("/[가-힣0-9\s]$/", $decodedData['detailAddress']);
  $smsRadio = preg_match("/^(1|0)$/", $decodedData['smsRadio']);
  $mailRadio = preg_match("/^(1|0)$/", $decodedData['mailRadio']);

  if($passwordValidate && $mailFirstValidate && $mailLastValidate && $firstTelNumValidate && $middeleTelNumValidate && $lastTelNumValidate && $postCodeValidate && $addressValidate && $detailAddressValidate && $smsRadio && $mailRadio) {


    if(mysqli_connect_errno()){ //db연결 실패
      $result['status'] = false;
      $result['message'] = "db연결 실패";
  
    }else { //db 연결성공

      //비밀번호 비교
      $strQuery = "SELECT userPassword, salt FROM users WHERE userId = '".$userId."'"; 
      $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
      $userData = mysqli_fetch_assoc($queryResult);
      $numRow = mysqli_num_rows($queryResult); //조회한 행의 개수 
  
      if($numRow > 0){ // 사용자 있음
        // 비밀번호 비교
        $inputPassword = hash('sha256', $decodedData['password'].$userData['salt']);
        if ($inputPassword === $userData['userPassword']) { // 비밀번호 맞음
          //업데이트
          $updateQuery = "UPDATE users set mailFirst = '".$decodedData['mailFirst']."', mailLast = '".$decodedData['mailLast']."', firstTelNum = '".$decodedData['firstTelNum']."', middeleTelNum = '".$decodedData['middeleTelNum']."', lastTelNum = '".$decodedData['lastTelNum']."', postCode = '".$decodedData['postCode']."', address = '".$decodedData['address']."', detailAddress = '".$decodedData['detailAddress']."', smsStatus = '".$decodedData['smsStatus']."', mailStatus = '".$decodedData['mailStatus']."' "; // 입력한 id랑 같은 id 조회
          $updateQuery = $updateQuery." WHERE userId = '".$userId."'";
          $queryResult = mysqli_query($connect, $updateQuery); // 쿼리 실행
          $userData = mysqli_fetch_assoc($queryResult);
          if($queryResult) {
            $result['status'] = true;
            $result['message'] = "정보수정 성공";
          } else {
            $result['status'] = false;
            $result['message'] = "정보수정 실패";
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