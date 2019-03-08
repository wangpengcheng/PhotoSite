<?php
/*
 *register page
 *2019-3-7 :13:02
 */
	date_default_timezone_set('Asia/Shanghai');
	ini_set("display_errors", 0);
	error_reporting(E_ALL ^ E_NOTICE);
	error_reporting(E_ALL ^ E_WARNING);
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";
	//查询用户数据
	//用户表名；
	$user_table_name="ps_users";
	//接收数据
	//$user_name = "王鹏程";
	$user_name = $_POST["user_name"];
	//$user_pwd = "wang123!";
    $user_pwd = $_POST["user_pwd"];
    //$user_pwd_confirm="wang123!";
    $user_pwd_confirm = $_POST["pwd_confirm"];
    //$user_phone="18117842737";
    $user_phone=intval($_POST["phone"]);
    //$user_email=$_POST["email"];
    //$vertificationCode=$_POST["vertificationCode"];
	$list=[];
    //开始校验并插入数据
    if($user_name == "" || $user_pwd == "" || $user_pwd_confirm == "" || $user_phone== "")
	{
	     $list['result_state']=urlencode("输入数据不完全请重新输入！");
	}else{
        if($user_pwd == $user_pwd_confirm)
        {
            //SQL语句查询用户名称
            $sql = "SELECT * FROM ".$user_table_name." WHERE user_name = '".$user_name."'";
            //执行SQL语句
            $result = $conn->query($sql);
            //统计执行结果影响的行数
            $num = mysqli_num_rows($result);
            // echo $num
            //如果已经存在该用户
            if($num)
            {
                $list['result']=urlencode("该用户名已存在,请登录");
            }else{//不存在当前注册用户名称
				    //插入数局
				$time=date('Y-m-d h:i:s', time());
                $sql_insert = "INSERT INTO ".$user_table_name." (user_name,user_pwd,user_phone_number,user_register_time) VALUES('".$user_name."','".$user_pwd."','".$user_phone."','".$time."')";
                $res_insert = $conn->query($sql_insert);
                $num_insert = mysqli_num_rows($res_insert);
                if($res_insert)
                {
                    $list['result']=urlencode("注册成功,请登录");
                }else{
                    $list['result']=urlencode("系统繁忙请稍后再试");
                }
            }
        }else{
            $list['result']=urlencode("密码不一致");
        }
    }
 //    //更改中文编码
	// foreach ( $list as $key => $value )
	// 	{
	// 		$list[$key] = urlencode ( $value );
	// 	};
    echo urldecode(json_encode($list));//返回的是最外层加了双引号的json
    //输出urlecode防止中文乱码
    //关闭数据库连接
	$conn->close();
?>
