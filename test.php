<?php
 	 //get photo 
    include 'ps_connect.php';
    date_default_timezone_set('PRC');
 //    function curPageURL() {    
 //        $pageURL = 'http';    
 //        $pageURL .= "://";    
 //        if ($_SERVER["SERVER_PORT"] != "80"){
 //            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];    
 //        }else {
 //            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 //        }
 //         $result=parse_url($pageURL);
 //        return $result;
 //    }
   
 //    function is_index(){//名字起错了，就这个样子吧
 //         $temp=curPageURL()["path"];
 //        $result=explode('/', $temp);
 //        //echo $result["path"];//'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
 //        $last=count($result);
 //        //print_r(($result[$last-1]=="test.php"));
 //        return $result[$last-1];
 //    };
 //    function get_query($temp2){
 //        $result=[];
 //        if(array_key_exists("query", $temp2)){
 //            $query=$temp2["query"];
 //            $query_array=explode('&', $query);
 //            foreach ($query_array as $temp_query) {
 //                # code...
 //                $temp_query_array=explode('=', $temp_query);
 //                $result[$temp_query_array[0]]=$temp_query_array[1];
 //            }
 //            return $result;
 //        }else{
 //            return "no query";
 //        };
 //    }
 //    $page_url=curPageURL();
 //    $page_query=get_query($page_url);
 //    function get_photo_id($page_query){
 //        if(array_key_exists('photo_id', $page_query)){
 //            return $page_query['photo_id'];
 //        }else{
 //            return "no photo_id";
 //        }
 //    };
 //    //$photo_id=get_photo_id($page_query);
 //    //get photo 
	// //get photo 
	// $photo_id=get_photo_id($page_query);
	// $photo_array=[];
	// $author_array=[];
	// if($photo_id!="empty"){
	// 	$photo_sql="SELECT * FROM ps_photos "." WHERE photo_id = '".$photo_id."'";
	// 	$photo_result=$conn->query($photo_sql);
	// 	$photo_row_count= mysqli_num_rows($photo_result);
	// 	if($photo_row_count!==0){
	// 		//将结果转化为数组
 //        	$photo_array = $photo_result->fetch_array(MYSQLI_ASSOC);
 //        	//print_r($photo_array);
 //        	if($photo_array['user_id']!==""){
	// 			$author_sql="SELECT * FROM ps_users "." WHERE user_id = '".$photo_array['user_id']."'";
	// 			$author_result=$conn->query($author_sql);
	// 			$author_row_count= mysqli_num_rows($author_result);
	// 			if($author_row_count!==0){
	// 				//将结果转化为数组
	// 	        	$author_array = $author_result->fetch_array(MYSQLI_ASSOC);
	// 	        	//print_r($photo_array);
	// 	    	}
	// 		}
 //    	}
	// }
	//print_r($photo_array);
	//print_r($author_array);
?>
<?php
    // function get_topic_list(){
    // 	global $conn;
    // 	$topic_list_array=[];
    //     $topic_list_sql="SELECT * FROM ps_topics LIMIT 12 ";
    //     $topic_list_result=$conn->query($topic_list_sql);
    //     $topic_list_count= mysqli_num_rows($topic_list_result);
    //     //print_r($topic_list_result);
				// if($topic_list_count!==0){
				// 	//将结果转化为数组
		  //       	$topic_list_array = $topic_list_result->fetch_all(MYSQLI_ASSOC);
		  //       	return $topic_list_array;
		  //   	}
    // };
    // $test=get_topic_list();

    // for($i=0;$i<count($test);++$i) {
    // 	$temp=$test[$i];
    // 	echo '<li class "l'.$i.'">';
    // 	echo '	<a href="'."topic.php?".$temp['topic_id'].'" target="_blank">';
    // 	echo '     <img src="'.$temp['display_photo_little_url'].'"/>';
    //     echo '     <div class="h_row3_mask">';
    //     echo '			<h3>'.$temp['topic_name'].'</h3>';
    //     echo '			<p><i class="h_ico_album"></i>'.$temp['topic_message'].'</p>';
    //     echo '     </div>';
    //     echo '    </a>';    
    //     echo '</li>';
    // }
?>
<?php
	function curPageURL() {    
        $pageURL = 'http';    
        $pageURL .= "://";    
        if ($_SERVER["SERVER_PORT"] != "80"){
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];    
        }else {
            $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
        }
         $result=parse_url($pageURL);
        return $result;
    }
   
    function is_index(){//名字起错了，就这个样子吧
         $temp=curPageURL()["path"];
        $result=explode('/', $temp);
        //echo $result["path"];//'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $last=count($result);
        //print_r(($result[$last-1]=="test.php"));
        return $result[$last-1];
    };
    function get_query($temp2){
        $result=[];
        if(array_key_exists("query", $temp2)){
            $query=$temp2["query"];
            $query_array=explode('&', $query);
            foreach ($query_array as $temp_query) {
                # code...
                $temp_query_array=explode('=', $temp_query);
                $result[$temp_query_array[0]]=$temp_query_array[1];
            }
            $temp_array=[];
            $temp_array['photo_id']="12";
            $temp_array['topic_id']="3";
            return $result;
        }else{
            return "no query";
        };
    }
    $page_url=curPageURL();
    $page_query=get_query($page_url);
    function get_photo_id($page_query){
        if(array_key_exists('photo_id', $page_query)){
            return $page_query['photo_id'];
        }else{
            return "empty";
        }
    };
    //print_r($page_query);
    function get_topic_id($page_query){
    	if(array_key_exists('topic_id', $page_query)){
    		return $page_query['topic_id'];
    	}else{
    		return "empty";
    	}
    }
     function get_user_id($page_query){
        if(array_key_exists('user_id', $page_query)){
            return $page_query['user_id'];
        }else{
            return "empty";
        }
    }
    function get_history($user_id){
        global $conn;//设置全局变量
        $result=[];
        $get_histroy_sql="SELECT ps_photos.photo_id,photo_address,record_time FROM ps_photos,ps_user_browserecord where ps_user_browserecord.user_id='".$user_id."' and ps_user_browserecord.photo_id=ps_photos.photo_id"."GROUP BY DATE_FORMAT(create_time, \"%Y-%m-%d\" )";
        print_r($get_histroy_sql);
        //SELECT ps_photos.photo_id,photo_address,record_time FROM ps_photos,ps_user_browserecord where ps_user_browserecord.user_id='1' and ps_user_browserecord.photo_id=ps_photos.photo_id
        $user_history_result=$conn->query($get_histroy_sql);
        $histroy_row_count=mysqli_num_rows($user_history_result);
        if($histroy_row_count!==0){
            $result=$user_history_result->fetch_all(MYSQLI_ASSOC);
        }
        return $result;
    }
    $user_id=get_user_id($page_query);
    $user_history_result=get_history($user_id);
    print_r($user_history_result);
    // $topic_id=get_topic_id($page_query);
    // $user_id=get_user_id($page_query);
    // //print_r($topic_id);
    // print_r($user_id);
     //include 'ps_connect.php';
	//print_r(date('Y-m-d H:i:s', time()));
	//print_r($photo_array);
	//print_r($author_array);
?>