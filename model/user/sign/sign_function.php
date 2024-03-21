<?php 

  function checkId($id) { //id중복검사
    $result = array();

    require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

    if(mysqli_connect_errno()){ //db연결 실패
      $result['status'] = false;
      $result['message'] = "db연결 실패";

    }else { //db 연결성공
      $idCheckQuery = "SELECT user_id FROM user WHERE user_id = '".$id."'"; // 입력한 id랑 같은 id 조회
      $queryResult = mysqli_query($connect, $idCheckQuery); // 쿼리 실행
      $numRow = mysqli_num_rows($queryResult); //조회한 행의 개수 

      if($numRow > 0){ // 같은 id 있음
        // $result = '이미 사용중인 id 입니다';
        $result['status'] = false;
        $result['message'] = "이미 사용중인 id 입니다.";
      }else{ //같은 id 없음
        $result['status'] = true;
        $result['message'] = "사용 가능한 id 입니다.";
      }

      mysqli_close($connect); // db 연결 종료
    }

    return $result;
  }

  function validateData($data) { //유효성검사
		$validateResult = array();
		
    $validations = array( //검사할 항목
			"id" => "/^[A-Za-z]{1}[A-Za-z0-9]{4,15}$/",
			"name" => "/^[가-힣]{2,6}$/u", //한글 범위 쓰려면 u붙여서 유니코드 허용해야됨
			"password" => "/^[a-zA-Z][a-zA-Z0-9]{3,14}$/",
			"passwordCheck" => "/^[a-zA-Z][a-zA-Z0-9]{3,14}$/",
			"mail_first" => "/^[a-zA-Z0-9]+$/", 
			"mail_last" => "/^[a-z]+(\.[a-z]+)*\.[a-z]{2,6}$/", 
			"phone_num_first" => "/^[0-9]{2,4}$/", // 필수항목
			"phone_num_middele" => "/^[0-9]{3,4}$/", // 필수항목
			"phone_num_last" => "/^[0-9]{4}$/", // 필수항목
			"tel_num_first" => "/^[0-9]{0,3}$/", // 빈값도 허용
			"tel_num_middele" => "/^[0-9]{0,4}$/", // 빈값도 허용
			"tel_num_last" => "/^[0-9]{0,4}$/", // 빈값도 허용
			"post_code" => "/(\d{3}-\d{3}|\d{5})/",
			"address" => "/[가-힣0-9\s]$/", 
			"detail_address" => "/[가-힣0-9\s]$/",
			"sms_radio" => "/^(1|0)$/",
			"mail_radio" => "/^(1|0)$/",
        // 여러 다른 유효성 검사 추가
    );

		if ($data['password'] !== $data['passwordCheck']) { // 비밀번호 체크
			$validateResult["status"] = false;
			$validateResult['message'] = "비밀번호가 일치하지 않습니다.";
			return $validateResult;
		}

		foreach ($validations as $key => $pattern) { //반복문으로 검사
			$value = $data[$key];

			if (!preg_match($pattern, $value)) { // 유효성 검사 실패
					$validateResult["status"] = false;
					$validateResult['message'] = "유효성검사 실패";
					$validateResult['falsePattern'] = $pattern;
					$validateResult['falsekey'] = $key;
					$validateResult['falseValue'] = $value;
					return $validateResult;
 			} 
		}
		
		$validateResult["status"] = true;
		$validateResult['message'] = "유효성검사 성공";
		return $validateResult;
	}

  function userSign($userData) { //회원가입
		$result = array();

    require_once $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

    if(mysqli_connect_errno()){ //db연결 실패
      $result['status'] = false;
      $result['message'] = "db연결 실패";

    }else { //db 연결성공
      $strQuery = "INSERT INTO `user` (`user_name`, `user_id`, `user_password`, `salt`, `mail_first`, `mail_last`, `phone_num_first`, `phone_num_middele`, `phone_num_last`, `tel_num_first`, `tel_num_middele`, `tel_num_last`, `post_code`, `address`, `detail_address`, `sms_status`, `mail_status`)"; 
		  $strQuery = $strQuery."VALUES ('".$userData["user_name"]."', '".$userData["user_id"]."', '".$userData["user_password"]."', '".$userData["salt"]."', '".$userData["mail_first"]."', '".$userData["mail_last"]."', '".$userData["phone_num_first"]."', '".$userData["phone_num_middele"]."', '".$userData["phone_num_last"]."', '".$userData["tel_num_first"]."', '".$userData["tel_num_middele"]."', '".$userData["tel_num_last"]."', '".$userData["post_code"]."', '".$userData["address"]."', '".$userData["detail_address"]."', '".$userData["sms_status"]."', '".$userData["mail_status"]."')";
      $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행

      if($queryResult === false){
        $result['status'] = false;
        $result['message'] = "가입실패";
        $result['error'] = mysqli_error($connect);
      }else{
        $result['status'] = true;
        $result['message'] = "가입성공";
        $result['url'] = "/member/index.php?mode=complete";
      }

      mysqli_close($connect); // db 연결 종료
    }

    return $result;
	}

?>