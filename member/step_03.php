<script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
<script src="
https://cdn.jsdelivr.net/npm/jquery-validation@1.20.0/dist/jquery.validate.min.js
"></script>

	<div id="wrap">
		<div id="container" class="container-full">
			<div id="content" class="content">
				<div class="inner">
					<div class="tit-box-h3">
						<h3 class="tit-h3">회원가입</h3>
						<div class="sub-depth">
							<span><i class="icon-home"><span>홈</span></i></span>
							<strong>회원가입</strong>
						</div>
					</div>

					<div class="join-step-bar">
						<ul>
							<li><i class="icon-join-agree"></i> 약관동의</li>
							<li><i class="icon-join-chk"></i> 본인확인</li>
							<li class="last on"><i class="icon-join-inp"></i> 정보입력</li>
						</ul>
					</div>

					<form id="signform">
						<div class="section-content">
							<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
								<caption class="hidden">강의정보</caption>
								<colgroup>
									<col style="width:15%"/>
									<col style="*"/>
								</colgroup>
								<tbody>
									<tr>
										<th scope="col"><span class="icons">*</span>이름</th>
										<td><input type="text" class="input-text" name="name" style="width:302px"/></td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>아이디</th>
										<td>
											<input type="text" class="input-text" id="inputId" name="id" style="width:302px" placeholder="영문자로 시작하는 4~15자의 영문소문자, 숫자"/>
											<input type="button" class="btn-s-tin ml10" onclick="checkId()" value="중복확인">
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>비밀번호</th>
										<td><input type="password" class="input-text" id="password" name="password" style="width:302px" placeholder="8-15자의 영문자/숫자 혼합"/></td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>비밀번호 확인</th>
										<td><input type="password" class="input-text" name="passwordCheck" style="width:302px"/></td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>이메일주소</th>
										<td>
											<input type="text" class="input-text" name="mailFirst" style="width:138px"/> 
											@ 
											<input type="text" class="input-text" id="mailLast" name="mailLast" style="width:138px"/>
											<select class="input-sel" id="mailSelect" style="width:160px" onchange="$('#mailLast').val($(this).val())">
												<option value="">직접입력</option>
												<option value="naver.com">naver.com</option>
												<option value="gmail.com">gmail.com</option>
												<!-- <option value="">선택입력</option>
												<option value="">선택입력</option> -->
											</select>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>휴대폰 번호</th>
										<td>
											<input type="text" class="input-text firstPhoneNum" name="firstPhoneNum" style="width:50px" readonly/> - 
											<input type="text" class="input-text middelePhoneNum" name="middelePhoneNum" style="width:50px" readonly/> - 
											<input type="text" class="input-text lastPhoneNum" name="lastPhoneNum" style="width:50px" readonly/>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons"></span>일반전화 번호</th>
										<td>
											<input type="text" class="input-text" name="firstTelNum" style="width:88px"/> - 
											<input type="text" class="input-text" name="middeleTelNum" style="width:88px"/> - 
											<input type="text" class="input-text" name="lastTelNum" style="width:88px"/></td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>주소</th>
										<td>
											<p >
												<label>우편번호 <input type="text" class="input-text ml5" id="sample6_postcode" name="postCode" style="width:242px" readonly/></label><input type="button" onclick="sample4_execDaumPostcode()" class="btn-s-tin ml10" value="주소찾기">
											</p>
											<p class="mt10">
												<label>기본주소 <input type="text" class="input-text ml5" id="sample6_address" name="address" style="width:719px"/></label>
											</p>
											<p class="mt10">
												<label>상세주소 <input type="text" class="input-text ml5" id="sample6_detailAddress" name="detailAddress" style="width:719px"/></label>
											</p>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>SMS수신</th>
										<td>
											<div class="box-input">
												<label class="input-sp">
													<input type="radio" name="smsRadio" value="1" checked="checked"/>
													<span class="input-txt">수신함</span>
												</label>
												<label class="input-sp">
													<input type="radio" name="smsRadio" value="0"/>
													<span class="input-txt">미수신</span>
												</label>
											</div>
											<p>SMS수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
										</td>
									</tr>
									<tr>
										<th scope="col"><span class="icons">*</span>메일수신</th>
										<td>
											<div class="box-input">
												<label class="input-sp">
													<input type="radio" name="mailRadio" value="1" checked="checked"/>
													<span class="input-txt">수신함</span>
												</label>
												<label class="input-sp">
													<input type="radio" name="mailRadio" value="0" />
													<span class="input-txt">미수신</span>
												</label>
											</div>
											<p>메일수신 시, 해커스의 혜택 및 이벤트 정보를 받아보실 수 있습니다.</p>
										</td>
									</tr>
								</tbody>
							</table>
	
							<div class="box-btn">
								<input type="submit" class="btn-l" value="회원가입">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>



<script>
	let idCheck = false; // id 중복검사 했는지

	$( function() { //이전 페이지 핸드폰 번호 불러와서 집어넣기 
		$.ajax({
			url: "../user/sign/getPhoneNum.php", // 클라이언트가 요청을 보낼 서버의 URL 주소
			type: "POST",           
			dataType: "json"          
		}).done( (res) => {
			console.log("res: ", res);
			$('.firstPhoneNum').val(res.firstPhoneNum);
			$('.middelePhoneNum').val(res.middelePhoneNum);
			$('.lastPhoneNum').val(res.lastPhoneNum);
		});
	});

	const checkId = async () => { // id 중복 확인 함수
		try {
			if (!$("#inputId").val()) {
				alert('아이디를 입력해주세요');
				return;
			}

			const res = await fetch('../user/sign/checkId.php', {
				method: 'POST',
				body: JSON.stringify({id: $("#inputId").val()}),
			})
			const data = await res.json();

			if(data.status){
				idCheck = true;
			}
			console.log(data);
			alert(data.message);
		} catch (error) {
			console.log("에러: ", error); 
		}
	}


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
				document.getElementById('sample6_postcode').value = data.zonecode;
				document.getElementById("sample6_address").value = addr;
				// 커서를 상세주소 필드로 이동한다.
				document.getElementById("sample6_detailAddress").focus();
			}
		}).open();
	}

	//유효성검사
	$.validator.addMethod("regex", function(value, element, regexpr) {  // 정규식 유효성 검사 추가        
		return regexpr.test(value);
	});
	$('#signform').validate({
		rules:{ //유효성검사 룰
			name: {
				required: true,
				rangelength: [2, 10]
			},
			id: {
				required: true,
				regex: /^[A-Za-z]{1}[A-Za-z0ii-9]{4,15}$/,
			},
			password: {
				required: true,
				regex: /^[a-zA-Z][a-zA-Z0-9]{3,14}$/,
			},
			passwordCheck: {
				required: true,
				regex: /^[a-zA-Z][a-zA-Z0-9]{3,14}$/,
				equalTo: "#password"
			},
			mailFirst: {
				required: true,
			},
			mailLast: {
				required: true,
			},
			firstPhoneNum: {
				required: true,
				number: true
			},
			middelePhoneNum: {
				required: true,
				number: true
			},
			lastPhoneNum: {
				required: true,
				number: true
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
			name: {
				required: "이름은 최소 2글자 이상 10글자 이하로 입력하세요.",
			},
			id: {
				required: "id는 영문자로 시작하는 4~15자의 영문소문자, 숫자를 입력하세요.",
			},
			password: {
				required: "비밀번호는 8-15자의 영문자/숫자 혼합으로 입력하세요.",
			},
			passwordCheck: {
				required: "비밀번호는 8-15자의 영문자/숫자 혼합으로 입력하세요. ",
				equalTo: "비밀번호 및 비밀번호 확인이 일치하지 않습니다."
			},
			mailFirst: {
				required: "이메일을 입력하세요",
			},
			mailLast: {
				required: "이메일을 입력하세요",
			},
			firstPhoneNum: {
				required: "핸드폰 번호를 입력하세요.",
			},
			middelePhoneNum: {
				required: "핸드폰 번호를 입력하세요.",
			},
			lastPhoneNum: {
				required: "핸드폰 번호를 입력하세요.",
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

			if(idCheck === false){ //아이디 중복 검사 했는지 확인
				alert('아이디 중복확인 해주세요!');
				return
			}

			// json변환 밑준비
			const formArray = $(form).serializeArray(); 
			const returnArray = {};
			for (var i = 0; i < formArray.length; i++){
					returnArray[formArray[i]['name']] = formArray[i]['value'];
			}
			
			try {
				const res = await fetch('../user/sign/userSign.php', {
					method: 'POST',
					headers: {
						"Content-Type": "application/json; charset=UTF-8",
					},
					body: JSON.stringify(returnArray),
				});
				const data = await res.json();
				console.log("resJSON: ", data);
				if (data.status) { //회원가입 성공! 리다이렉션
					document.location.href=data.url;
				} else { //가입 실패 알람
					alert(data.message);
				}
			} catch (error) {
				console.log("에러: ", error); 
			}
		}
	});
</script>