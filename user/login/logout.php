


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title></title>
</head>
<body>
  <?php 
    session_start();
    session_destroy();
    echo "<script> location.href='/'; </script>";
  ?>
</body>
</html>