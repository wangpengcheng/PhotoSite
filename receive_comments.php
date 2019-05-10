<?php
/*
*设置连接，接受提交的用户名返回密码
*检查用户名是否存在或者作为电话号码存在，返回密码
*王鹏程 2019/3/7 12:53
*/
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";
	//查询用户数据
	//定义结果
	$result="failed";
	//用户id
	//$user_id=1;
	$user_id=$_POST["user_id"];
	//图片id
	//$photo_id=100;
    $photo_id=$_POST["photo_id"];
    //评论主要内容
    //$photo_comment="年和平";
    $photo_comment=$_POST["photo_comment"];
	//设置查询语句
	//INSERT INTO ps_comments (user_id,photo_id,comment_content) VALUES ('3','140','测试逆向干啥子');
	if($user_id!=""&&
	   $photo_id!=""&&
	   $photo_comment!=""){
		$insert_comment_sql="INSERT INTO ps_comments (user_id,photo_id,comment_content,comment_date) VALUES ('".$user_id."','".$photo_id."','".$photo_comment."','".date('Y-m-d H:i:s', time())."')";
		$comment_insert_result = $conn->query($insert_comment_sql);
		if($comment_insert_result){
			$result="success";
		};
	}
	//输出urlecode防止中文乱码
	echo json_encode($result);
	//关闭数据库连接
	$conn->close();
?>
