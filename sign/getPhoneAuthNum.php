<?php
    session_start();

    //핸드폰 유효성검사?
    $_SESSION['authCode'] = '123456';
    $_SESSION['firstPhoneNum'] = $_POST['firstPhoneNum'];
    $_SESSION['middelePhoneNum'] = $_POST['middelePhoneNum'];
    $_SESSION['lastPhoneNum'] = $_POST['lastPhoneNum'];

    echo "인증번호를 입력해주세요!".$_SESSION['firstPhoneNum'];
?>