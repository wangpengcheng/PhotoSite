<?php
	
	//连接数据库；$conn为数据库聚丙函数
	include_once "./ps_connect.php";
	include_once "./query_list_load.php";
	$topic_table_name="ps_topics";
	$ps_photo_table_name="ps_photos";
	$main_station_url="http://www.meisupic.com/";
	$topic=[];
use QL\QueryList;

function get_topic($main_url){
	$main_rules= array (
	  'img_link' => 
	  array (
	    0 => 'a>img',
	    1 => 'src',
	  ),
	  'title' => 
	  array (
	    0 => 'div>h3',
	    1 => 'text',
	  ),
	  'num' => 
	  array (
	    0 => 'div>p',
	    1 => 'text',
	  ),
	  'url' => 
	  array (
	    0 => 'a',
	    1 => 'href',
	  ),
	);
	global $main_station_url,$topic;
	$data = QueryList::get($main_url)->rules($main_rules)->range('.h_row3_main>ul>li')->queryData();
	$new_data=[];

	foreach ($data as $temp) {
		$topic_arry=[];
		$topic_arry['topic_name']=$temp['title'];
		$topic_arry['topic_message']=$temp['num'];
		$topic_arry['display_photo_little_url']=$main_station_url.$temp['img_link'];
		$topic[]=$topic_arry;
		$new_data[]=$main_station_url.$temp['url'];
	}
	return $new_data;
}
function get_img_url($topic_link){
	//$topic_rules=array(''=> ,);
	$result=[];
	//获取大图地址
	$data = QueryList::get($topic_link)->find('.bgimg')->attrs('style');
	$tring=$data[0];
	//$preg_title = "/background-image:.*?(images\/.+?)[\s]|;/";
	//preg_match($preg_title,$tring,$matchestitle);
	//print_r($matchestitle);
	$test=explode('background-image:url(\'',$tring);
	$test2=explode('\'', $test[1]);
	$result['big_img_url']=$test2[0];//大图地址
	$data2 = QueryList::get($topic_link)->find('.imgList>.imgItem>a')->attrs('href');
	$img_url=[];
	//遍历添加链接
	foreach ($data2 as $data2_temp) {
		$img_url[]="http://www.meisupic.com/".$data2_temp;
	}
	$result['img_rul']=$img_url;
	return $result;
}

function get_img($img_link){
	
}

$topic_url=get_topic($main_station_url);
$temp_array=[];
for($i=0;$i<count($topic_url);$i++){
	$img_result=get_img_url($topic_url[$i]);
	$topic[$i]['display_photo_url']=$img_result['big_img_url'];
	foreach ($img_result['img_rul'] as $temp_link_list) {
		print_r($temp_link_list.'<br>');
	}
	print_r('<hr>');
}
//print_r($topic);
//获取图片链接


	// foreach($data as $item) {
	// 		//$sql_insert = "INSERT INTO ".$topic_table_name." (topic_name,topic_message,display_photo_url,create_time) VALUES('".$item['title']."','".$item['num']."','"."http://www.meisupic.com/".$item['img_link']."','".date('Y-m-d h:i:s', time())."')";
	//      //$res_insert = $conn->query($sql_insert);
	//      $get_tpoic_id="SELECT topic_id FROM ".$topic_table_name."where topic_name = '".$topic_name."'";
	//      $result=$conn->query($get_tpoic_id);
	//      if(mysqli_num_rows($result)!==0){
	//      	$row = $result->fetch_array(MYSQLI_ASSOC);
	//      	$topic_id=$row[0];
	//      }else
	//      {
	//      	echo "do not have this topic";
	//      }

	//      if ($conn->query($sql_insert) === TRUE) {
	//       echo "insert success";
	//      } else {
	//       echo "Error: " . $sql . "<br>" . $conn->error;
	//      }
	//  }