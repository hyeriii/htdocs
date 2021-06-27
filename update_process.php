<?php
require("config/config.php");
require("lib/db.php");
$conn = db_init($config["host"] , $config["duser"] , $config["dpw"] , $config["dname"]);


$sql = " UPDATE topic SET title = '".$_POST['title']."' , author = '".$_POST['author']."' , description = '".$_POST['description']."' ";

echo  $sql;
?>
