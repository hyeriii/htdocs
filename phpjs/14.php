<?php
$conn = mysqli_connect('localhost','root','436200'); // 서버접속
mysqli_select_db($conn, 'opentutorials');
$name =  mysqli_real_escape_string($conn, $_GET['name']); // php 내장함수
$password =  mysqli_real_escape_string($conn, $_GET['password']); // php 내장함수
$sql = "SELECT * FROM user WHERE name='".$name."' AND password='".$password."'";
echo $sql;
$result = mysqli_query($conn,$sql);

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
</head>
<body>
  <?php
  if ($result->num_rows == "0"){
		echo"누구세요?";
  } else {
		echo"환영합니다.";
  }
   ?>
</body>
</html>
