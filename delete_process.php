<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"] , $config["duser"] , $config["dpw"] , $config["dname"]);

settype($_POST['id'], 'integer');
$filtered = array(
  'id'=>mysqli_real_escape_string($conn, $_POST['id'])
);

$sql = "
  DELETE
    FROM topic
    WHERE id = {$filtered['id']}
";

//die($sql);

$result = mysqli_query($conn, $sql);
header('Location: http://localhost/index.php');
//exit;

/*
에러는 절대 사용자가 보게해서는 안됨. 아래 코드는 문제 발생시 웹화면이 아닌 아파치 log 파일에 에러 메세지 출력
if ($result === false){
 echo '처리과정에서 문제 발생, 관리자에게 문의하세요.';
 error_log(mysqli_error($conn)); // 웹 화면상에서 보고싶을때느 print(mysqli_error($conn))
}
else { echo '성공 ';}
*/

 ?>
