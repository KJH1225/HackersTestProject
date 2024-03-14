

<div id="wrap">
	<div id="container" class="container-full">
		<div id="content" class="content">
			<div class="inner">
				<div class="tit-box-h3">
					<h3 class="tit-h3">회원가입</h3>
					<div class="sub-depth">
						<span><i class="icon-home"><span>홈</span></i></span>
						<strong>회원가입 완료</strong>
					</div>
				</div>

				<div class="join-step-bar">
					<ul>
						<li><i class="icon-join-agree"></i> 약관동의</li>
						<li class="on"><i class="icon-join-chk"></i> 본인확인</li>
						<li class="last"><i class="icon-join-inp"></i> 정보입력</li>
					</ul>
				</div>

				<div class="tit-box-h4">
					<h3 class="tit-h4">본인인증</h3>
				</div>

				<div class="section-content after">
					<div class="identify-box" style="width:100%;height:190px;">
						<div class="identify-inner">
							<strong>휴대폰 인증</strong>
							<p>주민번호 없이 메시지 수신가능한 휴대폰으로 1개 아이디만 회원가입이 가능합니다. </p>

							<br />
							<input type="text" class="input-text" id="firstPhoneNum" style="width:50px"/> - 
							<input type="text" class="input-text" id="middelePhoneNum" style="width:50px"/> - 
							<input type="text" class="input-text" id="lastPhoneNum" style="width:50px"/>
							<a href="#" class="btn-s-line" onclick="getPhoneAuthNum()">인증번호 받기</a>

							<br /><br />
							<input type="text" class="input-text" id="inputAuthNum" style="width:200px"/>
							<a href="#" class="btn-s-line" onclick="checkAuthNum()">인증번호 확인</a>
						</div>
						<i class="graphic-phon"><span>휴대폰 인증</span></i>
					</div>
				</div>

			</div>
		</div>
	</div>

	<?php include 'include/Footer.php'; ?>
</div>

<script>
	const getPhoneAuthNum = () => {
		$.ajax({
			url: "../sign/getPhoneAuthNum.php", // 클라이언트가 요청을 보낼 서버의 URL 주소
			data: { 
				firstPhoneNum: $("#firstPhoneNum").val(), 
				middelePhoneNum: $("#middelePhoneNum").val(), 
				lastPhoneNum: $("#lastPhoneNum").val(), 
			},                // HTTP 요청과 함께 서버로 보낼 데이터
			type: "POST",                             // HTTP 요청 방식(GET, POST)
			dataType: "text"                         // 서버에서 보내줄 데이터의 타입
		}).done( (res) => {
			console.log("res: ", res);
			alert(res);
		})
	}

	const checkAuthNum = () => {
		$.ajax({
			url: "../sign/checkAuthNum.php", // 클라이언트가 요청을 보낼 서버의 URL 주소
			data: { 
				inputAuthNum: $("#inputAuthNum").val(), 
			},                // HTTP 요청과 함께 서버로 보낼 데이터
			type: "POST",                             // HTTP 요청 방식(GET, POST)
			dataType: "json"                         // 서버에서 보내줄 데이터의 타입
		}).done( (res) => {
			console.log("res: ", res);
			alert(res.message);
			if (res.status) {
				document.location.href='/member/index.php?mode=step_03';
			}
		})
	}
</script>
