
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ko" lang="ko">
<head>
	<?php include '../include/Head.php';?>
</head>

<body>
	<!-- skip nav -->
	<div id="skip-nav">
		<a href="#content">본문 바로가기</a>
	</div>
	<!-- //skip nav -->

	<?php 
		include "../include/Header.php";
			
			$file = isset($_GET['mode']) ? $_GET['mode'].".php" : '';

			if($file && file_exists($file)) { //url에 mode있고 && 파일도 존재하면
				include $file;
			} else {
				//메인 팅기기
				echo "<script>window.location.href = '/index.php';</script>";
				exit;
			}
			//파일체크 o
			//모드 없으면 메인으로 d
			//헤드도 따로 파일 뺴기 o
			//회원정보수정에서 인풋칸 보고 컬럼정하기 o
		include "../include/Footer.php";	
	?>

</body>
</html>
