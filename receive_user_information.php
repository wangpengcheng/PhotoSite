<?php
	date_default_timezone_set('PRC');
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";

	//定义全局变量file_name
    $user_id=$_POST["user_id"];//用户id
    $user_phone_number=$_POST["user_phone_number"];//用户手机号码
    $user_little_name=$_POST["user_little_name"];//用户你昵称
    $user_real_name=$_POST["user_real_name"];//主要标签
    $user_company=$_POST["user_company"];//用户公司
    $user_qq=$_POST["user_qq"];//用户qq
    $user_email=$_POST["user_email"];//用户邮箱
    //UPDATE `ps_users` SET `user_id`=[value-1],`user_name`=[value-2],`user_phone_number`=[value-3],`user_little_name`=[value-4],`user_real_name`=[value-5],`user_qq`=[value-6],`user_email`=[value-7],`user_pwd`=[value-8],`user_register_time`=[value-9],`user_state`=[value-10],`user_company`=[value-11],`user_head_image`=[value-12],`user_download_number`=[value-13],`user_upload_number`=[value-14] WHERE 1
    $user_change_sql="UPDATE ps_users SET user_phone_number='".$user_phone_number."', user_little_name='".$user_little_name."', user_real_name='".$user_real_name."', user_company='".$user_company."', user_qq='".$user_qq."', user_email='".$user_email."' WHERE user_id='".$user_id."'";

    if($conn->query($user_change_sql)){
    	echo json_encode("success");
    }else{
    	echo json_encode($user_change_sql);
    }
?>

