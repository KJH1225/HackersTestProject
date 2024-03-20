<?php
	$jsonData = file_get_contents('php://input');
	$decodedData  = json_decode($jsonData, true);
	$result = array();

	session_start();
	$_SESSION['authCode'] = '123456'; //인증번호 생성
	$_SESSION['phone_num_first'] = $decodedData['phone_num_first'];
	$_SESSION['phone_num_middele'] = $decodedData['phone_num_middele'];
	$_SESSION['phone_num_last'] = $decodedData['phone_num_last'];

	$result['status'] = true;
	$result['message'] = "인증번호를 입력해주세요!";

	$convertJSON = json_encode($result);
	echo $convertJSON;
?>