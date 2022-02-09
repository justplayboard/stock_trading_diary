<?php
require("config/config.php");
require("lib/db.php");
$conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);

$user_id = $_POST['id'];
$user_pw = $_POST['password'];

if ( empty($user_id) || empty($user_pw)) {
    header("Content-Type: text/html; charset=UTF-8");
    echo "<script>alert('아이디 또는 비밀번호가 빠졌거나 잘못된 접근입니다.');";
    echo "window.location.replace('http://localhost/register.php');</script>";
    exit;
}

$sql="INSERT INTO user VALUES('".$_POST['id']."', '".$_POST['password']."')";
$result = mysqli_query($conn,$sql);
if ($result == true) {
  print "<script language=javascript> alert('회원가입에 성공하셨습니다.'); location.replace('http://localhost/login.php'); </script>";
}
else {
  print "<script language=javascript> alert('회원가입에 실패하셨습니다. 아이디 or 비밀번호를 확인해주세요.'); location.replace('http://localhost/register.php'); </script>";
}
?>
