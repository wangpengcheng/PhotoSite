<?php
	date_default_timezone_set('PRC');
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";

	//定义全局变量file_name
    //$topic_name="jdrtgnf";
    $topic_name=$_POST["topic_name"];//用户id
    //$display_photo_url="trtrnfnrt";
    $display_photo_url=$_POST["display_photo_url"];//用户密码
    //$display_photo_little_url="renstrent";
    $display_photo_little_url=$_POST["display_photo_little_url"];//
    //$topic_message="srbhtrb";
    $topic_message=$_POST["topic_message"];//专题描述
    //先查找是否存在该专题
    $is_sql="SELECT * FROM ps_topics WHERE topic_name='".$topic_name."'";
    if(mysqli_num_rows($conn->query($is_sql))>0){
        $updata_sql="UPDATE ps_topics SET topic_name='".$topic_name."',topic_message='".$topic_message."',display_photo_little_url='".$display_photo_little_url."', display_photo_url='".$display_photo_url."',create_time='".date('Y-m-d H:i:s', time())."' WHERE topic_name='".$topic_name."'";
       if($conn->query($updata_sql)){
            echo json_encode("update success");
       }else{
            echo json_encode($updata_sql);
       }
    }else{
        $insert_sql="INSERT INTO ps_topics (topic_name, topic_message,display_photo_little_url,display_photo_url,create_time) VALUES ('".$topic_name."','".$topic_message."','".$display_photo_little_url."','".$display_photo_url."','".date('Y-m-d H:i:s', time())."');";
        
        if($conn->query($insert_sql)){
            echo json_encode("success");
        }else{
            echo json_encode($insert_sql);
        }
    }
?>

