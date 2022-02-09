<?php
session_start();
require("config/config.php");
require("lib/db.php");
$conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$stock_name = $_POST['stock_name'];
$p_a = $_POST['p_a'];
$p_d = $_POST['p_d'];
$s_a = $_POST['s_a'];
$s_d = $_POST['s_d'];
$profit = $_POST['profit'];
$p_m = $_POST['p_m'];
$sql="SELECT * FROM write_stock WHERE user_id='".$user_id."' AND title='".$title."';";
$result = mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if (isset($row)) {
  header("Content-Type: text/html; charset=UTF-8");
  echo "<script>alert('같은 제목의 일지가 존재합니다.');";
  echo "window.location.replace('http://localhost/write_stock_trading_diary.php');</script>";
  exit;
}
for ($i=0; $i < count($stock_name); $i++) {
  $sql="INSERT INTO write_stock(user_id, title, stock_name, p_a, p_d, s_a, s_d, profit, p_m) VALUES
    ('".$user_id."', '".$title."', '".$stock_name[$i]."', '".$p_a[$i]."', '".$p_d[$i]."',
    '".$s_a[$i]."', '".$s_d[$i]."', '".$profit[$i]."', '".$p_m[$i]."')";
  $result = mysqli_query($conn,$sql);
  if ($result==false) {
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('입력되지 않은 칸이 존재합니다. 다시 작성해 주세요.');";
    echo "window.location.replace('http://localhost/write_stock_trading_diary.php');</script>";
    exit;
  }
}
header('Location: http://localhost/index.php');
 ?>
