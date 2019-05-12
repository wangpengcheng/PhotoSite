<?php
	date_default_timezone_set('PRC');
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";

	//定义全局变量file_name
    $user_id=$_POST["user_id"];//用户id
    $user_password=$_POST["user_password"];//用户密码
    $user_pwdchange_sql="UPDATE ps_users SET user_pwd='".$user_password."' WHERE user_id='".$user_id."'";

    if($conn->query($user_pwdchange_sql)){
    	echo json_encode("success");
    }else{
    	echo json_encode($user_pwdchange_sql);
    }
?>

