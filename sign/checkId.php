
<?php 
	require $_SERVER['DOCUMENT_ROOT'].'/sign/signFunction.php';
	$json = json_decode(file_get_contents('php://input'), true);

	$result = checkId($json["id"]);
	
	$convertJSON = json_encode($result);
	echo $convertJSON;
?>