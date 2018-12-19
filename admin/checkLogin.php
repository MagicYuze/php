<?php
	if (!session_id()) session_start();
	if(!isset($_SESSION["uid"])){
		echo '<script language="javascript">location.href="login.php"</script>';
	}else{
		$uid = $_SESSION['uid'];
		$conn = mysql_connect("118.89.24.240","php","123456");//连接数据库
    	if (!$conn){
        	die('Could not connect: ' . mysql_error());
    	}
    	mysql_select_db("phpfinal",$conn);//选择数据库
    	$sql = 'select * from user where uid='.$uid;
    	$res = mysql_query($sql);
    	$row = mysql_fetch_array($res);
    	$username = $row['uname'];
   		mysql_close($conn);
	}
?>