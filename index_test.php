<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"], $config["duser"], $config["dpw"], $config["dname"]);
$result = mysqli_query($conn,'SELECT *FROM topic');

function print_body(){
  if(empty($_GET['id'])==false){// 아이디값이 없지 않다면

    $sql = "SELECT topic.id, title, name,description FROM topic LEFT JOIN user ON topic.author=user.id WHERE topic.id=".$_GET['id'];
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
    echo '<p>'.htmlspecialchars($row['name']).'</p>';
    echo strip_tags($row['description'], '<a><h1><h2><h3><h4><h5><ul><ol><li>');
  }

};


function print_title (){
print_body();
 echo strip_tags($row['description'], '<a><h1><h2><h3><h4><h5><ul><ol><li>');

};
 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <link rel="stylesheet" type="text/css" href="http://localhost/style.css">

  <link href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css" rel="stylesheet">
</head>
  <title>
  <?php print_title();  ?>
  </title>
<body id ="target">
  <div class="container">

	<header class="jumbotron text-center">
		<img src="https://s3.ap-northeast-2.amazonaws.com/opentutorials-user-file/course/94.png" alt="생활코딩" class="img-circle" id ="logo">
		<h1><a href="http://localhost/index_test.php">Javascript</a></h1>
	</header>

<div class="row">
  <nav class ="col-md-3">
    <ol class="nav nav-pills nav-stacked">
      <?php
      while($row = mysqli_fetch_assoc($result)){

        echo '<li><a href="http://localhost/index_test.php?id='.$row['id'].'">'. htmlspecialchars($row['title']).'</a></li>'."\n";

      }

       ?>
    </ol>
  </nav>

  <div class="col-md-9">

    <article>
     <?php print_body();
    /* if(empty($_GET['id'])==false){// 아이디값이 없지 않다면

       $sql = "SELECT topic.id, title, name,description FROM topic LEFT JOIN user ON topic.author=user.id WHERE topic.id=".$_GET['id'];
       $result = mysqli_query($conn,$sql);
       $row = mysqli_fetch_assoc($result);
       echo '<h2>'.htmlspecialchars($row['title']).'</h2>';
       echo '<p>'.htmlspecialchars($row['name']).'</p>';
       echo strip_tags($row['description'], '<a><h1><h2><h3><h4><h5><ul><ol><li>');
       //echo strip_tags($row['description'], '<a><h1><h2><h3><h4><h5><ol><ul><li>');
     }*/
      ?>
    </article>
    <hr>
    <div id="control">
      <div class="btn-group" role="group" aria-label="...">
      <input type="button" value="white" onclick="document.getElementById('target').className='white'" class="btn btn-default  btn-lg"/>
      <input type="button" value="black" onclick="document.getElementById('target').className='black'" class="btn btn-default  btn-lg" />
    </div>
    <a href="http://localhost/write.php" class="btn btn-success  btn-lg">쓰기</a>

      <form  action="delete.php" method="post" >
          <input type="hidden" name="id" value="<?=$_GET['id']?>">
          <input type="submit" value="삭제" class="btn btn-success  btn-lg">

      </form>

    </div>
  </div>
</div>

</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
</body>
</html>
