<?php 
	require $_SERVER['DOCUMENT_ROOT'].'/user/login/loginStatus.php';
	if ( $loginStatus !== true) {
		echo "<script>
						alert('로그인해주세요!'); 
						location.href='/index.php';
					</script>";
	} 
?>

	<div id="wrap">
		<div id="container" class="container-full">
			<div id="content" class="content">
				<div class="inner">
					<div class="tit-box-h3">
						<h3 class="tit-h3">내정보수정</h3>
						<div class="sub-depth">
							<span><i class="icon-home"><span>홈</span></i></span>
							<strong>내정보수정</strong>
						</div>
					</div>
					<div class="section-content">
						<form id="modifyForm">
							<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
								<caption class="hidden">강의정보</caption>
								<colgroup>
									<col style="width:15%"/>
									<col style="*"/>
								</colgroup>
								<tbody>
									<tr>
										<th scope="col"><span class="icons">*</span>이름</th>
										<td id="userName"></td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>아이디</th>
										<td id="userId"></td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>비밀번호</th>
										<td>
											<input type="password" class="input-text" name="password" style="width:302px" placeholder="8-15자의 영문자/숫자 혼합"/>
											<input type="button" class="btn-s-tin ml10" value="비밀번호 변경">
										</td>
									</tr>
									<!-- <tr>
										<th scope="col"><span class="icons">*</span>비밀번호 확인</th>
										<td><input type="password" class="input-text" style="width:302px"/></td>
									</tr> -->
									<tr>
										<th scope="col"><span class="icons">*</span>이메일주소</th>
										<td>
											<input type="text" class="input-text" id="mailFirst" name="mailFirst" style="width:138px"/> @ <input type="text" class="input-text" id="mailLast" name="mailLast" style="width:138px"/>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>휴대폰 번호</th>
										<td>
											<span id="firstPhoneNum"></span> -
											<span id="middelePhoneNum"></span> -
											<span id="lastPhoneNum"></span>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons"></span>일반전화 번호</th>
										<td>
											<input type="text" class="input-text" id="firstTelNum" name="firstTelNum" style="width:88px"/> - 
											<input type="text" class="input-text" id="middeleTelNum" name="middeleTelNum" style="width:88px"/> - 
											<input type="text" class="input-text" id="lastTelNum" name="lastTelNum" style="width:88px"/>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>주소</th>
										<td>
											<p>
												<label>우편번호 <input type="text" class="input-text ml5" id="postCode" name="postCode" style="width:242px" readonly/></label><input type="button" onclick="sample4_execDaumPostcode()" class="btn-s-tin ml10" value="주소찾기">
											</p>
											<p class="mt10">
												<label>기본주소 <input type="text" class="input-text ml5" id="address" name="address" style="width:719px"/></label>
											</p>
											<p class="mt10">
												<label>상세주소 <input type="text" class="input-text ml5" id="detailAddress" name="detailAddress" style="width:719px"/></label>
											</p>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>SMS수신</th>
										<td>
											<div class="box-input" id="smsBox">
												<label class="input-sp">
													<input type="radio"  name="smsRadio" id="1" value="1"/>
													<span class="input-txt">수신함</span>
												</label>
												<label class="input-sp">
													<input type="radio" name="smsRadio" id="0" value="0"/>
													<span class="input-txt">미수신</span>
												</label>
											</div>
											<p>SMS수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>메일수신</th>
										<td>
											<div class="box-input" id="mailBox">
												<label class="input-sp">
													<input type="radio" name="mailRadio" id="1" value="1"/>
													<span class="input-txt">수신함</span>
												</label>
												<label class="input-sp">
													<input type="radio" name="mailRadio" id="0" value="0"/>
													<span class="input-txt">미수신</span>
												</label>
											</div>
											<p>메일수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
										</td>
									</tr>
								</tbody>
							</table>
							<div class="box-btn">
								<button type="submit" class="btn-l">정보수정</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
	<script>
		$(
			function () {
					fetch('../user/modify/getModify.php', {
						method: 'POST',
						headers: {
							"Content-Type": "application/json; charset=UTF-8",
						},
						// body: JSON.stringify({test: 'test'}),
					})
					.then(res => res.json())
					.then(data => {
						console.log("data: ", data);
						for (let key in data) {
							$(`#${key}`).val(data[key]);
						}
						$("#userId").text(data["userId"]);
						$("#userName").text(data["userName"]);
						$("#firstPhoneNum").text(data["firstPhoneNum"]);
						$("#middelePhoneNum").text(data["middelePhoneNum"]);
						$("#lastPhoneNum").text(data["lastPhoneNum"]);
						$("#smsBox").find(`#${data["smsStatus"]}`).prop("checked", true);
						$("#mailBox").find(`#${data["mailStatus"]}`).prop("checked", true);
					})
					.catch(error => console.log('error발생: ', error));
			}
		);
		
		const sample4_execDaumPostcode = () => { //다음 주소
			new daum.Postcode({
				oncomplete: function(data) {
					var addr = ''; // 주소 변수

					//사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
					if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
						addr = data.roadAddress;
					} else { // 사용자가 지번 주소를 선택했을 경우(J)
						addr = data.jibunAddress;
					}

					// 우편번호와 주소 정보를 해당 필드에 넣는다.
					document.getElementById('postCode').value = data.zonecode;
					document.getElementById("address").value = addr;
					// 커서를 상세주소 필드로 이동한다.
					document.getElementById("detailAddress").focus();
				}
			}).open();
		}

		//유효성검사
	$.validator.addMethod("regex", function(value, element, regexpr) {  // 정규식 유효성 검사 추가        
		return regexpr.test(value);
	});
	$('#modifyForm').validate({
		rules:{ //유효성검사 룰
			password: {
				required: true,
				regex: /^[a-zA-Z][a-zA-Z0-9]{3,14}$/,
			},
			mailFirst: {
				required: true,
			},
			mailLast: {
				required: true,
			},
			firstTelNum: {
				number: true
			},
			middeleTelNum: {
				number: true
			},
			lastTelNum: {
				number: true
			},
			postCode: {
				required: true,
			},
			address: {
				required: true,
			},
			detailAddress: {
				required: true,
			},
			smsRadio: {
				required: true,
			},
			mailRadio: {
				required: true,
			},
		},
		messages: { //에러 메세지 정의
			password: {
				required: "비밀번호를 입력하세요",
				regex: "비밀번호 양식이 잘못되었습니다.",
			},
			mailFirst: {
				required: "이메일을 입력하세요",
			},
			mailLast: {
				required: "이메일을 입력하세요",
			},
			firstTelNum: {
				required: "일반전화는 숫자만 입력 가능합니다.",
			},
			middeleTelNum: {
				required: "일반전화는 숫자만 입력 가능합니다.",
			},
			lastTelNum: {
				required: "일반전화는 숫자만 입력 가능합니다.",
			},
			postCode: {
				required: "주소를 입력하세요",
			},
			address: {
				required: "주소를 입력하세요",
			},
			detailAddress: {
				required: "상세주소를 입력하세요",
			},
			smsRadio: {
				required: "sms 수신 여부를 선택하세요",
			},
			mailRadio: {
				required: "메일 수신 여부를 선택하세요",
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

			// console.log(returnArray);
			
			try {
				const res = await fetch('../user/modify/userModify.php', {
					method: 'POST',
					headers: {
						"Content-Type": "application/json; charset=UTF-8",
					},
					body: JSON.stringify(returnArray),
				});
				const data = await res.json();
				console.log("resJSON: ", data);
				alert(data.message);
				// if (data.status) { //회원가입 성공! 리다이렉션
				// 	document.location.href='/';
				// }
			} catch (error) {
				console.log("에러: ", error); 
			}
		}
	});
	</script>
