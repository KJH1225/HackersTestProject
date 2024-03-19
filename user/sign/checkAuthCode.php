<?php 

    $inputAuthNum = $_POST["inputAuthNum"];
    $result = array();

    session_start();

    if( empty($_POST["inputAuthNum"]) || empty($_SESSION['authCode']) ){ //핸드폰번호 없음 or 세션에 인증번호 없음
			$result['status'] = false;
			$result['message'] = "핸드폰 번호를 입력해 주세요";
    } else {
			if($_SESSION['authCode'] === $inputAuthNum) { //입력한 번호랑 세션의 인증번호가 다름
				$result['status'] = true;
				$result['message'] = "인증 성공!";
				$result['url'] = "/member/index.php?mode=step_03";
			} else {
				$result['status'] = false;
				$result['message'] = "인증 번호가 틀렸습니다!";
			}
		}

    $convertJSON = json_encode($result);
    echo $convertJSON;
?>