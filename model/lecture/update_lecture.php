<?php 
  $lecture_idx = $_POST['lecture_idx']; //업데이트할 강의 번호
  $lecture_category_idx = $_POST['lecture_category_idx']; //카테고리 번호
  $instructor_idx = $_POST['instructor_idx']; //강사 번호
  $lecture_name = $_POST['lecture_name']; //강의명
  $learning_difficulty = $_POST['learning_difficulty_radio']; //합습난이도
  $learning_course_duration = $_POST['learning_course_duration']; //교육시간
  
  //파일 저장 
  $file = $_FILES['lecture_thumbnail_image'];
  $temp_file = $_FILES['lecture_thumbnail_image']['tmp_name']; // 임시 저장된 위치
  $file_error = $_FILES['lecture_thumbnail_image']['error']; // 에러코드
  $file_type_extension = explode("/", $_FILES['lecture_thumbnail_image']['type']); // 업로드한 파일 타입 및 확장자
  $file_name = time(); // 저장할 이름
  $temp_path = "/image/".$file_name.".".$file_type_extension[1];
  $save_file_path = $file_error == 0 ? "'$temp_path'" : "NULL"; // 저장할 위치 설정 (파일은 수정안하느라 안올렸으면 NULL)
  $file_upload = move_uploaded_file($temp_file, $_SERVER['DOCUMENT_ROOT'].$temp_path); // 파일저장

  $result = array();

  require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

  //유효성 검사 정규식
  $pattern = [
    'lecture_category_idx' => '/^\d+$/',
    'instructor_idx' => '/^\d+$/',
    'lecture_name' => '/^[\w\sㄱ-ㅎ가-힣\d]+$/u',
    'learning_difficulty' => '/^[가-힣]+$/u',
    'learning_course_duration' => '/^[\w\sㄱ-ㅎ가-힣\d]+$/u'
  ];
  //유효성검사
  $is_valid = [
    'lecture_category_idx' => preg_match($pattern['lecture_category_idx'], $lecture_category_idx),
    'instructor_idx' => preg_match($pattern['instructor_idx'], $instructor_idx),
    'lecture_name' => preg_match($pattern['lecture_name'], $lecture_name),
    'learning_difficulty' => preg_match($pattern['learning_difficulty'], $learning_difficulty),
    'learning_course_duration' => preg_match($pattern['learning_course_duration'], $learning_course_duration)
  ];

  if (in_array(false, $is_valid)) { //유효성검사 실패
    $result['status'] = false;
    $result['message'] = "유효하지 않은 값";
  } else {
    if(mysqli_connect_errno()){ //db연결 실패
      $result['status'] = false;
      $result['message'] = "db연결 실패";
  
    }else { //db 연결성공
      //쿼리실행

      $prevQuery = "SELECT lecture_thumbnail_url FROM lecture WHERE lecture_idx = '".$lecture_idx."'";
      $prevQueryResult = mysqli_query($connect, $prevQuery);
      $prev_lecture_thumbnail_url = mysqli_fetch_assoc($prevQueryResult)['lecture_thumbnail_url'];

      $strQuery = "UPDATE lecture SET lecture_category_idx = '".$lecture_category_idx."', instructor_idx = '".$instructor_idx."', lecture_name = '".$lecture_name."', learning_difficulty = '".$learning_difficulty."', learning_course_duration = '".$learning_course_duration."', lecture_thumbnail_url = COALESCE($save_file_path, '".$prev_lecture_thumbnail_url."')";
      $strQuery = $strQuery." WHERE lecture_idx = '".$lecture_idx."'";

      $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
  
      if($queryResult){ // 쿼리 성공했으면
        $result['status'] = true;
        $result['message'] = "강의 수정 성공";
      }else{ // 쿼리실패
        $result['status'] = false;
        $result['message'] = "강의 수정 실패! 관리자 문의";
      }
    }
  }
  mysqli_close($connect); // db 연결 종료


  $convertJSON = json_encode($result); 
	echo $convertJSON;
?>