<script src="
https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js
"></script>

<div id="wrap">
	<div id="container" class="container-full">
		<div id="content" class="content">
			<div class="inner">
				<div class="tit-box-h3">
					<h3 class="tit-h3">아이디/비밀번호 찾기</h3>
					<div class="sub-depth">
						<span><i class="icon-home"><span>홈</span></i></span>
						<strong>아이디/비밀번호 찾기</strong>
					</div>
				</div>

				<ul class="tab-list">
					<li><a href="/member/index.php?mode=find_id">아이디 찾기</a></li>
					<li class="on"><a href="/member/index.php?mode=find_pass">비밀번호 찾기</a></li>
				</ul>

				<div class="tit-box-h4">
					<h3 class="tit-h4">비밀번호 재설정</h3>
				</div>

				<div class="section-content mt30">
					<form id="newPasswordForm">
						<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
							<caption class="hidden">비밀번호 재설정</caption>
							<colgroup>
								<col style="width:17%"/>
								<col style="*"/>
							</colgroup>
							<tbody>
								<tr>
									<th scope="col">신규 비밀번호 입력</th>
									<td><input type="password" class="input-text" id="newPassword" name="newPassword" placeholder="영문자로 시작하는 4~15자의 영문소문자,숫자" style="width:302px" /></td>
								</tr>
								<tr>
									<th scope="col">신규 비밀번호 재확인</th>
									<td><input type="password" class="input-text" name="newPasswordCheck" style="width:302px" /></td>
								</tr>
							</tbody>
						</table>
						<div class="box-btn">
							<input type="submit" class="btn-l" value="확인">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
		//유효성검사
	$.validator.addMethod("regex", function(value, element, regexpr) {  // 정규식 유효성 검사 추가        
		return regexpr.test(value);
	});
	$('#newPasswordForm').validate({
		rules:{ //유효성검사 룰
			newPassword: {
				required: true,
				regex: /^[a-zA-Z][a-zA-Z0-9]{3,14}$/,
			},
			newPasswordCheck: {
				required: true,
				regex: /^[a-zA-Z][a-zA-Z0-9]{3,14}$/,
				equalTo: "#newPassword",
			},
		},
		messages: { //에러 메세지 정의
			newPassword: {
				required: "비밀번호는 8-15자의 영문자/숫자 혼합으로 입력하세요.",
			},
			newPasswordCheck: {
				required: "비밀번호는 8-15자의 영문자/숫자 혼합으로 입력하세요.",
				equalTo: "비밀번호 및 비밀번호 확인이 일치하지 않습니다."
			},
		},
		errorPlacement: function(error, element){ //비워 놓으면 에러 메세지 라벨 안나옴
			// element.parent().after(error); //이런식으로 위치 조정 가능
		},
		invalidHandler: function (form, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				alert(validator.errorList[0].message); //에러메세지는 알러트로 띄움
				validator.errorList[0].element.focus(); //에러난 곳으로 포커스
			}
		},
		submitHandler: async function(form, event) { // 유효성검사 통과 했을때 실행될 함수
			event.preventDefault();

			// json변환 밑준비
			const formArray = $(form).serializeArray(); 
			const returnArray = {};
			for (var i = 0; i < formArray.length; i++){
					returnArray[formArray[i]['name']] = formArray[i]['value'];
			}
			console.log(returnArray);
			
			// try {
			// 	const res = await fetch('../user/sign/userSign.php', {
			// 		method: 'POST',
			// 		headers: {
			// 			"Content-Type": "application/json; charset=UTF-8",
			// 		},
			// 		body: JSON.stringify(returnArray),
			// 	});
			// 	const data = await res.json();
			// 	console.log("resJSON: ", data);
			// 	if (data.status) { //회원가입 성공! 리다이렉션
			// 		document.location.href=data.url;
			// 	} else { //가입 실패 알람
			// 		alert(data.message);
			// 	}
			// } catch (error) {
			// 	console.log("에러: ", error); 
			// }
			return false;
		}
	});
</script>