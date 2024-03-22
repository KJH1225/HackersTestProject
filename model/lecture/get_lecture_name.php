<?php 
  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();

  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  if(mysqli_connect_errno()){ //db연결 실패
    $result['status'] = false;
    $result['message'] = "db연결 실패";

  }else { //db 연결성공
    $strQuery = "SELECT lecture_name, lecture_category_idx FROM lecture";
    if (isset($decodedData['category']) && strlen($decodedData['category']) != 0) { //$decodedData['category']에 값이 있고 빈무자열이 아니면 조건 추가
      $strQuery = $strQuery . " WHERE lecture_category_idx = '" . $decodedData['category'] . "'";
    }
    $strQuery = $strQuery." order by lecture_idx desc;";
    $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
    $numRow = mysqli_num_rows($queryResult); //조회한 행의 개수 
    $lectureData = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    if($queryResult && $numRow > 0){ // 쿼리 성공했고 강의 있으면
      $result['status'] = true;
      $result['message'] = "강의명조회성공";
      $result['lecture'] = $lectureData;
      // foreach ($userData as $key => $value) {
      //   $result[$key] = $value;
      // }
    }else{ // 쿼리실패 or 강의없음
      $result['status'] = false;
      $result['message'] = "쿼리실패 or 강의없음";
      $result['strQuery'] = $strQuery;
    }

    mysqli_close($connect); // db 연결 종료
  }
  $convertJSON = json_encode($result); 
	echo $convertJSON;
?>