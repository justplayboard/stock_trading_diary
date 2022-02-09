<?php
  require("config/config.php");
  require("lib/db.php");
  $conn=db_init($config["host"],$config["duser"],$config["dpw"],$config["dname"]);
  $uid = $_GET['userid'];
  $sql="SELECT * FROM user WHERE id='".$uid."';";
  $result = mysqli_query($conn,$sql);
	$member = mysqli_num_rows($result);
  if($member == 0)
  {
?>
	<div style='font-family:"malgun gothic"';><?php echo $uid; ?>는 사용가능한 아이디입니다.</div>
<?php
  } else{
?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $uid; ?>중복된아이디입니다.<div>
<?php
  }
?>
<button value="닫기" onclick="window.close()">닫기</button>
