<?php
    include 'ps_header.php';
?>

<?php
	 //get photo 
    include 'ps_connect.php';
	$photo_id=get_photo_id($page_query);
	$user_id=get_user_id($page_query);
	$photo_array=[];
	$author_array=[];
	//更新照片id
	if($photo_id!="empty"){
		$time=date('Y-m-d H:i:s', time());
		$photo_sql="SELECT * FROM ps_photos "." WHERE photo_id = '".$photo_id."'";
		$record_sql="INSERT INTO ps_user_browserecord (user_id,photo_id,record_time) VALUES ('".$user_id."','".$photo_id."','".$time."')";
		//INSERT INTO `ps_user_browserecord` (`record_id`, `user_id`, `photo_id`, `record_time`) VALUES (NULL, '19', '1234', '2019-03-17 15:00:24');
		$photo_result=$conn->query($photo_sql);
		$res_insert = $conn->query($record_sql);
		$photo_row_count= mysqli_num_rows($photo_result);
		if($photo_row_count!==0){
			//将结果转化为数组
        	$photo_array = $photo_result->fetch_array(MYSQLI_ASSOC);
        	//print_r($photo_array);
        	if($photo_array['user_id']!==""){
				$author_sql="SELECT * FROM ps_users "." WHERE user_id = '".$photo_array['user_id']."'";
				$author_result=$conn->query($author_sql);
				$author_row_count= mysqli_num_rows($author_result);
				if($author_row_count!==0){
					//将结果转化为数组
		        	$author_array = $author_result->fetch_array(MYSQLI_ASSOC);
		        	//print_r($photo_array);
		    	}
			}
    	}else{
            echo "image no found;";
        }
	}

    /*更新评论数据*/
    //预定义结果
    $photo_comments=[];
    //评论统计
    $comments_count=0;
    //user_id,comment_date,comment_content
    //查询例句： SELECT user_id,comment_content,comment_date FROM `ps_comments` WHERE photo_id='0'
	$get_comments_sql="SELECT user_id,comment_content,comment_date FROM ps_comments WHERE photo_id='".$photo_id."'";
    $comments_result=$conn->query($get_comments_sql);
    $comments_count=mysqli_num_rows($comments_result);
    if($comments_count!==0){
        $photo_comments=$comments_result->fetch_all(MYSQLI_ASSOC);
        for ($i=0; $i < count($photo_comments); $i++ ) { 
            $temp_user_id=$photo_comments[$i]['user_id'];
            //sql样例： SELECT user_name,user_head_image FROM `ps_users` WHERE user_id=1
            $get_user_sql_2="SELECT user_name,user_head_image FROM `ps_users` WHERE user_id='".$temp_user_id."';";
            $user_query_result_2=$conn->query($get_user_sql_2);
            if(mysqli_num_rows($user_query_result_2)!==0){
                $result2=$user_query_result_2->fetch_array(MYSQLI_ASSOC);
                $photo_comments[$i]['user_name']=$result2['user_name'];
                $photo_comments[$i]['user_head_image']=$result2['user_head_image'];
            }

        }
    }
    $conn->close();
	//print_r($photo_array);
	//print_r($author_array);
?>
<div class="picture_info">
    <div class="picture_head picture_head01">
        <div class="wrapper">
            <div class="img">
                <img src=<?php echo "\"".$photo_array['photo_address']."\"";?>
                     height="384px">
                <div id="my_change" class="btn">
                    <ul>
                        <li class="n1" sn="88344662" title=<?php echo "\"".$photo_array['photo_name']."\"";?> style="display:none"><a href="javascript:void(0)">收藏</a></li>
                        <li class="n2"><a href="javascript:void(0)" id="img_p">放大</a></li>
                    </ul>
                </div>
            </div>
            <div id="dci_img" class="d_none">
                <div class="big_img">
                    <img src="">
                </div>
            </div>
            <div id="big_img" class="d_none">
                <div class="big_img">
                    <img src=<?php echo "\"".$photo_array['photo_big_address']."\"";?> >
                </div>
            </div>
            <div class="txt">
                <!--<div class="hd">
                  <div class="avatar">
                    <img src="themes/meisu2017/imgs/img64.jpg"/>
                  </div>
                  <div class="txt">
                    <h4><a href="">RhinoGOD</a></h4>
                    <h4><a href="">2344个作品</a></h4>
                  </div>
                  <div class="sub">
                    关注
                  </div>
                </div>-->
                <div class="bd">
                    <p>名称：<?php echo $photo_array['photo_name'];?> </p>

                    <p>ID：<?php echo $photo_array['photo_id'];?></p>
                    <p>作者：
                        <a href= <?php echo "\""."user_page.php?user_id=".$photo_array['user_id']."\"";?>  class="goods_username"><?php echo $author_array['user_name'];?></a>
                    </p>
                    <p>尺寸：<?php echo $photo_array['photo_width']."x".$photo_array['photo_height'];?>px/dpi</p>
                    <p>格式：<?php echo $photo_array['photo_format'];?></p>
                    <p>授权：商业用途</p>
                </div>
                <div class="ft">
                    <div class="title">
                        <!--    <h4>标准授权价格</h4>
                           <h5 id="lool">扩展授权</h5> -->
                    </div>
                    <div class="wrap">
                        <!-- <p>单张购买：￥50.00／张 </p>
                                          <p>套餐购买：新客特惠套餐100元含10次下载点，每张低至￥10元</p>
                        <a href="about.php?action=price" target="_blank">购买套餐</a>-->
                    </div>
                </div>
                <div class="btns">
                    <ul>
                        <li sn="88344662" title=<?php echo "\"".$photo_array['photo_name']."\"";?>><a href=<?php echo "\"".$photo_array['photo_big_address']."\"";?> id="goodsinfo_add" target="_blank">
                            查看原图</a></li>
                        <li sn="88344662" title=<?php echo "\"".$photo_array['photo_name']."\"";?>><a class="red" id="look_comments">隐藏评论</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--评论区域-->
    <div class="container">
        <div class="col-xs-12">
            <div id="comment-place">
                <div class="comment-post" id="comment-post">
                    <h3><i class="fa fa-commenting-o fa-fw"></i>评论</h3>
                    <div class="cancel-reply" id="cancel-reply" style="display: none;">
                        <a href="javascript:void(0);" onclick="$.comment.cancelReply(this)"><i class="fa fa-share"></i>取消回复</a>
                    </div>
                    <form class="form-horizontal" role="form" id="comment-form">
                        <input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1">
                        <div id="editor" style="width: 100%;height: 150px;">
                            <p>请输入评论</p>
                        </div>
                        <a id="comment-form-btn" type="button" data-loading-text="正在提交评论..."
                           class="btn btn-info btn-block">提交评论</a>
                    </form>
                </div>
            </div>

            <!-- 评论 -->
            <div class="commentList">
                <h3><i class="fa fa-comments-o fa-fw"></i><em><?php echo $comments_count; ?></em>条评论~~~</h3>
                <ul class="comment">
                    <?php
                    if(count($photo_comments)>0){
                     foreach ($photo_comments as $temp_comments) {
                            # code...
                            echo '<li>';
                            echo    '<div class="comment-body" id="comment-1">';
                            echo         '<div class="cheader">';
                            echo            '<img class="userImage" src="'.$temp_comments['user_head_image'].'">';
                            echo             '<strong>'.$temp_comments['user_name'].'</strong>';
                            echo            '<div class="timer">';
                            echo                '<i class="fa fa-clock-o fa-fw"></i>'.$temp_comments['comment_date'];
                            echo            '</div>';
                            echo        '</div>';
                            echo        '<div class="content">';
                            echo   $temp_comments['comment_content'];
                            echo        '</div>';
                            echo    '</div>';
                            echo    '</li>';
                        }   
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<?php
	include 'footer.php'
?>
<script type="text/javascript">
	function GetRequest() {
    var url = this.location.search; //获取url中"?"符后的字串
    var theRequest = new Object();
    if (url.indexOf("?") != -1) {
        var str = url.substr(1);
        strs = str.split("&");
        for(var i = 0; i < strs.length; i ++) {
            theRequest[strs[i].split("=")[0]]=unescape(strs[i].split("=")[1]);
        }
    }
    return theRequest;
	}
	var url=GetRequest();
	var photo_id=url['photo_id'];
	var user_id=$.cookie("user_id");
    var user_name=$.cookie("user_name");
	$(function(){
		$($(".btns>ul>li>a")[0]).click(function(){
    		$.ajax({
    			url:"./ps_up_dwon_history.php",
    			type:"post",
    			timeout:3000,
    			data:{"user_id":user_id,"photo_id":photo_id,"load_type":"0"},
    			dataType:"json",
    			success:function(result){
    				console.log(result);
    			}
    		});
		});
	});
    //查看评论点击查看和隐藏评论
    $("#look_comments").click(function(){
        $(".container").toggle();
        if(this.innerText==='显示评论'){
            this.innerText='隐藏评论';
        }else if(this.innerText==='隐藏评论'){
            this.innerText="显示评论";
        }else{
            console.log("hello word");
        }
    });

</script>