<?php
  session_start();
  require("config/config.php");
  require("lib/db.php");
  $conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
 ?>
<!DOCTYPE html>
<html>
<head>
  <!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Black+Han+Sans">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <link rel="stylesheet" type="text/css" href="http://localhost/style.css">
  <script defer src="http://localhost/script.js"></script>
</head>
<body id="target">
	<div class="container">
		<?php
    // 로그인 & 회원가입 and 로그아웃 버튼
  		if(!isset($_SESSION['user_id'])) {
  			echo "<p style='float: right;'><a href=\"http://localhost/login.php\" class=\"btn btn-primary btn-lg\">로그인</a>
  			<a href=\"http://localhost/register.php\" class=\"btn btn-info btn-lg\">회원가입</a></p>";
  		}
  		else {
  			$user_id = $_SESSION['user_id'];
  			echo "<p style='float: right;'><a href=\"http://localhost/logout.php\" class=\"btn btn-primary btn-lg\">로그아웃</a></p>";
  		}
		 ?>
		<header class="jumbotron text-center">
			<h1 style="font-family: 'Black Han Sans', serif;"><a href="http://localhost/index.php">주식매매일지</a></h1>
		</header>
		<div class="row">
			<div class="w-auto">
        <form class="" method="post">
          <?php
          // 일지목록 추출 및 표시
            if (isset($_SESSION['user_id'])) {
              $sql="SELECT DISTINCT title, `date` FROM write_stock WHERE user_id='".$_SESSION['user_id']."';";
              $result=mysqli_query($conn, $sql);
           ?>
				  <h2 style="font-family: 'Black Han Sans', serif; text-align: center;">일지목록</h2>
					<table class="type11">
						<thead>
							<tr>
								<th>제목</th>
								<th>작성일</th>
								<th>선택</th>
							</tr>
						</thead>
							<tbody>
									<?php
										while ($row=mysqli_fetch_assoc($result)) {
											echo '<tr><td>'.htmlspecialchars($row['title']).'</td>';
											echo '<td>'.htmlspecialchars($row['date']).'</td>';
											echo "<td><input type='radio' name='m_value' value='".htmlspecialchars($row['title'])."'></td></tr>";
							     }
									 ?>
			        </tbody>
			    </table>
        <?php } ?>
		      <hr>
		      <div id="control">
            <div class="btn-group" role="group" aria-label="...">
              <input type="button" value="white" id="white_btn" class="btn btn-default btn-lg"/>
              <input type="button" value="black" id="black_btn" class="btn btn-default btn-lg"/>
            </div>
            <a href="http://localhost/write_stock_trading_diary.php" class="btn btn-danger btn-lg">쓰기</a>
            <input type="submit" name="modify" value="수정" class="btn btn-warning btn-lg" onclick="javascript: form.action='modify.php'">
            <input type="submit" value="삭제" class="btn btn-success btn-lg" onclick="javascript: form.action='delete.php'">
	        </div>
        </form>
			</div>
		</div>
    <!--start of disqus code-->
    <div id="disqus_thread"></div>
    <script>
      /**
      *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
      *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
      /*
      var disqus_config = function () {
      this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
      this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
      };
      */
      (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://localhost-o0afcunfiz.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
      })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
    <!--end of disqus code-->
	</div>
  <!--disqus comment count js file-->
  <script id="dsq-count-scr" src="//localhost-o0afcunfiz.disqus.com/count.js" async></script>
  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
      var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
      s1.async=true;
      s1.src='https://embed.tawk.to/6039f923385de407571a9f8f/1evh7acu6';
      s1.charset='UTF-8';
      s1.setAttribute('crossorigin','*');
      s0.parentNode.insertBefore(s1,s0);
    })();
  </script>
  <!--End of Tawk.to Script-->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
</body>
</html>
