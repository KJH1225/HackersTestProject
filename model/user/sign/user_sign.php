<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/model/user/sign/sign_function.php';
	$jsonData = file_get_contents('php://input');
  $decodedData  = json_decode($jsonData, true);
	$result = array();
	
	$checkIdResult = checkId($decodedData['id']); //id 중복검사
	$validateResult = validateData($decodedData); //유효성검사
	if($checkIdResult['status'] && $validateResult['status']) {  // 둘다 통과하면
		//회원가입 
		$salt = bin2hex(random_bytes(32));
		$userData = array(
			"user_name" => $decodedData['name'],
			"user_id" => $decodedData['id'],
			"salt" => $salt,
			"user_password" => hash('sha256', $decodedData['password'].$salt),
			"mail_first" => $decodedData['mail_first'],
			"mail_last" => $decodedData['mail_last'],
			"phone_num_first" => $decodedData['phone_num_first'],
			"phone_num_middele" => $decodedData['phone_num_middele'],
			"phone_num_last" => $decodedData['phone_num_last'],
			"tel_num_first" => $decodedData['tel_num_first'],
			"tel_num_middele" => $decodedData['tel_num_middele'],
			"tel_num_last" => $decodedData['tel_num_last'],
			"post_code" => $decodedData['post_code'],
			"address" => $decodedData['address'],
			"detail_address" => $decodedData['detail_address'],
			"sms_status" => $decodedData['sms_radio'],
			"mail_status" => $decodedData['mail_radio'],
		);

		$result = userSign($userData);

	}else {
		$result['status'] = false;
		$result['message'] = '유효하지 않은 값이 있습니다.';
	}

	$convertJSON = json_encode($result);
  echo $convertJSON;
?>