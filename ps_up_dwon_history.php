<?php
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	date_default_timezone_set('PRC');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";
	$user_id=$_POST["user_id"];
	$photo_id=$_POST["photo_id"];
	$load_type=$_POST["load_type"];
	// $user_id="19";
	// $photo_id="119";
	// $load_type="0";
	if($user_id!=""&&
	   $photo_id!=""&&
	   $load_type!=""){
		$histroy_insert_sql="INSERT INTO ps_load_history (user_id,photo_id,load_type,load_time) VALUES ('".$user_id."','".$photo_id."','".$load_type."','".date('Y-m-d H:i:s', time())."')";
		$history_insert = $conn->query($histroy_insert_sql);
		echo urldecode(json_encode($history_insert->fetch_all(MYSQLI_ASSOC))); ;
	}
?>