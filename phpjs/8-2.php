<!DOCTYPE html>
<html>
<head>
     <meta charset="utf-8">
</head>
<body>
  <?php
    $password = $_GET["password"];
    if($password == "1111"){
        echo "주인님 환영합니다";
    } else {
        echo "잘못된 정보입니다";
    }
   ?>
</body>
</html>
