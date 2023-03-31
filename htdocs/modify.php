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
    // 로그인 여부 확인 and 로그아웃 버튼 and 수정 일지 확인
			if(!isset($_SESSION['user_id'])) {
				header("Content-Type: text/html; charset=UTF-8");
				echo "<script>alert('로그인 페이지로 이동합니다.');";
				echo "window.location.replace('http://localhost/login.php');</script>";
				exit;
			}
      elseif (!isset($_POST['m_value'])) {
        header("Content-Type: text/html; charset=UTF-8");
				echo "<script>alert('수정할 일지를 선택해 주세요.');";
				echo "window.location.replace('http://localhost/index.php');</script>";
				exit;
      }
			else {
				$user_id = $_SESSION['user_id'];
				echo "<p style='float: right;'><a href=\"http://localhost/logout.php\" class=\"btn btn-primary btn-lg\">로그아웃</a></p>";
			}
		 ?>
		<header class="jumbotron text-center">
			<h1 style="font-family: 'Black Han Sans', serif;"><a href="http://localhost/index.php">주식매매일지</a></h1>
		</header>
		<div class="w-auto">
			<article>
				<button name="add_row" class="btn btn-default btn-lg pull-right">행추가</button>
				<br>
				<form class="" method="post">
					<div class="form-group">
						<label for="form-title" name="title" id="title">제목(제목 수정 시 새로 생성)</label>
            <?php
            // 수정 일지 추출 및 표시
              $sql="SELECT title, stock_name, p_a, p_d, s_a, s_d, profit, p_m FROM write_stock WHERE user_id='".$_SESSION['user_id']."' AND title='".$_POST['m_value']."';";
              $result = mysqli_query($conn,$sql);
              if ($row=mysqli_fetch_assoc($result)) {
                echo '
                <input type="text" name="title" class="form-control" id="form-title" placeholder="제목을 적어주세요." value="',$row['title'],'" required>
                ';
             ?>
					</div>
					<div class="form-group table-responsive">
						<table class="type09" id="t">
	            <thead>
	              <tr>
	                <th scope="cols">주식명</th>
	                <th scope="cols">매수금액</th>
	                <th scope="cols">매수날짜</th>
	                <th scope="cols">매도금액</th>
	                <th scope="cols">매도날짜</th>
	                <th scope="cols">이익금</th>
	                <th scope="cols">이익률</th>
	              </tr>
	            </thead>
	            <tbody id="tbody">
    						<tr name="stock">
                  <?php
                    $count = 0;
                    echo '
                    <td><input type="text" name="stock_name[]" class="stock_input" placeholder="주식명" value=',$row['stock_name'],' required></td>
                    <td><input type="text" name="p_a[]" class="stock_input" id="p_a_',$count,'" placeholder="숫자만 입력" value=',number_format($row['p_a']),' onkeyup="tLS(this); autocal(',$count,');" required></td>
                    <td><input type="date" name="p_d[]" class="stock_input" value=',$row['p_d'],' required></td>
                    <td><input type="text" name="s_a[]" class="stock_input" id="p_a_',$count,'" placeholder="숫자만 입력" value=',number_format($row['s_a']),' onkeyup="tLS(this); autocal(',$count,');" required></td>
                    <td><input type="date" name="s_d[]" class="stock_input" value=',$row['s_d'],' required></td>
                    <td><input type="text" name="profit[]" class="stock_input" id="profit_',$count,'" value=',number_format($row['profit']),' required readonly"></td>
                    <td><div class="input-group"><input type="text" name="p_m[]" class="stock_input" id="p_m_',$count,'" value=',$row['p_m'],' style="width: 93px;" required readonly><div class="input-group-addon">%</div></div></td>
                    </tr>';
              }
              while ($row=mysqli_fetch_assoc($result)) {
                $count = $count + 1;
                echo '
                <tr name="stock">
                <td><input type="text" name="stock_name[]" class="stock_input" placeholder="주식명" value=',$row['stock_name'],' required></td>
                <td><input type="text" name="p_a[]" class="stock_input" id="p_a_',$count,'" placeholder="숫자만 입력" value=',number_format($row['p_a']),' onkeyup="tLS(this); autocal(',$count,');" required></td>
                <td><input type="date" name="p_d[]" class="stock_input" value=',$row['p_d'],' required></td>
                <td><input type="text" name="s_a[]" class="stock_input" id="p_a_',$count,'" placeholder="숫자만 입력" value=',number_format($row['s_a']),' onkeyup="tLS(this); autocal(',$count,');" required></td>
                <td><input type="date" name="s_d[]" class="stock_input" value=',$row['s_d'],' required></td>
                <td><input type="text" name="profit[]" class="stock_input" id="profit_',$count,'" value=',number_format($row['profit']),' required readonly"></td>
                <td><div class="input-group"><input type="text" name="p_m[]" class="stock_input" id="p_m_',$count,'" value=',$row['p_m'],' style="width: 93px;" required readonly><div class="input-group-addon">%</div></div></td>
                <td><button name="delete_row" class="btn btn-default">행삭제</button></td>
                </tr>';
              }
                   ?>
	            </tbody>
	          </table>
						<script>
              <?php echo "var count = $count;"; ?>
							$(document).on("click","button[name=add_row]",function(){
                count = count + 1;
                var rowItem = `<tr name="stock">` +
                '<td><input type="text" name="stock_name[]" class="stock_input" placeholder="주식명" required></td>' +
		            `<td><input type="text" name="p_a[]" class="stock_input" id="p_a_${count}" placeholder="숫자만 입력" onkeyup="tLS(this); autocal(${count});" required></td>` +
		            '<td><input type="date" name="p_d[]" class="stock_input" required></td>' +
		            `<td><input type="text" name="s_a[]" class="stock_input" id="s_a_${count}" placeholder="숫자만 입력" onkeyup="tLS(this); autocal(${count});" required></td>` +
		            '<td><input type="date" name="s_d[]" class="stock_input" required></td>' +
		            `<td><input type="text" name="profit[]" class="stock_input" id="profit_${count}" required readonly></td>` +
		            `<td><div class="input-group"><input type="text" name="p_m[]" class="stock_input" id="p_m_${count}" style="width: 93px;" required readonly><div class="input-group-addon">%</div></div></td>` +
								'<td><button name="delete_row" class="btn btn-default">행삭제</button></td>' +
		            '</tr>';
								var trHtml = $("tr[name=stock]:last");
								trHtml.after(rowItem);
							});
							$(document).on("click","button[name=delete_row]",function(){
								var trHtml = $(this).parent().parent();
								trHtml.remove();
							});
						</script>
					</div>
          <div>
            <input type="submit" id="submit" name="name" class="btn btn-default btn-lg" onclick="javascript: form.action='process_m.php';">
          </div>
			    <hr style="width: 100%;">
			    <div id="control">
            <div class="btn-group" role="group" aria-label="...">
              <input type="button" value="white" id="white_btn" class="btn btn-default btn-lg" onclick="color();"/>
              <input type="button" value="black" id="black_btn" class="btn btn-default btn-lg" onclick="color();"/>
				    </div>
			      <a href="http://localhost/write_stock_trading_diary.php" class="btn btn-danger btn-lg">쓰기</a>
            <input type="submit" value="삭제" class="btn btn-success btn-lg" onclick="javascript: form.action='delete_m.php';">
			    </div>
        </form>
      </article>
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
