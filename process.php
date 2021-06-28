<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"] , $config["duser"] , $config["dpw"] , $config["dname"]);

$filtered = array( // sql injection 보안
  'title' => mysqli_real_escape_string($conn, $_POST['title']),
  'author' => mysqli_real_escape_string($conn, $_POST['author']),
  'description' => mysqli_real_escape_string($conn, $_POST['description'])
);

$sql = "SELECT * FROM user WHERE name = '".$filtered['author']."'";
$result = mysqli_query($conn, $sql);
//var_dump($row);
//exit ;
//echo $result-> num_rows;
if($result->num_rows == 0){

  $sql = "
    INSERT INTO user (name, password)
    VALUES('".$filtered['author']."', '111111')";
  mysqli_query($conn, $sql); //위 sql문을 db로 보내는 명령어 , $result 변수 사용하지 않는 이유는 그때는 그 추가 결과를 받아야 했지만 즉, 조회할때는 결과 받아야함
  // 지금은 그냥 추가가만 하면되기에
  $user_id = mysqli_insert_id($conn);

}else{

  $row = mysqli_fetch_assoc($result);
  $user_id = $row['id'];

}

$sql = "INSERT INTO topic (title,description,author,created) VALUES('".$filtered['title']."', '".$filtered['description']."', '".$user_id."', now())";
$result = mysqli_query($conn, $sql);

/*
에러는 절대 사용자가 보게해서는 안됨. 아래 코드는 문제 발생시 웹화면이 아닌 아파치 log 파일에 에러 메세지 출력
if ($result === false){
 echo '처리과정에서 문제 발생, 관리자에게 문의하세요.';
 error_log(mysqli_error($conn));
}
else { echo '성공 ';}
*/
header('Location: http://localhost/index.php');

 ?>
