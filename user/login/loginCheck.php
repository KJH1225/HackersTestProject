


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <?php 
  
    $id = $_POST['id'];
    $password = $_POST['password'];
    $idValidate = preg_match("/^[A-Za-z]{1}[A-Za-z0-9]{4,15}$/", $id);
    $passwordValidate = preg_match("/^[a-zA-Z][a-zA-Z0-9]{3,14}$/", $password);
    $errorMessage = "<script>
                      alert('가입된 회원이 아니거나 비밀번호가 틀립니다.'); 
                      history.back(-1);
                    </script>";

    if(!$idValidate || !$passwordValidate) { //이상한 값 입력
      echo $errorMessage;
      exit;
    }
  
    require $_SERVER['DOCUMENT_ROOT'].'/db/dbConnect.php';
    if(mysqli_connect_errno()){ //db연결 실패
      echo $errorMessage;
      exit;
    } 

    $strQuery  = "SELECT userId, userPassword, salt FROM users WHERE userId = '".$id."'"; // 입력한 id랑 같은 id 조회
    $queryResult = mysqli_query($connect, $strQuery); // 쿼리 실행
    if(mysqli_num_rows($queryResult) == 0){ // 같은 id 없음
      echo $errorMessage;
      exit;
    }

    $userData = mysqli_fetch_assoc($queryResult);
    $hashedPassword = hash('sha256', $password.$userData['salt']);
    if($userData['userPassword'] === $hashedPassword) { //비밀번호 비교
      //로그인처리
      session_start();
      $_SESSION['loginUser'] = $userData['userId'];
      if(isset($_SESSION['refer'])) {
          $referer = $_SESSION['refer'];
          echo "<script> location.href='".$referer."'; </script>";
          echo $_SESSION['loginUser'];
      } else {
          echo "<script> location.href='/'; </script>";
      }
    }else { //비밀번호 다름
      echo $errorMessage;
    }

    mysqli_close($connect); // db 연결 종료
  ?>
</body>
</html>