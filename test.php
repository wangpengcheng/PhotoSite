<?php
 	 //get photo 
    include 'ps_connect.php';
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
    function get_topic_list(){
    	global $conn;
    	$topic_list_array=[];
        $topic_list_sql="SELECT * FROM ps_topics LIMIT 12 ";
        $topic_list_result=$conn->query($topic_list_sql);
        $topic_list_count= mysqli_num_rows($topic_list_result);
        //print_r($topic_list_result);
				if($topic_list_count!==0){
					//将结果转化为数组
		        	$topic_list_array = $topic_list_result->fetch_all(MYSQLI_ASSOC);
		        	return $topic_list_array;
		    	}
    };
    $test=get_topic_list();

    for($i=0;$i<count($test);++$i) {
    	$temp=$test[$i];
    	echo '<li class "l'.$i.'">';
    	echo '	<a href="'."topic.php?".$temp['topic_id'].'" target="_blank">';
    	echo '     <img src="'.$temp['display_photo_little_url'].'"/>';
        echo '     <div class="h_row3_mask">';
        echo '			<h3>'.$temp['topic_name'].'</h3>';
        echo '			<p><i class="h_ico_album"></i>'.$temp['topic_message'].'</p>';
        echo '     </div>';
        echo '    </a>';    
        echo '</li>';
    }
?>