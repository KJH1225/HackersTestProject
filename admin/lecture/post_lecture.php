<?php 
  $file = $_FILES['lecture_thumbnail_image'];
  $post = $_POST;
  $result = array();

  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  if(mysqli_connect_errno()){ //db연결 실패
    $result['status'] = false;
    $result['message'] = "db연결 실패";

  }else { //db 연결성공
    // $strQuery = "SELECT * FROM lecture 
    //               LEFT JOIN instructor AS ins 
    //               ON lecture.instructor_idx = ins.instructor_idx
    //               LEFT JOIN lecture_category AS cat 
    //               ON lecture.lecture_category_idx = cat.lecture_category_idx 
    //               order by lecture_idx desc;";
    // if (isset($decodedData['category'])) { 
    //   $strQuery = $strQuery . " lecture.lecture_category_idx = '" . $decodedData['category'] . "'";
    // }
    // $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
    // $numRow = mysqli_num_rows($queryResult); //조회한 행의 개수 
    // $lectureData = mysqli_fetch_all($queryResult, MYSQLI_ASSOC);

    // if($queryResult && $numRow > 0){ // 쿼리 성공했고 강의 있으면
    //   $result['status'] = true;
    //   $result['message'] = "강의조회성공";
    //   $result['lecture'] = $lectureData;
    //   // foreach ($userData as $key => $value) {
    //   //   $result[$key] = $value;
    //   // }
    // }else{ // 쿼리실패 or 강의없음
    //   $result['status'] = false;
    //   $result['message'] = "쿼리실패 or 강의없음";
    // }

    mysqli_close($connect); // db 연결 종료
  }
  $convertJSON = json_encode($post); 
	echo $convertJSON;
?>