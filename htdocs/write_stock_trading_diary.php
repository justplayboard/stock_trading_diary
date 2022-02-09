<!DOCTYPE html>
<?php session_start(); ?>
<html>
<head>
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Black+Han+Sans&display=swap" rel="stylesheet">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet" type="text/css" href="http://localhost/style.css">
	<link rel="stylesheet" href="http://localhost/bootstrap-3.3.4-dist/css/bootstrap.min.css">
</head>
<body id="target">
	<div class="container">
		<?php
			if(!isset($_SESSION['user_id'])) {
				header("Content-Type: text/html; charset=UTF-8");
				echo "<script>alert('로그인 페이지로 이동합니다.');";
				echo "window.location.replace('http://localhost/login.php');</script>";
				exit;
			}
			else {
				$user_id = $_SESSION['user_id'];
				echo "<p style='float: right;'><a href=\"http://localhost/logout.php\" class=\"btn btn-primary btn-lg\">로그아웃</a></p>";
			}
		 ?>
		<header class="jumbotron text-center">
			<h1 style="font-family: 'Black Han Sans', sans-serif;"><a href="http://localhost/index.php">주식매매일지</a></h1>
		</header>
		<div class="w-auto">
			<script src="http://localhost/script.js"></script>
			<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
			<article>
					<button name="add_row" class="btn btn-default btn-lg pull-right">행추가</button>
				<br>
				<form class="" action="process.php" method="post">
					<div class="form-group">
						<label for="form-title" name="title" id="title">제목</label>
    				<input type="text" class="form-control" name="title" id="form-title" placeholder="제목을 적어주세요.">
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
	                <td><input type="text" name="stock_name[]" placeholder="주식명" id="table"></td>
	                <td><input type="text" name="p_a[]" placeholder="숫자만 입력" id="table"></td>
	                <td><input type="text" name="p_d[]" placeholder="yyyy-mm-dd" id="table"></td>
	                <td><input type="text" name="s_a[]" placeholder="숫자만 입력" id="table"></td>
	                <td><input type="text" name="s_d[]" placeholder="yyyy-mm-dd" id="table"></td>
	                <td><input type="text" name="profit[]" placeholder="숫자만 입력" id="table"></td>
	                <td><input type="text" name="p_m[]" placeholder="숫자만 입력" id="table"></td>
	              </tr>
	            </tbody>
	          </table>
						<script>
							$(document).on("click","button[name=add_row]",function(){
								var rowItem = '<tr name="stock">' +
		            '<td><input type="text" name="stock_name[]" placeholder="주식명" id="table"></td>' +
		            '<td><input type="text" name="p_a[]" placeholder="숫자만 입력" id="table"></td>' +
		            '<td><input type="text" name="p_d[]" placeholder="yyyy-mm-dd" id="table"></td>' +
		            '<td><input type="text" name="s_a[]" placeholder="숫자만 입력" id="table"></td>' +
		            '<td><input type="text" name="s_d[]" placeholder="yyyy-mm-dd" id="table"></td>' +
		            '<td><input type="text" name="profit[]" placeholder="숫자만 입력" id="table"></td>' +
		            '<td><input type="text" name="p_m[]" placeholder="숫자만 입력" id="table"></td>' +
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
					<div class="" style="float: right; width: 100%;">
						<input type="submit" name="name" class="btn btn-default btn-lg" style="float: right;">
					</div>
			 	</form>
			</article>
			<hr style="width: 100%;">
			<div id="control" style="float: right;">
				<div class="btn-group" role="group" aria-label="...">
					<input type="button"value="white"id="white_btn"class="btn btn-default btn-lg"/>
					<input type="button"value="black"id="black_btn"class="btn btn-default btn-lg"/>
				</div>
				<a href="http://localhost/write_stock_trading_diary.php" class="btn btn-danger btn-lg">쓰기</a>
				<script src="http://localhost/script.js"></script>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="http://localhost/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
	</div>
</body>
</html>
