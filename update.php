<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"] , $config["duser"] , $config["dpw"] , $config["dname"]);
$result = mysqli_query($conn,'SELECT *FROM topic');

$list = '' ;

while($row = mysqli_fetch_assoc($result)){
//  $escaped_title = htmlspecialchars($row['title']);
//  $list = $list."<li><a herf=\"http://localhost/index.php?id={$row['id']}\">{$escaped_title}</a></li>";
 $list = $list."<li><a href=\"http://localhost/index.php?id={$row['id']}\">" .htmlspecialchars($row['title']). "</a></li>";
}

$article = array(
  'title' => 'Welcome',
  'name'  => '관리자',
  'description' => '사이트에 오신걸 환영합니다. '
);

$update_link = '';

if(empty($_GET['id'])==false){// 아이디값이 없지 않다면, isset($_GET['id'])
  $filtered_id = mysqli_real_escape_string($conn, $_GET['id']); // sql injection 보안
  $sql = "SELECT topic.id, title, name,description FROM topic LEFT JOIN user ON topic.author=user.id WHERE topic.id={$filtered_id}";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);
  $article['title'] = htmlspecialchars($row['title']);
  $article['name'] = htmlspecialchars($row['name']);
  $article['description'] = strip_tags($row['description'], '<a><h1><h2><h3><h4><h5><ul><ol><li>');

  $update_link = '<a href="http://localhost/update.php?id='.$_GET['id'].'" class="btn btn-success  btn-lg">수정</a>';

}

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
</head>
<body id ="target">
  <div class="container">
	<header class="jumbotron text-center">
		<img src="https://s3.ap-northeast-2.amazonaws.com/opentutorials-user-file/course/94.png" alt="생활코딩"class="img-circle" id="logo">
		<h1><a href="http://localhost/index.php">Javascript</a></h1>
	</header>
  <div class="row">

      <nav class="col-md-3">
        <ol class="nav nav-pills nav-stacked">
          <?php echo $list; ?>
        </ol>
      </nav>

      <div class="col-md-9">

        <article>

          <form action="update_process.php" method="post">
              <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

            <div class="form-group">
              <label for="form-title">제목</label>
              <input type="text" class="form-control" name="title" id="form-title" value="<?php echo $article['title']; ?>">
            </div>

            <div class="form-group">
              <label for="form-author">작성자</label>
              <input type="text" class="form-control" name="author" id="form-author" value="<?php echo $article['name']; ?>">
            </div>

            <div class="form-group">
              <label for="form-description">본문</label>
              <textarea class="form-control" rows="10" name="description"  id="form-description" > <?php echo $article['description']; ?></textarea>
            </div>

            <input type="submit" name="name" class="btn btn-default  btn-lg">
          </form>
        </article>
        <hr>
        <div id="control">
          <div class="btn-group" role="group" aria-label="...">
            <input type="button" value="white" onclick="document.getElementById('target').className='white'" class="btn btn-default  btn-lg"/>
            <input type="button" value="black" onclick="document.getElementById('target').className='black'" class="btn btn-default btn-lg"/>
          </div>
          <a href="http://localhost/write.php" class="btn btn-success  btn-lg">쓰기</a>
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
