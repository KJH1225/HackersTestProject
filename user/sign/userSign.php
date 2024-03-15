<?php 
	require $_SERVER['DOCUMENT_ROOT'].'/user/sign/signFunction.php';
	$jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
	$result = array();
	
	$checkIdResult = checkId($decodedData['id']); //id 중복검사
	$validateResult = validateData($decodedData); //유효성검사
	if($checkIdResult['status'] && $validateResult['status']) {  // 둘다 통과하면
		//회원가입 
		$salt = bin2hex(random_bytes(32));
		$userData = array(
			"userName" => $decodedData['name'],
			"userId" => $decodedData['id'],
			"salt" => $salt,
			"userPassword" => hash('sha256', $decodedData['password'].$salt),
			"mailFirst" => $decodedData['mailFirst'],
			"mailLast" => $decodedData['mailLast'],
			"firstPhoneNum" => $decodedData['firstPhoneNum'],
			"middelePhoneNum" => $decodedData['middelePhoneNum'],
			"lastPhoneNum" => $decodedData['lastPhoneNum'],
			"firstTelNum" => $decodedData['firstTelNum'],
			"middeleTelNum" => $decodedData['middeleTelNum'],
			"lastTelNum" => $decodedData['lastTelNum'],
			"postCode" => $decodedData['postCode'],
			"address" => $decodedData['address'],
			"detailAddress" => $decodedData['detailAddress'],
			"smsStatus" => $decodedData['smsRadio'],
			"mailStatus" => $decodedData['mailRadio'],
		);

		$result = userSign($userData);

	}else {
		$result['status'] = false;
		$result['message'] = '유효하지 않은 값이 있습니다.';
	}

	$convertJSON = json_encode($result);
  echo $convertJSON;
?>