<?php 
  $jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
  $result = array();

  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  if(mysqli_connect_errno()){ //db연결 실패
    $result['status'] = false;
    $result['message'] = "db연결 실패";

  }else { //db 연결성공
    $strQuery = "SELECT * FROM lecture_category 
                  order by lecture_category_idx desc;";
    $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
    $numRow = mysqli_num_rows($queryResult); //조회한 행의 개수 
    $lecture_categoryData = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    if($queryResult && $numRow > 0){ // 쿼리 성공했고 강의 있으면
      $result['status'] = true;
      $result['message'] = "분류조회성공";
      $result['lecture_category'] = $lecture_categoryData;
      // foreach ($userData as $key => $value) {
      //   $result[$key] = $value;
      // }
    }else{ // 쿼리실패 or 강의없음
      $result['status'] = false;
      $result['message'] = "쿼리실패 or 분류없음";
    }

    mysqli_close($connect); // db 연결 종료
  }
  $convertJSON = json_encode($result); 
	echo $convertJSON;
?>