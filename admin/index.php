<?php
  require_once $_SERVER['DOCUMENT_ROOT'].'/model/user/login/login_status.php';
  if ( $loginStatus !== true || $is_admin !== true) {
    echo "<script>
            alert('로그인 해주세요');
            location.href='/';
          </script>";
    exit;
  } 


	include_once $_SERVER['DOCUMENT_ROOT']."/include/admin_header.html";
	include_once $_SERVER['DOCUMENT_ROOT']."/include/admin_lnb.html";
  
  $file = isset($_GET['mode']) ? $_GET['mode'].".html" : '';
	if($file && file_exists($file)) { //url에 mode있고 && 파일도 존재하면
		include_once $file;
	} else {
		//메인 팅기기
		echo "<script>window.location.href = '/';</script>";
		exit;
	}
		
	include_once $_SERVER['DOCUMENT_ROOT']."/include/admin_footer.html";	
?>
