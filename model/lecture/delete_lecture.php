<?php 
  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();

  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  //권한검사: 세션으로 관리자 로그인했는지 확인

  if(mysqli_connect_errno()){ //db연결 실패
    $result['status'] = false;
    $result['message'] = "db연결 실패";

  }else { //db 연결성공
    $strQuery = "DELETE FROM lecture";
    $strQuery = $strQuery . " WHERE lecture_idx = '" . $decodedData['lecture'] . "'";
    
    $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
    if($queryResult){ // 쿼리 성공했고 강의 있으면
      $result['status'] = true;
      $result['message'] = "강의 삭제 성공!";
    }else{ // 쿼리실패 
      $result['status'] = false;
      $result['message'] = "강의 삭제 실패! 관리자에게 문의";
      // $result['strQuery'] = $strQuery;
    }

    mysqli_close($connect); // db 연결 종료
  }
  $convertJSON = json_encode($result); 
	echo $convertJSON;
?>