<?php
	
	//连接数据库；$conn为数据库聚丙函数
	include_once "./ps_connect.php";
	include_once "./query_list_load.php";
	$topic_table_name="ps_topics";
	$ps_photo_table_name="ps_photos";
	$main_station_url="http://www.meisupic.com/";
	$topic=[];
	//$photo=[];
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

function get_img($img_link,$topic_id){
	//photo_name、photo_message、photo_address、photo_big_address、tpoic_id、photo_width|height
	$result=[];
$rules = array (
  'img_link' => 
  array (
    0 => '.img>img',
    1 => 'src',
  ),
  'big_img_link' => 
  array (
    0 => '#big_img>div>img',
    1 => 'src',
  ),
 
);
$data = QueryList::get($img_link)->rules($rules)->range('.picture_head>.wrapper')->queryData();
$data2 = QueryList::get($img_link)->find('.bd>p')->htmls();
//print_r($data);
$photo_name_array=explode('名称：', $data2[0]);
$photo_name=$photo_name_array[1];
$photo_id_array=explode('ID：', $data2[1]);
$photo_media_id=$photo_id_array[1];
$photo_size_array=explode('px', $data2[3]);
$photo_size=explode('尺寸：',$photo_size_array[0]);
$photo_size1=explode('×',$photo_size[1]);
$photo_width=$photo_size1[0];
$photo_height=$photo_size1[1];
$result['photo_name']=$photo_name;
$result['photo_address']=$data[0]['img_link'];
$result['big_img_address']=$data[0]['big_img_link'];
$result['photo_media_id']=$photo_media_id;
$result['topic_id']=$topic_id;
$result['photo_width']=$photo_width;
$result['photo_height']=$photo_height;
$result['ueser_id']=1;
return $result;

}
function updateimage($photo){
	global $ps_photo_table_name,$conn;
	$sql_insert = "INSERT INTO ".$ps_photo_table_name." (photo_media_id,photo_name,photo_address,photo_big_address,photo_width,photo_height,photo_topic_id,ueser_id,create_time) VALUES('".$photo['photo_media_id']."','".$photo['photo_name']."','".$photo['photo_address']."','".$photo['big_img_address']."','".$photo['photo_width']."','".$photo['photo_height']."','".$photo['topic_id']."','".$photo['ueser_id']."','".date('Y-m-d h:i:s', time())."')";
		// //$result=$conn->query($get_tpoic_id);
	     if ($conn->query($sql_insert) === TRUE) {
	      print_r("image insert ".$photo['photo_media_id']." success\n");
	      	$topic_id=mysqli_insert_id($conn);
	     // print_r($topic_id);
	     } else {
	      echo "Error: " . $sql_insert . "<br>" . $conn->error;
	      print_r("Error: ".$photo['photo_media_id'].$conn->error."\n");
	     }
	 return 1;
};
//print_r($topic);
//$photo1=get_img("http://www.meisupic.com/goods.php?media_id=88344662",9);
//print_r($photo1);

function updatetopic($topic){
	global $topic_table_name,$conn;
		$sql_insert = "INSERT INTO ".$topic_table_name." (topic_name,topic_message,display_photo_url,display_photo_little_url,create_time) VALUES('".$topic['topic_name']."','".$topic['topic_message']."','".$topic['display_photo_url']."','".$topic['display_photo_little_url']."','".date('Y-m-d h:i:s', time())."')";
		//$result=$conn->query($get_tpoic_id);
	     if ($conn->query($sql_insert) === TRUE) {
	      print_r("topic insert ".$topic['topic_name']."  success \n") ;
	      	$topic_id=mysqli_insert_id($conn);
	     // print_r($topic_id);
	     } else {
	      echo "Error: " . $sql_insert . "<br>" . $conn->error;
	      print_r("Error: " .$topic['topic_name']."  " . $conn->error."\n");
	     }
	 return $topic_id;
};

	
	//print_r($topic[$i]);
$topic_url=get_topic($main_station_url);
 for($i=0;$i<count($topic_url);$i++){
 	//获取更新的图片链接
	$img_result=get_img_url($topic_url[$i]);
	//补全topic信息
	$topic[$i]['display_photo_url']=$img_result['big_img_url'];
	$topic_id=updatetopic($topic[$i]);
	 foreach ($img_result['img_rul'] as $temp_link_list) {
	 	//print_r($temp_link_list.'<br>');
	 	$photo=get_img($temp_link_list,$topic_id);
	 	//print_r($photo);
	 	$is_ok=updateimage($photo);
	 };
	}