<?php
session_start();
require("config/config.php");
require("lib/db.php");
$conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  if(!isset($_SESSION['user_id'])) {
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('로그인 페이지로 이동합니다.');";
    echo "window.location.replace('http://localhost/login.php');</script>";
    exit;
  }
  elseif (!isset($_POST['title'])) {
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('삭제할 일지를 선택해 주세요.');";
    echo "window.location.replace('http://localhost/index.php');</script>";
    exit;
  }
  else {
    $sql="DELETE FROM write_stock WHERE user_id='".$_SESSION['user_id']."' AND title='".$_POST['title']."';";
    $result = mysqli_query($conn,$sql);
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('삭제되었습니다.');";
    echo "window.location.replace('http://localhost/index.php');</script>";
    exit;
  }
 ?>
