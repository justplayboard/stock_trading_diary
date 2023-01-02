<!DOCTYPE html>
<?php session_start(); ?>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/style.css">
    <script defer src="http://localhost/script.js"></script>
  </head>
  <body>
    <div id="login" class="jumbotron text-center">
      <div>
        <h2>로그인</h2>
        <br>
      </div>
      <?php if(!isset($_SESSION['user_id'])) { ?>
        <form method="post" action="login_ok.php">
            <p>아이디<input type="text" name="user_id" /></p>
            <p>비밀번호<input type="password" name="user_pw" /></p>
            <p><input type="submit" value="로그인" /></p>
            <p><a href="http://localhost/register.php">회원가입</a></p>
        </form>
        <?php } else {
            $user_id = $_SESSION['user_id'];
            echo "<p>($user_id)님은 이미 로그인하고 있습니다. ";
            echo "<a href=\"http://localhost/index.php\">[돌아가기]</a> ";
            echo "<a href=\"http://localhost/logout.php\">[로그아웃]</a></p>";
        } ?>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  </body>
</html>
