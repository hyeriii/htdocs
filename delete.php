<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"] , $config["duser"] , $config["dpw"] , $config["dname"]);




/*settype($_POST['id'], 'integer');
$filtered = array(
  'id'=>mysqli_real_escape_string($conn, $_POST['id'])
);
var_dump ($filtered);
*/
$sql = "
  DELETE
    FROM topic
    WHERE id = '".$_POST['id']."'
";



$result = mysqli_query($conn, $sql);
header('Location: http://localhost/index.php');
exit;

$result = mysqli_query($conn, $sql);
var_dump($result);
$sql = "SELECT * FROM user WHERE name = '".$_POST['author']."'";
$result = mysqli_query($conn, $sql);
//var_dump($row);
//exit ;
//echo $result-> num_rows;
if($result->num_rows == 0){

  $sql = "INSERT INTO user (name, password) VALUES('".$_POST['author']."', '111111')";
  mysqli_query($conn, $sql); //위 sql문을 db로 보내는 명령어 , $result 변수 사용하지 않는 이유는 그때는 그 추가 결과를 받아야 했지만 즉, 조회할때는 결과 받아야함
  // 지금은 그냥 추가가만 하면되기에
  $user_id = mysqli_insert_id($conn);

}else{

  $row = mysqli_fetch_assoc($result);
  $user_id = $row['id'];

}

$sql = "INSERT INTO topic (title,description,author,created) VALUES('".$_POST['title']."', '".$_POST['description']."', '".$user_id."', now())";
$result = mysqli_query($conn, $sql);
header('Location: http://localhost/index.php');

 ?>
