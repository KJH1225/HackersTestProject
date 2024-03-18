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
					<li class="on"><a href="/member/index.php?mode=find_id">아이디 찾기</a></li>
					<li><a href="/member/index.php?mode=find_pass">비밀번호 찾기</a></li>
				</ul>

				<div class="tit-box-h4">
					<h3 class="tit-h4">아이디 찾기 방법 선택</h3>
				</div>

				<dl class="find-box">
					<dt>휴대폰 인증</dt>
					<dd>
						고객님이 회원 가입 시 등록한 휴대폰 번호와 입력하신 휴대폰 번호가 동일해야 합니다.
						<label class="input-sp big">
							<input type="radio" name="radio" onclick="$('#mail_box').hide(); $('#phone_box').show();" />
							<span class="input-txt"></span>
						</label>
					</dd>
				</dl>

				<dl class="find-box">
					<dt>이메일 인증</dt>
					<dd>
						고객님이 회원 가입 시 등록한 이메일 주소와 입력하신 이메일 주소가 동일해야 합니다.
						<label class="input-sp big">
							<input type="radio" name="radio" onclick="$('#mail_box').show(); $('#phone_box').hide();" checked="checked"/>
							<span class="input-txt"></span>
						</label>
					</dd>
				</dl>

				<div class="section-content mt30" id="mail_box">
					<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
						<caption class="hidden">아이디 찾기 개인정보 입력</caption>
						<colgroup>
							<col style="width:15%"/>
							<col style="*"/>
						</colgroup>

						<tbody>
							<form method="post" id="mailForm">
								<tr>
									<th scope="col">성명</th>
									<td><input type="text" class="input-text" name="name" style="width:302px" required/></td>
								</tr>
								<tr>
									<th scope="col">생년월일</th>
									<td>
										<select class="input-sel year" name="year" style="width:148px" required></select>년
										<select class="input-sel month" name="month" style="width:147px" required></select>월
										<select class="input-sel day" name="day" style="width:147px" required></select>일
									</td>
								</tr>
								<tr>
									<th scope="col">이메일주소</th>
									<td>
										<input type="text" class="input-text" name="mailFirst" style="width:138px" required/> @ <input type="text" class="input-text" id="mailLast" name="mailLast" style="width:138px" required/>
										<select class="input-sel" style="width:160px" onchange="$('#mailLast').val($(this).val())">
											<option value="">직접입력</option>
											<option value="naver.com">naver.com</option>
											<option value="gmail.com">gmail.com</option>
											<!-- <option value="">선택입력</option>
											<option value="">선택입력</option> -->
										</select>
										<button type="submit" class="btn-s-tin ml10">인증번호 받기</button>
									</td>
								</tr>
							</form>

							<tr class="trAuth" style="display: none">
								<th scope="col">인증번호</th>
								<td><input type="text" class="input-text" id="inputMailAuth" style="width:478px" required/><button class="btn-s-tin ml10" id="checkMailAuthNum">인증번호 확인</button></td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="section-content mt30" id="phone_box" style="display: none;">
					<table border="0" cellpadding="0" cellspacing="0" class="tbl-col-join">
						<caption class="hidden">아이디 찾기 개인정보 입력</caption>
						<colgroup>
							<col style="width:15%"/>
							<col style="*"/>
						</colgroup>

						<tbody>
							<form method="post" id="phoneForm">
								<tr>
									<th scope="col">성명</th>
									<td><input type="text" class="input-text" name="name" style="width:302px" required/></td>
								</tr>
								<tr>
									<th scope="col">생년월일</th>
									<td>
										<select class="input-sel year" name="year" style="width:148px" required></select>년
										<select class="input-sel month" name="month" style="width:147px" required></select>월
										<select class="input-sel day" name="day" style="width:147px" required></select>일
									</td>
								</tr>
								<tr>
									<th scope="col">핸드폰번호</th>
									<td>
										<input type="text" class="input-text" name="firstPhoneNum" style="width:138px" required/> - 
										<input type="text" class="input-text" name="middelePhoneNum" style="width:138px" required/> -
										<input type="text" class="input-text" name="lastPhoneNum" style="width:138px" required/>
										
										<button type="submit" class="btn-s-tin ml10">인증번호 받기</button>
									</td>
								</tr>
							</form>

							<tr class="trAuth" style="display: none">
								<th scope="col">인증번호</th>
								<td><input type="text" class="input-text" id="inputPhoneAuth" style="width:478px" required/><button class="btn-s-tin ml10" id="checkPhoneAuthNum">인증번호 확인</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready( //생년월일 select태그에 옵션추가
			function () { 
					for (var i = 2024; i > 1920; i--) {
							$('.year').append('<option value="' + i + '">' + i + '</option>');
					}
					for (var i = 1; i < 13; i++) {
							$('.month').append('<option value="' + i + '">' + i + '</option>');
					}
					for (var i = 1; i < 32; i++) {
							$('.day').append('<option value="' + i + '">' + i + '</option>');
					}
			}
	);


	async function getAuthRequest(form, url) { //인증번호 받기
    event.preventDefault();

    // json 변환 및 준비
    const formArray = form.serializeArray();
    const returnArray = {};
    for (var i = 0; i < formArray.length; i++) {
			returnArray[formArray[i]['name']] = formArray[i]['value'].trim();
    }

    try {
			const res = await fetch(url, {
				method: 'post',
				headers: {
					"Content-Type": "application/json; charset=UTF-8",
				},
				body: JSON.stringify(returnArray),
			});
			const data = await res.json();
			console.log("resJSON: ", data);
			alert(data.message);
			if (data.status) {
				$(form.attr('data-target')).show();
				$('.trAuth').show();
			}
    } catch (error) {
			console.log("error: ", error);
    }
	}
	$('#mailForm').submit(async (event) => {
		await getAuthRequest($('#mailForm'), '../user/find/getMailAuthCode.php');
	});
	$('#phoneForm').submit(async (event) => {
		await getAuthRequest($('#phoneForm'), '../user/find/getPhoneAuthCode.php');
	});


	async function checkAuthNum(inputSelector) { //인증번호 확인
    if (!$(inputSelector).val().trim()) {
			alert('인증번호를 입력해주세요!');
			return;
    }

    try {
			const res = await fetch('../user/find/checkFindAuthCode.php', {
				method: 'post',
				headers: {
					"Content-Type": "application/json; charset=UTF-8",
				},
				body: JSON.stringify({ authCode: $(inputSelector).val().trim() }),
			});
			const data = await res.json();
			console.log("resJSON: ", data);
			alert(data.message);
			if (data.status) {
				location.href = "/member/index.php?mode=find_id_complete&id=" + data.id;
			}
    } catch (error) {
			console.log("error: ", error);
    }
	}
	$('#checkMailAuthNum').click(async () => {
    await checkAuthNum('#inputMailAuth');
	});
	$('#checkPhoneAuthNum').click(async () => {
		await checkAuthNum('#inputPhoneAuth');
	});

</script>