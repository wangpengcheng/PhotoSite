<?php
/*
*设置连接，接受提交的用户名返回密码
			检查用户名是否存在或者作为电话号码存在，返回密码
*王鹏程 2018/4/9 15:51；
*/
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');

	//查询用户数据
	//用户表名；
	$user_table_name="users";
	//连接数据库；$conn为数据库聚丙函数
	include_once "connect.php";
	//获取提交的用户名
	//$user_name="admin";
	$user_name=$_POST["user_name"];
	//获取密码；
	//$user_pwd="0000";
	$user_pwd=$_POST["user_pwd"];
	//设置查询语句
	$sql="SELECT * FROM ".$user_table_name." WHERE user_login = '".$user_name."'";
	//执行查询余军
	$result=$conn->query($sql);
	//echo $result;
	//初始化返回数组
	$row=[];
	$row_cnt= mysqli_num_rows($result);
	if($row_cnt==0){
		//如果用户名没查到
		$row['result']=3;
		//检查是否为用户电话号码；
		//设置查询用户电话号码语句
		
	}else{
		$row = $result->fetch_array(MYSQLI_BOTH);
		//获取真实密码
		$really_pwd=$row['user_pass'];
		//$really_pwd="0000";
		//$json=new JSON;
		if($user_pwd==$really_pwd)
		{
			
			$row['result']=1;
			
			
		}else{
			$row=["result"=>"0"];
			//echo $row['success'];
		};
		
	}

	//更改中文编码
	foreach ( $row as $key => $value )
		{  
			$row[$key] = urlencode ( $value );  
		} 
	//输出urlecode防止中文乱码
	echo urldecode ( json_encode ( $row ) ); 
	//关闭数据库连接
	$conn->close();
?>