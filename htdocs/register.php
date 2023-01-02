<?php
require("config/config.php");
require("lib/db.php");
$conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
  	<meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <link rel="stylesheet" type="text/css" href="http://localhost/style.css">
    <script defer src="http://localhost/script.js"></script>
		<script>
			function checkid(){
				var userid = document.getElementById("userid").value;
				if(userid)
				{
					url = "check.php?userid="+userid;
					window.open(url,"chkid","width=300,height=100");
				}else{
					alert("아이디를 입력하세요");
				}
			}
		</script>
		<script type="text/javascript">
    	function test() {
      	var p1 = document.getElementById('userpd').value;
      	var p2 = document.getElementById('userpd0').value;
				if((p1.length < 6) || (p1.length > 15)) {
          alert('입력한 글자가 6글자 이상, 15글자 이하이어야 합니다.');
          return false;
        }
      	if( p1 != p2 ) {
        	alert("비밀번호가 일치 하지 않습니다");
        	return false;
      	}
				else{
        	alert("비밀번호가 일치합니다");
        	return true;
      	}
    	}
    </script>
  </head>
  <body>
    <div id="register" class="jumbotron text-center">
      <div>
        <h2>회원가입</h2>
      </div>
      <br>
      <form class="" action="process_r.php" method="post">
        <div>
          <label for="userid">아이디</label>
          <input type="text" class="form-control check" id="userid" name="id" placeholder="id">
          <br>
          <input type="button" value="중복확인" onclick="checkid()">
        </div>
        <br>
        <div>
          <label for="userpd">비밀번호</label>
          <input type="password" class="form-control" name="password" id="userpd" placeholder="password">
        </div>
        <br>
        <div>
          <label for="userpd0">비밀번호 확인</label>
          <input type="password" class="form-control" id="userpd0" placeholder="password">
        </div>
			  <br>
			  <div>
				  <input type="button" value="비밀번호 확인" onclick="test()">
			  </div>
        <br>
        <div>
          <input type="submit" value="가입">
        </div>
      </form>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
  </body>
</html>
