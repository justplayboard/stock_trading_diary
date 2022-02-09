<?php
require("config/config.php");
require("lib/db.php");
$conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);

$user_id = $_POST['user_id'];
$user_pw = $_POST['user_pw'];

    if ( empty($user_id) || empty($user_pw)) {
        header("Content-Type: text/html; charset=UTF-8");
        echo "<script>alert('아이디 또는 비밀번호가 빠졌거나 잘못된 접근입니다.');";
        echo "window.location.replace('http://localhost/login.php');</script>";
        exit;
    }

    $sql="SELECT * FROM user WHERE id='".$_POST['user_id']."';";
    $result=mysqli_query($conn,$sql);
    $result=mysqli_fetch_array($result);

    if( ($user_id != $result['id']) || ($result['password'] != $user_pw) ) {
        header("Content-Type: text/html; charset=UTF-8");
        echo "<script>alert('아이디 또는 비밀번호가 잘못되었습니다.');";
        echo "window.location.replace('http://localhost/login.php');</script>";
        exit;
    }
    /* If success */
    session_start();
    $_SESSION['user_id'] = $user_id;
?>
<meta http-equiv="refresh" content="0;url=http://localhost/index.php" />
