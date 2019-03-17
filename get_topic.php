<?php	
	//允许跨域访问
	header('Access-Control-Allow-Origin:*');
	//连接数据库；$conn为数据库聚丙函数
	include_once "ps_connect.php";
	//$topic_id="10";
	$topic_id=$_POST["topic_id"];
	$topic_sql="SELECT topic_name,topic_message,display_photo_url FROM ps_topics"." WHERE topic_id = '".$topic_id."'";
	$topic_result=$conn->query($topic_sql);
	//echo $result;
	//初始化返回数组
	$topic_row=[];
	$topic_out_result=[];
	//结果行数
	$row_count= mysqli_num_rows($topic_result);
	if($row_count!=0){
		
		$topic_row=$topic_result->fetch_array(MYSQLI_ASSOC);
		$topic_photos_sql="SELECT photo_id,photo_big_address FROM ps_photos"." WHERE photo_topic_id ='".$topic_id."'";
		$photos_result=$conn->query($topic_photos_sql);
		$photos_row_count=mysqli_num_rows($photos_result);
		//print_r($topic_row);
		if($photos_row_count!=0){
			$photos_list=$photos_result->fetch_all(MYSQLI_ASSOC);
		}
	}
	//中文编码防止乱码
	for($i=0;$i<count($photos_list);++$i){
		foreach ($photos_list[$i] as $key2 => $value2){
			$photos_list[$i][$key2]=urlencode($value2);
		}
	};
	foreach ( $topic_row as $key => $value ){
		$topic_row[$key] = urlencode ( $value );
	};
	$topic_out_result['topic_message']=$topic_row;
	$topic_out_result['photo_list']=$photos_list;
	//输出urlecode防止中文乱码
	echo urldecode (json_encode($topic_out_result));
	$conn->close();
?>