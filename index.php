<?php
    include 'ps_header.php'
?>
<?php
     
    include 'ps_connect.php';
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
    $topic_list_array=get_topic_list();
    /*
    * array unique_rand( int $min, int $max, int $num )
    * 生成一定数量的不重复随机数，指定的范围内整数的数量必须
    * 比要生成的随机数数量大
    * $min 和 $max: 指定随机数的范围
    * $num: 指定生成数量
    */
    function unique_rand($min, $max, $num) {
      $count = 0;
      $return = array();
      while ($count < $num) {
        $return[] = mt_rand($min, $max);
        $return = array_flip(array_flip($return));
        $count = count($return);
      }
      //打乱数组，重新赋予数组新的下标
      shuffle($return);
      return $return;
    }
 
    function get_random_pictures()
    {
        global $conn;
        //返回结果
        $pictures_array=[];
        //产生3个随机数
        //获取3个随机数
        $temp_random= unique_rand(1, 1406, 3);
        for($i=0;$i<3;++$i)
        {
            $temp_array=[];
            //sql  SELECT photo_address FROM `ps_photos` WHERE photo_id='1'
            $temp_query_sql="SELECT photo_address FROM ps_photos "." WHERE photo_id = '".$temp_random[$i]."'";
            $temp_result=$conn->query($temp_query_sql);
            if(mysqli_num_rows($temp_result)!==0)
            {
                //获取搜索结果
                $temp_results=$temp_result->fetch_array(MYSQLI_ASSOC);
                $temp_array['photo_address']=$temp_results['photo_address'];
                $temp_array['photo_id']=$temp_random[$i];

            }
            array_push($pictures_array,$temp_array);
        }
        return $pictures_array;

    }
  $rand_pictures=get_random_pictures();
  //上传图片数量最多的前5个用户；获取名称,用户id和作品数量; 
  function get_users(){
    global $conn;
    $result=[];
    //样例sql: SELECT user_id,COUNT(1) from ps_photos GROUP BY user_id
    $get_user_sql="SELECT user_id, COUNT(photo_id) AS photo_count from ps_photos GROUP BY user_id";
    $user_query_result=$conn->query($get_user_sql);
    if(mysqli_num_rows($user_query_result)!==0){
        $result=$user_query_result->fetch_all(MYSQLI_ASSOC);
    };
    //遍历查找用户基本信息
    //名称、head_image、
    for ($i=0; $i < count($result); $i++ ) { 
         # code...
        $temp_user_id=$result[$i]['user_id'];
        //sql样例： SELECT user_name,user_head_image FROM `ps_users` WHERE user_id=1
        $get_user_sql_2="SELECT user_name,user_head_image FROM `ps_users` WHERE user_id='".$temp_user_id."';";
        $user_query_result_2=$conn->query($get_user_sql_2);
        if(mysqli_num_rows($user_query_result_2)!==0){
            $result2=$user_query_result_2->fetch_array(MYSQLI_ASSOC);
            $result[$i]['user_name']=$result2['user_name'];
            $result[$i]['user_head_image']=$result2['user_head_image'];
        }

    }
    return $result;
  }
$user_array=get_users();
?>
<!--高步-->
<div class="h_slide">
    <!--幻灯片-->
    <div class="glide">
        <ul class="slides">
            <li class="banner slide"
                style="background: url(./upfile/1557803651webwxgetmsgimg.jpg) center center no-repeat;background-size: cover" 
                data-jump='./photo.php?photo_id=1416?user_id=<?php echo $my_user_id;?>' >
            <li class="banner slide"
                style="background: url(./upfile/1557803834webwxgetmsgimg2.jpg) center center no-repeat;background-size: cover"
                data-jump='./photo.php?photo_id=1417?user_id=<?php echo $my_user_id;?>'>
            <li class="banner slide"
                style="background: url(./upfile/1557804038webwxgetmsgimg3.jpg) center center no-repeat;background-size: cover"
                data-jump='./photo.php?photo_id=1418?user_id=<?php echo $my_user_id;?>'>
        </ul>
    </div>
    <div class="wrap">
        <!--  <div class="txts">
        <h2>张版权图片，等你前来探索！</h2>
        <h4>一周内有+张新增</h4>
        </div> -->
        <!--搜索框-->
        <div class="form">
            <!--查询表单-->
            <form action="./researcher_relsult.php" method="get" id="myformIndex">
                <!--搜索输入框-->
                <input type="text" class="txt" name="keyword" id="keywordindex" value=""
                       placeholder="搜索照片、矢量图和插画， 多个词语注意用空格分隔，支持双语哦" autocomplete="off"/>
                <div class="type" style="display:none">
                    <!--<h4>全部图片</h4>-->
                    <div class="bt">
                        <i class="n1"><img src="./htmlimg/ar.png"/></i>
                        <i class="n2"><img src="./htmlimg/af.png"/></i>
                    </div>
                    <select class="dropdown" name="phototype" style="display: none;">
                        <option value="" class="label">全部图片</option>
                        <option value="" class="label">全部图片</option>
                        <option value="photo">照片</option>
                        <option value="vector">矢量图</option>
                    </select>
                </div>
                <input type="submit" class="btn" name="" id="" value=""/>
            </form>
            <div id="srch_img" class="srch_img" style="display:none">
            </div>
        </div>
        <!--搜索热点关键字-->
        <div class="keys" style="top: 60%" style="display: none;">
            <ul>
                关键热词：
                <li><a target="_blank" href="./researcher_relsult.php?keyword=校园风景&user_id=<?php echo $my_user_id;?>">校园风景</a></li>
                <li><a target="_blank" href="./researcher_relsult.php?keyword=2019&user_id=<?php echo $my_user_id;?>">2019</a></li>
                <li><a target="_blank" href="./researcher_relsult.php?keyword=校园logo&user_id=<?php echo $my_user_id;?>">校园logo</a></li>
                <li><a target="_blank" href="./researcher_relsult.php?keyword=逸夫楼&user_id=<?php echo $my_user_id;?>">逸夫楼</a></li>
                <li><a target="_blank" href="./researcher_relsult.php?keyword=插画&user_id=<?php echo $my_user_id;?>">插画</a></li>
                <li><a target="_blank" href="./researcher_relsult.php?keyword=画册&user_id=<?php echo $my_user_id;?>">画册</a></li>
                <!--  <li><a target="_blank" href="">背景</a></li> -->
                <li><a target="_blank" href="./researcher_relsult.php?keyword=水墨&user_id=<?php echo $my_user_id;?>">水墨</a></li>
            </ul>
        </div>
        <div class="h_slide_msg" style="display: none;">
            优秀校园摄影图片展示网站！在线2259张图片，本周新增3448张
        </div>
    </div>
</div>
<!--下部浮动栏1-->
<div class="h_row1" style="display: none;">
    <div class="wrapper">
        <ul>
            <li>
                <a href="" target="_blank">
                    <div class="h_row1_img">
                        <img src="http://meisudci.oss-cn-beijing.aliyuncs.com/large/MSBQ13715300038307.jpg"/>
                        <span class="btn">节气插画</span>
                    </div>
                </a>
                <!--底部正版描述-->
                <!-- <div class="h_row1_txt">
                    <a href="" target="_blank">
                        <span class="ico"><img src="./htmlimg/h-ico1.png"/></span>
                        <h3>100%正版</h3>
                        <p class="desc">拒绝盗版，高额赔付，平台对作品版权永久担保，拒绝任何版权困扰</p>
                    </a>
                </div> -->
            </li>
            <li>
                <a href="" id="buy-novice-package">
                    <div class="h_row1_img">
                        <img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/1062377/28683547/api_thumb_450.jpg"/>
                        <div class="btn">美丽自然</div>
                    </div>
                </a>
                <!-- <div class="h_row1_txt">
                    <a target="_blank" href="">
                        <span class="ico"><img src="./htmlimg/h-ico2.png"/></span>
                        <h3>价格低廉</h3>
                        <p class="desc">统一售价，随时付款，真正的互联网式图片解决方案</p>
                    </a>
                </div> -->
            </li>
            <li>
                <a href="" target="_blank">
                    <div class="h_row1_img">
                        <img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/1001001/125668878/api_thumb_450.jpg"/>
                        <div class="btn">呦呦鹿鸣</div>
                    </div>
                </a>
                <!-- <div class="h_row1_txt">
                    <a target="_blank" href="">
                        <span class="ico"><img src="./htmlimg/h-ico3.png"/></span>
                        <h3>海量图片库</h3>
                        <p class="desc">每周更新100万张图片，其中有5000万矢量插画套餐内免费下载</p>
                    </a>
                </div> -->
            </li>
            <li>
                <a href="" target="_blank">
                    <div class="h_row1_img">
                        <img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/2565305/200882144/api_thumb_450.jpg"/>
                        <div class="btn">新年贺岁</div>
                    </div>
                </a>
                <!--  <div class="h_row1_txt">
                     <span class="ico"><img src="./htmlimg/h-ico4.png"/></span>
                     <h3>发票支持</h3>
                     <p class="desc">支持普通发票和增值税发票，流程简单，购买后可在线提交发票申请</p>
                 </div> -->
            </li>
        </ul>
    </div>
</div>
<div class="h_row_bg">
    <div class="h_row2">
        <div class="wrapper">
            <div class="h_row_tit">
                <p class="cn">每日图片推荐<!-- <span id="free-pictures-login">注册</span>就送</p> -->
                <p class="en">Featured pictures</p>
            </div>
            <div class="h_row2_main">
                <ul>
                   <!--  <li class="li"><a href="" target="_blank"><img src="./htmlimg/1548729910.485866.jpg"/></a></li>
                    <li class="li"><a href="" target="_blank"><img src="./htmlimg/1548729954.960632.jpg"/></a></li>
                    <li class="li"><a href="" target="_blank"><img src="./htmlimg/1548730000.720496.jpg"/></a></li> -->
                    <?php
                        foreach ($rand_pictures as $temp) {
                            echo '<li class="li"><a href="./photo.php?photo_id='.$temp['photo_id'].'&user_id='.$my_user_id.'" target="_blank"><img src="'.$temp['photo_address'].'"/></a></li>';
                        }
                    ?>
                    <!--<li class="l1"><a href=""><img src="./htmlimg/h-img5.jpg"/></a></li>-->
                    <!--<li class="l2"><a href=""><img src="./htmlimg/h-img6.jpg"/></a></li>-->
                    <!--<li class="l3"><a href=""><img src="./htmlimg/h-img7.jpg"/></a></li>-->
                </ul>
            </div>
        </div>
    </div>
    <div class="h_row3" id="h_row3">
        <div class="wrapper">
            <div class="h_row_tit">
                <p class="cn">精选专辑</p>
                <p class="en">Selected Album</p>
                <a class="more-topic-btn" href="" target="_blank" style="display: none;">更多专辑</a>
            </div>
            <div class="h_row3_main">
                <ul>
                <?php
                        for($i=0;$i<count($topic_list_array)&&$i<12;++$i) {
                            $temp=$topic_list_array[$i];
                            $li=$i+1;
                            echo '<li class="l'.$li.'">';
                            echo '  <a href="'."topic.php?topic_id=".$temp['topic_id']."&user_id=".$my_user_id.'" target="_blank">';
                            echo '     <img src="'.$temp['display_photo_little_url'].'"/>';
                            echo '     <div class="h_row3_mask">';
                            echo '          <h3>'.$temp['topic_name'].'</h3>';
                            echo '          <p><i class="h_ico_album"></i>'.$temp['topic_message'].'</p>';
                            echo '     </div>';
                            echo '    </a>';    
                            echo '</li>';
                        }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="h_row5">
    <div class="wrapper">
        <div class="h_row_tit">
            <p class="cn">艺术家</p>
            <p class="en">selected Artists</p>
        </div>
        <div class="h_row5_main">
            <ul>
                <!--输出用户数组-->
                <?php
                foreach ($user_array as $temp_user) {
                    echo '<li>';
                    //echo '<a href="'.'./user.php?user_id='.$temp_user['user_id'].'"  target="_blank">';
                    echo '<div class="h_row5_img">';
                    echo       '<img src="'.$temp_user['user_head_image'].'"/>';
                    echo  '<span class="msg"><big>'.$temp_user['photo_count'].'</big>/作品</span>';
                    echo  '</div>';
                    echo  '<p class="h_row5_txt">'.$temp_user['user_name'].'</p>';
                    //echo '</a>';
                    echo  '</li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>
<input type="hidden" name="is_index" id="is_index" value="index.php"/>


<div class="layui-receive1 d_none" id="receive1_wrap">
    <div class="hd">领取成功</div>
    <div class="bd">
        <p class="txt">
            两张代金券已放入您的账户<br>
            <strong class="c-red">会员制版权图库</strong>网站上线后即可使用
        </p>
        <p class="img"><img src="./htmlimg/receive1_img.png"/></p>
    </div>
    <div class="ft">
        <a class="btn" id="close-get-discount" href="">我知道了</a>
    </div>
</div>

<div class="layui-cashcoupon d_none" id="cashcoupon_wrap">
    <div class="cashcoupon-main">
        <div class="cashcoupon-tip">
            <img src="./htmlimg/cashcoupon-img2.png"/>
        </div>
        <div class="cashcoupon-txt">
            谢谢你愿意耐心陪同我们成长<br>
            在这个特殊的春节奉上代金券两张
        </div>
        <div class="cashcoupon-list">
            <div class="bd">
                <div class="item">
                    <div class="item-l">
                        <p class="big">代金券</p>
                        <p class="small">满169使用</p>
                    </div>
                    <div class="item-r">
                        <span class="num">80</span> 元
                    </div>
                </div>
                <div class="item">
                    <div class="item-l">
                        <p class="big">代金券</p>
                        <p class="small">满99元使用</p>
                    </div>
                    <div class="item-r">
                        <span class="num">50</span> 元
                    </div>
                </div>
            </div>
            <div class="ft">
                <p class="time">有效期至2019-03-31</p>
                <a class="btn" id="get-bn-discount" href="">立即领取</a>
            </div>
        </div>
    </div>
</div>


<?php
    include 'footer.php'
?>
<script type="text/javascript">
</script>
