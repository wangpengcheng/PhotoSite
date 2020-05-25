<?php
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";
	//查询用户数据
	//用户表名；
	$user_table_name="ps_users";
	//获取提交的用户名
	//$user_name="王鹏程";
	$user_name=$_POST["user_name"];
	//获取密码；
	//$user_pwd="wang123!";
    $user_pwd=$_POST["user_pwd"];
	//设置查询语句示例：
	$sql="SELECT * FROM ".$user_table_name." WHERE user_name = '".$user_name."'";
	//执行查询语句
	$result=$conn->query($sql);
	//echo $result;
	//初始化返回数组
	$row=[];
	//结果行数
	$row_count= mysqli_num_rows($result);
	if($row_count==0){
		//如果用户名没查到

		//检查是否为用户电话号码；
		//设置查询用户电话号码语句
		$temp_sql="SELECT * FROM ".$user_table_name." WHERE user_phone_number = '".$user_name."'";
		$result=$conn->query($temp_sql);
		$row_count=mysqli_num_rows($result);
	}
	if($row_count!==0){
		//将结果转化为数组
        $row = $result->fetch_array(MYSQLI_ASSOC);
		//获on真实密码
		$really_pwd=$row['user_pwd'];
		//$really_pwd="0000";
		//$json=new JSON;
		if($user_pwd==$really_pwd)
		{
			$row['result_state']=0;

		}else{
			$row=["result_state"=>"1"];
		};

	}else {
		$row['result_state']=3;
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
