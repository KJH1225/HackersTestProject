<?php

$dbAddress = "172.16.1.19";
$dbUser = "hackers";
$dbPwd = "Hackers1234!";
$dbName = "hackersHRD";

$connect = mysqli_connect($dbAddress, $dbUser, $dbPwd, $dbName);

if($connect){
	mysqli_set_charset($connect, "utf8");
	
	$strQuery = "CREATE TABLE IF NOT EXISTS users("; 
	$strQuery = $strQuery."id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY UNIQUE, ";
	$strQuery = $strQuery."userName VARCHAR(5) NOT NULL, "; // 사용자 이름
	$strQuery = $strQuery."userId VARCHAR(15) NOT NULL, "; //사용자 id
	$strQuery = $strQuery."userPassword VARCHAR(255) NOT NULL, "; // 암호화한 비밀번호
	$strQuery = $strQuery."salt VARCHAR(255) NOT NULL, "; //비밀번호 암호화 난수
	$strQuery = $strQuery."userMail VARCHAR(100) NOT NULL, "; //메일
	$strQuery = $strQuery."userPhone VARCHAR(300) DEFAULT 0 NOT NULL, "; // 핸드폰
	$strQuery = $strQuery."userTel VARCHAR(300), "; // 집전화
	$strQuery = $strQuery."userAddress VARCHAR(300), "; // 주소
	$strQuery = $strQuery."smsStatus BOOLEAN DEFAULT 0 NOT NULL, "; // sms 수신 여부
	$strQuery = $strQuery."mailStatus BOOLEAN DEFAULT 0 NOT NULL, "; //메일 수신 여부
	$strQuery = $strQuery."UNIQUE INDEX(`userId`)) ";
	$strQuery = $strQuery."DEFAULT CHARACTER SET UTF8 COLLATE UTF8_GENERAL_CI";
	
	
	$connect->query($strQuery);	
	// echo $strQuery;
}
?>