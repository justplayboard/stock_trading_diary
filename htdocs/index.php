<?php
require("config/config.php");
require("lib/db.php");
$conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
$result = mysqli_query($conn,"SELECT * FROM write_stock;");
 ?>
<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Black+Han+Sans&display=swap" rel="stylesheet">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://localhost/style.css?after">
	<link rel="stylesheet" href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css">
  <script src="http://localhost/script.js"></script>
  <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body id="target">
	<div class="container">
		<?php
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
			<h1 style="font-family: 'Black Han Sans', sans-serif;"><a href="http://localhost/index.php">주식매매일지</a></h1>
		</header>
		<div class="row">
			<div class="w-auto">
        <form class="" method="post">
			       <?php if (isset($_SESSION['user_id'])) {
			               $sql="SELECT DISTINCT title, `date` FROM write_stock WHERE user_id='".$_SESSION['user_id']."';";
				             $result=mysqli_query($conn, $sql);
				      ?>
				  <h2 style="font-family: 'Black Han Sans', sans-serif; text-align: center;">일지목록</h2>
					<table class="type11" style="margin-left: auto; margin-right: auto;">
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
		      <div id="control" style="float: right;">
			         <div class="btn-group" role="group" aria-label="...">
		               <input type="button"value="white"id="white_btn"class="btn btn-default btn-lg"/>
			             <input type="button"value="black"id="black_btn"class="btn btn-default btn-lg"/>
				       </div>
               <a href="http://localhost/write_stock_trading_diary.php" class="btn btn-danger btn-lg">쓰기</a>
		           <input type="submit" name="modify" value="수정" class="btn btn-warning btn-lg" onclick="javascript: form.action='modify.php'">
               <input type="submit" value="삭제" class="btn btn-success btn-lg" onclick="javascript: form.action='delete.php'">
		         <script src="http://localhost/script.js"></script>
	        </div>
        </form>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	</div>
</body>
</html>
