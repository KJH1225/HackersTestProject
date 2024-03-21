
<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/model/user/sign/sign_function.php';
	$json = json_decode(file_get_contents('php://input'), true);
	$result = array();

	if(preg_match("/^[A-Za-z]{1}[A-Za-z0-9]{4,15}$/", $json["id"])){ //입력값 검사
		$result = checkId($json["id"]); //아이디 중복검사
	} else {
		$result['status'] = false;
		$result['message'] = '유효하지 않은 값 입니다.';
	}

	$convertJSON = json_encode($result);
	echo $convertJSON;
?>