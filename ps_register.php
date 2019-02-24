<?php   
header('Access-Control-Allow-Origin:*');



 
	//header('Access-Control-Allow-Origin:*');

	//连接数据库；$conn为数据库聚丙函数
	include_once "connect.php";
	//查询用户数据
	//用户表名；
	$user_table_name="users";
		//接收数据
		  $user_login = $_POST["login_name"];    
          $psw = $_POST["password"];    
          $psw_confirm = $_POST["password_confirm"];  
          $phone=intval($_POST["phone"]);  
          $email=$_POST["email"];    
          $vertificationCode=$_POST["vertificationCode"];
	
		   $list=array("result"=>"successs");
		  // $list['user_login']=$user_login ;
		  // $list['psw']=$psw ;
		  // $list['phone']=$psw_confirm ;
		  // $list['email']=$email;
		  // $list['psw_confirm']=$psw_confirm ;
		  // $list['submit']=urlencode($submit);
		  // $list['vertificationCode']=$vertificationCode ;
		    
		   // if($user_login == "" || $psw == "" || $psw_confirm == "" || $phone== "" || $email== "" || $vertificationCode == "")    
           // {    
                // $list['result']=urlencode("输入数据不完全请重新输入！");
           // } 
				   
				
			//开始校验并插入数据
			  if($user_login == "" || $psw == "" || $psw_confirm == "" || $phone== "")    
			  {    
				  $list['result']=urlencode("输入数据不完全请重新输入！");    
			  }    
			  else    
			  {  
				  if($psw == $psw_confirm)    
				  {   
						//SQL语句查询用户名称
					  $sql = "SELECT * FROM ".$user_table_name." WHERE user_login = '".$user_login."'";     
						//执行SQL语句 
					  $result = $conn->query($sql); 
						//统计执行结果影响的行数
					  $num = mysqli_num_rows($result);  
					  // echo $num
						//如果已经存在该用户
					  if($num)        
					  {    
						  $list['result']=urlencode("该用户名已存在");     
					  }    
					  else    //不存在当前注册用户名称    
					  {    //插入数据
						  $sql_insert = "INSERT INTO ".$user_table_name." (user_login,user_pass,user_phonenumber,user_email) VALUES('".$user_login."','".$psw."','".$phone."','".$email."')";    
						  $res_insert = $conn->query($sql_insert);    
						  $num_insert = mysqli_num_rows($res_insert);    
						  if($res_insert)    
						  {    
							  $list['result']=urlencode("注册成功");    
						  }    
						  else    
						  {    
							   $list['result']=urlencode("系统繁忙请稍后再试");    
						  }    
					  }    
				  }    
				  else    
				  {    
					  $list['result']=urlencode("密码不一致");    
				  }    
			  }       
		   
	  echo urldecode(json_encode($list));//返回的是最外层加了双引号的json
  ?>    