<?php
	date_default_timezone_set('PRC');
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";

	//定义全局变量file_name
	$filename="";
    $work_photo_name=$_POST["worksFullName"];//名称
    $creation_date=$_POST["creationDate"];//日期
    $main_features=$_POST["mainFeatures"];//描述和
    $main_features2=$_POST["mainFeatures2"];//主要标签
    if($_POST["user_id"]!==""){
    	$user_id=$_POST["user_id"];
	}else{
		$user_id=3;//游客身份
	}
    //标签
	
	//存储文件
		//var_dump($_FILES["file"]);
	//array(5) { ["name"]=> string(17) "56e79ea2e1418.jpg" ["type"]=> string(10) "image/jpeg" ["tmp_name"]=> string(43) "C:\Users\asus\AppData\Local\Temp\phpD07.tmp" ["error"]=> int(0) ["size"]=> int(454445) } 
	//1.限制文件的类型，防止注入php或其他文件，提升安全
	//2.限制文件的大小，减少内存压力
	//3.防止文件名重复，提升用户体验
	    //方法一：  修改文件名    一般为:时间戳+随机数+用户名
	    // 方法二:建文件夹
	    
	//4.保存文件

	//判断上传的文件是否出错,是的话，返回错误
	if($_FILES["file"]["error"])
	{
	    echo $_FILES["file"]["error"];    
	}
	else
	{
	    //没有出错
	    //加限制条件
	    //判断上传文件类型为png或jpg且大小不超过1024000B
	    if(($_FILES["file"]["type"]=="image/png"||$_FILES["file"]["type"]=="image/jpeg")&&$_FILES["file"]["size"]<10240000)
	    {
	            //防止文件名重复
	            $filename ="./upfile/".time().$_FILES["file"]["name"];
	            //转码，把utf-8转成gb2312,返回转换后的字符串， 或者在失败时返回 FALSE。
	            //$filename =iconv("UTF-8","gb2312",$filename);
	             //检查文件或目录是否存在
	            if(file_exists($filename))
	            {
	                echo "该文件已存在";
	            }
	            else
	            {  
	                //保存文件,   move_uploaded_file 将上传的文件移动到新位置  
	                move_uploaded_file($_FILES["file"]["tmp_name"],$filename);//将临时地址移动到指定地址    
	            }        
	    }
	    else
	    {
	        echo "文件类型不对";
	    }
	}
	$main_features2=str_replace(' ','',$main_features2);
	$main_features2=str_replace('；',';',$main_features2);
	$target=explode(';', $main_features2);
	$media_id=0;
	//$time=$creation_date+" "+date('h:i:s',time());
	//获取图片宽度
	list($width, $height, $type, $attr)=getimagesize($filename);
    //数据收集完毕准备插入输入库，图片库和标签库；
    //先插入图片库
    $photo_sql_insert="INSERT INTO ps_photos (photo_media_id,photo_message,photo_name,photo_address,photo_big_address,photo_width,photo_height,user_id,create_time) VALUES('".$media_id."','".$main_features."','".$work_photo_name."','".$filename."','".$filename."','".$width."','".$height."','".$user_id."','".date('Y-m-d h:i:s', time())."')";
    //执行插入操作;
    	if($conn->query($photo_sql_insert) === TRUE) {
	    	$photo_id=mysqli_insert_id($conn);
	     // print_r($topic_id);
	    } else {
	    	echo "Error: " .  $photo_sql_insert . "<br>" . $conn->error;
	    };

	   //插入标签
	   //
	   //遍历标签并且插入
	//将图片名称添加到target中
	array_push($target, $work_photo_name);
	foreach ($target as $target_temp) {
		if($target_temp!==""){
			//将标签插入ps_targets表
			//INSERT INTO ps_targets (target_name, photo_id,create_time) VALUES ("战神",1,2)
			$target_insert_sql="INSERT INTO ps_targets (target_name, photo_id,create_time) VALUES ('".$target_temp."','".$photo_id."','".date('Y-m-d h:i:s', time())."');";
			if ($conn->query($target_insert_sql) === TRUE){
				print_r("insert target: ".$target_temp." with photo_id :  ".$photo_id." sucess \n");
			}else{
				//echo "Error: " . $sql_insert . "<br>" . $conn->error;
	      	    print_r("Error: insert target: ".$target_temp." with photo_id :  ".$photo_id." By Error".$conn->error."\n");
			}
		}
		
	}
	//添加用户上传记录
	$load_type=1;
	$histroy_insert_sql="INSERT INTO ps_load_history (user_id,photo_id,load_type,load_time) VALUES ('".$user_id."','".$photo_id."','".$load_type."','".date('Y-m-d H:i:s', time())."')";
	$history_insert = $conn->query($histroy_insert_sql);
	print_r($history_insert);

?>
<script type="text/javascript">
	window.location.href=<?php echo '"./photo.php?photo_id='.$photo_id.'&user_id='.$user_id.'"'; ?>;
</script>
