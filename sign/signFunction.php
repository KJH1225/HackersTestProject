<?php 

  function checkId($id) { //id중복검사
    $result = array();

    require $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

    if(mysqli_connect_errno()){ //db연결 실패
      $result['status'] = false;
      $result['message'] = "db연결 실패";

    }else { //db 연결성공
      $idCheckQuery = "SELECT userId FROM users WHERE userId = '".$id."'"; // 입력한 id랑 같은 id 조회
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
			"mailFirst" => "/^[a-zA-Z0-9]+$/", 
			"mailLast" => "/^[a-z]+(\.[a-z]+)*\.[a-z]{2,6}$/", 
			"firstPhoneNum" => "/^[0-9]{2,4}$/", // 필수항목
			"middelePhoneNum" => "/^[0-9]{3,4}$/", // 필수항목
			"lastPhoneNum" => "/^[0-9]{4}$/", // 필수항목
			"firstTelNum" => "/^[0-9]{0,3}$/", // 빈값도 허용
			"middeleTelNum" => "/^[0-9]{0,4}$/", // 빈값도 허용
			"lastTelNum" => "/^[0-9]{0,4}$/", // 빈값도 허용
			"postCode" => "/(\d{3}-\d{3}|\d{5})/",
			"address" => "/[가-힣0-9\s]$/", // *사용해서 빈값도 ok
			"detailAddress" => "/[가-힣0-9\s]$/",
			"smsRadio" => "/^(1|0)$/",
			"mailRadio" => "/^(1|0)$/",
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

    require $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';

    if(mysqli_connect_errno()){ //db연결 실패
      $result['status'] = false;
      $result['message'] = "db연결 실패";

    }else { //db 연결성공
      $strQuery = "INSERT INTO `users` (`userName`, `userId`, `userPassword`, `salt`, `mailFirst`, `mailLast`, `firstPhoneNum`, `middelePhoneNum`, `lastPhoneNum`, `firstTelNum`, `middeleTelNum`, `lastTelNum`, `postCode`, `address`, `detailAddress`, `smsStatus`, `mailStatus`)"; 
		  $strQuery = $strQuery."VALUES ('".$userData["userName"]."', '".$userData["userId"]."', '".$userData["salt"]."', '".$userData["userPassword"]."', '".$userData["mailFirst"]."', '".$userData["mailLast"]."', '".$userData["firstPhoneNum"]."', '".$userData["middelePhoneNum"]."', '".$userData["lastPhoneNum"]."', '".$userData["firstTelNum"]."', '".$userData["middeleTelNum"]."', '".$userData["lastTelNum"]."', '".$userData["postCode"]."', '".$userData["address"]."', '".$userData["detailAddress"]."', '".$userData["smsStatus"]."', '".$userData["mailStatus"]."')";
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