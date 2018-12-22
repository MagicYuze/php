<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php  //邮箱验证码这种要多线程
	session_start();
	include_once("functions/database.php");
	//include_once("mail/sendmail.php");
	get_connection();
	$type=$_GET['type'];
	//$code='';   //邮箱验证码

	if($type=="login"){
		$username=$_POST["Username"];
		$password=$_POST["Password"];
		$selectSQL="select * from user where uname='".$username."' and password='".$password."'";
		$resultSet=mysql_query($selectSQL);
		if(mysql_num_rows($resultSet)<1){   //找不到
			echo "<script>alert('账号密码错误！')</script>";
		}
		else{
			while($db=mysql_fetch_array($resultSet)){
				if($db["state"]==1 && $db["level"]==0){

					$_SESSION["user"]=$db["uid"];   //存现有user的id
					$_SESSION["username"]=$db["uname"];  //存现有user的名字

					echo "<script>alert('登录成功！')</script>";
            		echo "<script>window.location.href='index.php'</script>";
				}else if($db["state"]==0){
					echo "<script>alert('已停用，请联系管理员！')</script>";
				}else if($db["level"]==1){  //避免登录管路员的账号
					echo "<script>alert('账号密码错误！')</script>";					
				}
			}
		}
		echo "<script type='text/javascript'>window.location.href='login.php'</script>";
	}else if($type=="register"){
		$username=$_POST["Username"];
		$password=$_POST["Password"];
		$email=$_POST["Email"];
		$phone=$_POST["Phone"];

		$selectSQL="select * from user where uname='".$username."'";
		$resultSet=mysql_query($selectSQL);

		if(mysql_num_rows($resultSet)>=1){   //已有人注册了
			echo "<script>alert('账号已经注册了！')</script>";
			echo  "<script type='text/javascript'>window.location.href='login.php'</script>";
		}else{
			$insertSQL="insert into user(uname,password,phone,email,state,level) values('".$username."','".$password."','".$phone."','".$email."','1','0')";
			mysql_query($insertSQL);
			echo "<script>alert('注册成功！')</script>";
			echo "<script type='text/javascript'>window.location.href='login.php'</script>";
		}
	}else if($type="change"){
		$username=$_POST['Username'];
		$email=$_POST['Email'];
		$phone=$_POST['Phone'];
		$newpassword=$_POST['newPassword'];

		$selectSQL="select * from user where uname='".$username."' and email='".$email."' and phone='".$phone."'";
		$resultSet=mysql_query($selectSQL);

		if(mysql_num_rows($resultSet)>=1){   //用户名和邮箱、手机匹配
			$updateSQL="update user set password='".$newpassword."' where uname='".$username."'";
			mysql_query($updateSQL);
			echo "<script>alert('修改密码成功！')</script>";
		}else{
			echo "<script>alert('用户名和邮箱、手机不匹配！')</script>";
		}
		echo "<script type='text/javascript'>window.location.href='login.php'</script>";
	}

?>