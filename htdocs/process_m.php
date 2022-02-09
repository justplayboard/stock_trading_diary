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
$sql="DELETE FROM write_stock WHERE user_id='".$_SESSION['user_id']."' AND title='".$title."';";
$result = mysqli_query($conn,$sql);
for ($i=0; $i < count($stock_name); $i++) {
  $sql="INSERT INTO write_stock(user_id, title, stock_name, p_a, p_d, s_a, s_d, profit, p_m) VALUES
    ('".$user_id."', '".$title."', '".$stock_name[$i]."', '".$p_a[$i]."', '".$p_d[$i]."',
    '".$s_a[$i]."', '".$s_d[$i]."', '".$profit[$i]."', '".$p_m[$i]."')";
  $result = mysqli_query($conn,$sql);
}
header('Location: http://localhost/index.php');
 ?>
