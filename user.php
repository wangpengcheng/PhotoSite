<?php
	include "ps_header.php";
?>
<?php
    include 'ps_connect.php';
    function get_history($user_id){
        global $conn;//设置全局变量
        $get_histroy_sql="SELECT ps_photos.photo_id,photo_address,record_time FROM ps_photos,ps_user_browserecord where ps_user_browserecord.user_id='".$user_id."' and ps_user_browserecord.photo_id=ps_photos.photo_id"; 
        //SELECT ps_photos.photo_id,photo_address,record_time FROM ps_photos,ps_user_browserecord where ps_user_browserecord.user_id='1' and ps_user_browserecord.photo_id=ps_photos.photo_id
        $user_history_result=$conn->query($get_histroy_sql);
        $histroy_row_count=mysqli_num_rows($user_history_result);
        $result=$user_history_result->fetch_all(MYSQLI_ASSOC);
        return $result;
    }
    $user_id=get_user_id($page_query);
    $user_history_result=get_history($user_id);

    //最近浏览图片
    $last_looked_photos=[];
    //sql示例： SELECT photo_id,record_time FROM ps_user_browserecord WHERE user_id=0 ORDER BY record_time DESC LIMIT 10 
    //抽取10个
    $looked_sql="SELECT photo_id FROM ps_user_browserecord WHERE user_id='".$user_id."' GROUP BY photo_id ORDER BY record_time DESC LIMIT 10 ;";
    $looked_result=$conn->query($looked_sql);
    if(mysqli_num_rows($looked_result)>0){
        $last_looked_photos=$looked_result->fetch_all(MYSQLI_ASSOC);
        for ($i=0; $i <count($last_looked_photos) ; $i++) { 
            $new_sql="SELECT photo_address FROM ps_photos WHERE photo_id='".$last_looked_photos[$i]['photo_id']."'";
            $temp_result=$conn->query($new_sql);
            if(mysqli_num_rows($temp_result)>0){
                $temp_result_plus=$temp_result->fetch_all(MYSQLI_ASSOC);
                $last_looked_photos[$i]['photo_address']=$temp_result_plus[0]['photo_address'];
            }
        }
    }
    
    //数据显示数组，3行6例。
    $data_show=[];
    //获取上传下载和浏览;
    $upload_record_count=[];
    $brower_record=[];
    //获取上传记录 SELECT photo_id ,load_time FROM `ps_load_history` WHERE user_id=19 AND load_type=0;
    $upload_record_sql="SELECT photo_id ,load_time FROM `ps_load_history` WHERE user_id=19 AND load_type=0;";

    //获取上传记录统计
    //select CONCAT(DATE_FORMAT(load_time,'%m')) months ,COUNT(load_id) as count_id from ps_load_history WHERE user_id=19 AND load_type=0 GROUP BY months
    //获取上传统计
    $upload_record_count_sql="select CONCAT(DATE_FORMAT(load_time,'%m')) months ,COUNT(load_id) as count_id from ps_load_history WHERE user_id='".$user_id."' AND load_type=1 GROUP BY months";
    $upload_record_count_result=$conn->query($upload_record_count_sql);//查询结果
    if(mysqli_num_rows($upload_record_count_result)>0){
        $upload_record_count_result_2=$upload_record_count_result->fetch_all(MYSQLI_ASSOC);
        //print_r($upload_record_count_result_2);
    }
    //获取下载统计数据
    $download_record_count_sql="select CONCAT(DATE_FORMAT(load_time,'%m')) months ,COUNT(load_id) as count_id from ps_load_history WHERE user_id='".$user_id."' AND load_type=0 GROUP BY months";
    $download_record_count_result=$conn->query($download_record_count_sql);//查询结果
    if(mysqli_num_rows($download_record_count_result)>0){
        $download_record_count_result_2=$download_record_count_result->fetch_all(MYSQLI_ASSOC);
        //print_r($download_record_count_result_2);
    }

    //获取浏览统计数据
    //select CONCAT(DATE_FORMAT(record_time,'%m')) months ,COUNT(record_id) as count_id from ps_user_browserecord WHERE user_id=19 GROUP BY months
    $brower_record_count_sql="select CONCAT(DATE_FORMAT(record_time,'%m')) months ,COUNT(record_id) as count_record from ps_user_browserecord WHERE user_id='".$user_id."'GROUP BY months";
    $brower_record_count_result=$conn->query($brower_record_count_sql);//查询结果
    if(mysqli_num_rows($brower_record_count_result)>0){
        $brower_record_count_result_2=$brower_record_count_result->fetch_all(MYSQLI_ASSOC);
        //print_r($brower_record_count_result_2);
    }

    $col_1_array=[];
    $col_2_array=[];
    $col_3_array=[];
    $upload_all_count=0;
    $download_all_count=0;
    //处理函数；将数据整合成合理的格式,主要上传下载记录，浏览记录
    for ($i=1; $i <=6 ; $i++) { 
        foreach ($upload_record_count_result_2 as $temp_1) {
            if($temp_1['months']==$i){
                $col_1_array[$i]=$temp_1['count_id'];
                $upload_all_count+=$temp_1['count_id'];
            }
        }
        if(empty($col_1_array[$i])){
            $col_1_array[$i]=0;
        }
        foreach ($download_record_count_result_2 as $temp_2) {
            if($temp_2['months']==$i){
                $col_2_array[$i]=$temp_2['count_id'];
                $download_all_count+=$temp_2['count_id'];
            }
        }
        if(empty($col_2_array[$i])){
            $col_2_array[$i]=0;
        }
        foreach ($brower_record_count_result_2 as $temp_3) {
            if($temp_3['months']==$i){
                $col_3_array[$i]=$temp_3['count_record'];
            }
        }
        if(empty($col_3_array[$i])){
            $col_3_array[$i]=0;
        }

    }

    array_push($data_show,$col_1_array);//上传
    array_push($data_show,$col_2_array);//下载
    array_push($data_show,$col_3_array);//浏览

    //显示数据表格
    $updown_record=[];
    $updown_record_sql="SELECT photo_id ,load_time,load_type FROM ps_load_history WHERE user_id='".$user_id."' AND load_type=0;";
    $updown_record_result=$conn->query($updown_record_sql);
    if(mysqli_num_rows($updown_record_result)>0){
        $updown_record_result_2=$updown_record_result->fetch_all(MYSQLI_ASSOC);
        //查询图片表，获得图片 name,address,
            for ($i=0; $i <count($updown_record_result_2) ; $i++) {
                $photo_message_sql="SELECT photo_address,photo_name FROM ps_photos WHERE photo_id='".$updown_record_result_2[$i]['photo_id']."'";
                $photo_temp_result=$conn->query($photo_message_sql); 
                if(mysqli_num_rows($photo_temp_result)>0){
                    $photo_temp_result_plus=$photo_temp_result->fetch_all(MYSQLI_ASSOC);
                    $updown_record_result_2[$i]['photo_address']=$photo_temp_result_plus[0]['photo_address'];
                    $updown_record_result_2[$i]['photo_name']=$photo_temp_result_plus[0]['photo_name'];
                }
            }
    }
    //查询user表更改user基本信息。手机号码，昵称，真实姓名，公司名称，QQ 邮箱 ，密码
    $user_information_sql="SELECT user_phone_number,user_head_image,user_little_name,user_real_name,user_company,user_qq,user_email,user_pwd,user_state FROM `ps_users` WHERE user_id='".$user_id."'";
    $user_information_result=$conn->query($user_information_sql);
    if(mysqli_num_rows($user_information_result)){
        $user_information=$user_information_result->fetch_array(MYSQLI_ASSOC);
    }
?>
 <!--echarts start-->
    <script type="text/javascript" src="./js/echarts/echarts.min.js"></script>
    <script type="text/javascript" src="./js/ecStat.min.js"></script>
    <script type="text/javascript" src="./js/dataTool.min.js"></script>
    <script type="text/javascript" src="./js/simplex.js"></script>
    <script type="text/javascript" src="./js/user.js"></script>
    <style id="poshytip-css-tip-twitter" type="text/css">
        div.tip-twitter {
            visibility: hidden;
            position: absolute;
            top: 0;
            left: 0;
        }

        div.tip-twitter table, div.tip-twitter td {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            font-weight: inherit;
            font-style: inherit;
            font-variant: inherit;
        }

        div.tip-twitter td.tip-bg-image span {
            display: block;
            font: 1px/1px sans-serif;
            height: 10px;
            width: 10px;
            overflow: hidden;
        }

        div.tip-twitter td.tip-right {
            background-position: 100% 0;
        }

        div.tip-twitter td.tip-bottom {
            background-position: 100% 100%;
        }

        div.tip-twitter td.tip-left {
            background-position: 0 100%;
        }

        div.tip-twitter div.tip-inner {
            background-position: -10px -10px;
        }

        div.tip-twitter div.tip-arrow {
            visibility: hidden;
            position: absolute;
            overflow: hidden;
            font: 1px/1px sans-serif;
        }
    </style>
    <!--echart end-->
<div class="pt40 pb150 center_wrap">
    <div class="wrapper">
        <div class="head">
            <ul class="naver">
                <li id="my_main" class="c1"><a >我的首页</a></li>
                <li id="down_load_button"><a>我的收藏</a></li>
                <li id="up_load_button" style="display: none;"><a>上传记录</a></li>
                <li id="collection_manage_button" style="display: none;"><a>我的收藏</a></li>
                <li id="my_histroy_button" style="display: none;"><a>我的足迹</a></li>
                <li id="add_topic" style="<?php if($user_information['user_state']!=0){echo 'display: none;';}?>"><a>添加专题</a></li>
                <li id="my_manage_button" class="last"><a>账户管理</a></li>
            </ul>
            <div class="avatar">
                <a href="javascript:void(0)">
                    <div class="img" id="changeavatar">
                        <img src="<?php echo $user_information['user_head_image']; ?>">
                        <div class="mk">
                            点击修改
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!--我的首页-->
        <div class="body user_home">
            <div class="state">
                <ul>
                    <a href="user.php?act=down_list">
                        <li><big><?php echo $download_all_count;?></big>已下载</li>
                    </a>
                    <a href="user.php?act=package">
                        <li><big><?php echo $upload_all_count;?></big>已上传</li>
                    </a>
                </ul>
            </div>
            <div class="item">
                <div class="hd">
                    <h2>数据统计</h2>
                    <span></span>
                </div>
                <div class="ui_imgs mt30" style="height: 600px;">
                    <div id="container" style="height: 100%; -webkit-tap-highlight-color: transparent; user-select: none; position: relative;" _echarts_instance_="ec_1552811171699"><div style="position: relative; overflow: hidden; width: 1040px; height: 600px; padding: 0px; margin: 0px; border-width: 0px; cursor: default;"><canvas data-zr-dom-id="zr_0" width="1040" height="600" style="position: absolute; left: 0px; top: 0px; width: 1040px; height: 600px; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); padding: 0px; margin: 0px; border-width: 0px;"></canvas></div><div></div></div>
                </div>
            </div>
            <div class="item">
                <div class="hd">
                    <!--<h2>2019-02-10　今天</h2>-->
                    <!--显示最近浏览的最多10条记录-->
                    <h2>最近浏览</h2>
                    <span></span>
                </div>
                <div class="ui_imgs mt30">
                    <ul class="container">
                        <?php 
                        foreach ($last_looked_photos as $temp_look) {
                            echo '<li class="item last-row" style="margin-right: 10px;">';
                            echo    '<a href="'.'./photo.php?photo_id='.$temp_look['photo_id'].'&user_id='.$user_id.'" target="_blank">';
                            echo        '<img src="'.$temp_look['photo_address'].'">';
                            echo     '</a>';
                            echo '</li>';
                        }

                        ?>

                    </ul>
                </div>
            </div>
            <div class="item mt60" style="display: none;">
                <div class="hd">
                    <!--<h2>2019-02-20　昨天</h2>-->
                    <h2>最近30天</h2>
                    <span></span>
                </div>
                <div class="mt30 ui_imgs">
                    <ul class="container">
                        <li class="item last-row" style="margin-right: 0px;">
                            <div class="img">
                                <a href="goods.php?media_id=MSBQ13715300095548" target="_blank">
                                    <img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs//MSBQ13715300095548/MSBQ13715300095548.jpg">
                                </a>
                            </div>
                            <div class="cover ui_cover">
                                <dl sn="MSBQ13715300095548" title="扔满纸团的桌面">
                                    <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                    <dd class="sp1_1" title="已经添加"></dd>
                                    <dd class="sp2" title="添加至收藏夹"></dd>
                                    <dd class="sp2_1" title="取消收藏"></dd>
                                    <dd class="sp3" title="查看相似图片 "></dd>
                                </dl>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--我的订单-->
        <div class="body user_order" style="display: none;">
            <div class="ui_no">
                <a href="./">
                    <div class="ico">
                    </div>
                    <div class="txt mt10">
                        <p>还没有下载哦，<br>去海量图片库挑选下吧</p>
                    </div>
                </a>
            </div>
        </div>
        <!--我的下载-->
        <div class="body user_manage user_manage1" style="display: none;">
            <!--          <div class="hd">
              <ul>
                <li class="c1">单张下载记录(0)<span></span></li>
                <li>批量下载记录(0)<span></span></li>
              </ul>
             </div> -->
            <div class="user_record mt40 bd">
                <table width="100%" class="ui_table" border="0" cellspacing="0">
                    <tbody>
                    <tr class="frist">
                        <td width="" height="55" align="center">图片信息<span>|</span></td>
                        <td width="15%" height="55" align="center">时间<span>|</span></td>
                        <td width="15%" height="55" align="center">类型<span>|</span></td>
                    </tr>
                    <?php
                    foreach ($updown_record_result_2 as $temp_key) {
                        echo '<tr>';
                        echo '<td height="170" align="center">';
                        echo     '<div class="img left">';
                        echo         '<a href="./photo.php?photo_id='.$temp_key['photo_id'].'user_id='.$user_id.'" target="_blank">';
                        echo             '<img src="'.$temp_key['photo_address'].'" style="height: 100px;max-width: 100px">';
                        echo        '</a>';
                        echo    '</div>';
                        echo    '<div class="txt left max-350">';
                        echo        '<p>图片ID：'.$temp_key['photo_id'].'</p>';
                        echo        '<p>'.$temp_key['photo_name'].'</p>';
                        echo    '</div>';
                        echo '</td>';
                        echo '<td height="170" align="center">'.$temp_key['load_time'].'</td>';

                        echo '<td height="170" align="center">';
                        // if($temp_key['load_type']==0){
                        //     echo "下载";
                        // }else{
                        //     echo "上传";
                        // }
                        echo "收藏";
                        echo '</td>';
                        echo '</tr>';
                     } 
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--我的上传-->
        <div class="body user_manage user_upload" style="display: none;">
            <!--          <div class="hd">
              <ul>
                <li class="c1">单张下载记录(0)<span></span></li>
                <li>批量下载记录(0)<span></span></li>
              </ul>
             </div> -->
            <div class="user_record mt40 bd">
                <table width="100%" class="ui_table" border="0" cellspacing="0">
                    <tbody>
                    <tr class="frist">
                        <td width="" height="55" align="center">图片信息<span>|</span></td>
                        <td width="12%" height="55" align="center">所属账户<span>|</span></td>
                        <td width="15%" height="55" align="center">时间<span>|</span></td>
                        <td width="10%" height="55" align="center">图片下载<span>|</span></td>
                        <td width="10%" height="55" align="center">授权</td>
                    </tr>
                    <tr>
                        <td height="170" align="center">
                            <div class="img left">
                                <a href="goods.php?media_id=MSBQ13715300036172" target="_blank">
                                    <img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs//MSBQ13715300036172/MSBQ13715300036172.jpg" style="height: 100px;max-width: 100px">
                                </a>
                            </div>
                            <div class="txt left max-350">
                                <p>图片ID：MSBQ13715300036172</p>
                                <p>圆形蛋糕3</p>
                                <p>尺寸：XL</p>
                            </div>
                        </td>
                        <td height="170" align="center">主账户</td>
                        <td height="170" align="center">2019-02-21</td>

                        <td height="170" align="center">
                            <a href="javascript:void(0)"><i data-sn="MSBQ13715300036172" data-rec-id="142813" class="botton_down"></i></a>


                        </td>

                        <td height="170" align="center">
                            <p class="xiazai" rec_id="142813"><i class="botton_shouquan"></i></p>
                        </td>
                    </tr>
                    <!--单行-->
                    <tr>
                        <td height="170" align="center">
                            <div class="img left">
                                <a href="goods.php?media_id=MSBQ13715300070585" target="_blank">
                                    <img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs//MSBQ13715300070585/MSBQ13715300070585.jpg" style="height: 100px;max-width: 100px">
                                </a>
                            </div>
                            <div class="txt left max-350">
                                <p>图片ID：MSBQ13715300070585</p>
                                <p>圣诞节装饰小猫</p>
                                <p>尺寸：XL</p>
                            </div>
                        </td>
                        <td height="170" align="center">主账户</td>
                        <td height="170" align="center">2019-02-21</td>

                        <td height="170" align="center">
                            <a href="javascript:void(0)"><i data-sn="MSBQ13715300070585" data-rec-id="142807" class="botton_down"></i></a>
                        </td>

                        <td height="170" align="center">
                            <p class="xiazai" rec_id="142807"><i class="botton_shouquan"></i></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!--我的收藏-->
        <div class="body user_home user_collection collection_new" style="display: none;">
            <div class="hd gy_default">
                <dl>
                    <dd id="xj"><a href="javascript:void(0)">新建</a></dd>
                    <dd id="copy-collection"><a href="javascript:void(0)">导入收藏夹</a></dd>
                    <dd id="batch"><a href="javascript:void(0)">图片批量管理</a></dd>
                </dl>
            </div>
            <div class="hd gy_check" style="display: none">
                <ul class="collection_item01">
                    <li>
                        <input name="checkbox" type="checkbox" class="xcheck checkAllCurrent" value="" id="checkbox1" autocomplete="off">
                        <label for="checkbox1" class="on" autocomplete="off"></label>
                    </li>
                    <li>本页全选</li>
                    <li>已选择 <span id="checkbox_count">0</span> 张</li>
                </ul>
                <dl>
                    <dd id="transfer_n"><a href="javascript:void(0)">移动</a></dd>
                    <dd id="del_goods"><a href="javascript:void(0)">删除</a></dd>
                    <dd id="batch_cancel"><a href="javascript:void(0)">取消</a></dd>
                </dl>
            </div>
            <div class="collection_item">
                <ul class="">
                    <li class="c1"><a href="user.php?act=collection_list">默认 1</a><span></span></li>
                    <li><a href="user.php?act=collection_list&amp;class_id=20114">test 0</a></li>
                </ul>
            </div>
            <div id="searchCon2" class="imgs ui_imgs">
                <ul class="imgList" style="margin-left: -5px; margin-right: -5px;">

                    <li class="imgItem maskWraper item" data-width="450" data-height="300" style="width: 378px; height: 252px; margin: 5px;">
                        <div class="ch_box">
                            <input name="checkbox" type="checkbox" class="xcheck checkItem" value="MSBQ13715300095548" id="checkboxMSBQ13715300095548" autocomplete="off">
                            <label for="checkboxMSBQ13715300095548"></label>
                        </div>
                        <div class="cover ui_cover">
                            <dl sn="MSBQ13715300095548" title="扔满纸团的桌面" class_id="0" at="co">
                                <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                <dd class="sp1_1" title="已经添加"></dd>
                                <dd class="sp2" style="display: none;" title="添加至收藏夹"></dd>
                                <dd class="sp2_1" style="display: block;" title="取消收藏"></dd>
                                <dd class="sp3" title="查看相似图片 "></dd>
                                <dd class="sp4" title="移动至其他收藏夹 "></dd>
                            </dl>
                        </div>
                        <a href="goods.php?media_id=MSBQ13715300095548" target="_blank"><img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs//MSBQ13715300095548/MSBQ13715300095548.jpg" style="width: 378px;"></a>
                    </li>

                </ul>
            </div>
            <div class="ui_pages">

                <form name="selectPageForm" action="/user.php" method="get">
                    <ul>
                    </ul>
                </form>
                <script type="Text/Javascript" language="JavaScript">
                    <!--
                    function selectPage(sel) {
                        sel.form.submit();
                    }

                    //-->
                </script>
            </div>
        </div>
        <!--我的足迹 ps:和首页相同-->
        <div class="body user_home user_footprint" style="display: none;">
            <div class="item">
                <div class="hd">
                    <h2>2019-02-21　今天</h2>
                    <span></span>
                </div>
                <div class="ui_imgs mt30">
                    <ul class="container">

                        <li class="item last-row" style="margin-right: 10px;">

                            <div class="cover ui_cover">
                                <dl sn="MSBQ13715300036172" title="圆形蛋糕3">
                                    <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                    <dd class="sp1_1" title="已经添加"></dd>
                                    <dd class="sp2" title="添加至收藏夹"></dd>
                                    <dd class="sp2_1" title="取消收藏"></dd>
                                    <dd class="sp3" title="查看相似图片 "></dd>
                                </dl>
                            </div>
                            <a href="goods.php?media_id=MSBQ13715300036172" target="_blank"><img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs//MSBQ13715300036172/MSBQ13715300036172.jpg"></a>
                        </li>

                        <li class="item" style="margin-right: 10px;">

                            <div class="cover ui_cover">
                                <dl sn="MSBQ13715300070585" title="圣诞节装饰小猫">
                                    <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                    <dd class="sp1_1" title="已经添加"></dd>
                                    <dd class="sp2" title="添加至收藏夹"></dd>
                                    <dd class="sp2_1" title="取消收藏"></dd>
                                    <dd class="sp3" title="查看相似图片 "></dd>
                                </dl>
                            </div>
                            <a href="goods.php?media_id=MSBQ13715300070585" target="_blank"><img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs//MSBQ13715300070585/MSBQ13715300070585.jpg"></a>
                        </li>

                        <li class="item" style="margin-right: 10px;">

                            <div class="cover ui_cover">
                                <dl sn="2944520" title="背景颜色蓝色金属的">
                                    <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                    <dd class="sp1_1" title="已经添加"></dd>
                                    <dd class="sp2" title="添加至收藏夹"></dd>
                                    <dd class="sp2_1" title="取消收藏"></dd>
                                    <dd class="sp3" title="查看相似图片 "></dd>
                                </dl>
                            </div>
                            <a href="goods.php?media_id=2944520" target="_blank"><img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/1001416/2944520/api_thumb_450.jpg"></a>
                        </li>

                        <li class="item" style="margin-right: 0px;">

                            <div class="cover ui_cover">
                                <dl sn="60052699" title="流动的蓝色抽象背景中的微生物">
                                    <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                    <dd class="sp1_1" title="已经添加"></dd>
                                    <dd class="sp2" title="添加至收藏夹"></dd>
                                    <dd class="sp2_1" title="取消收藏"></dd>
                                    <dd class="sp3" title="查看相似图片 "></dd>
                                </dl>
                            </div>
                            <a href="goods.php?media_id=60052699" target="_blank"><img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/2235295/60052699/api_thumb_450.jpg"></a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="item mt60">
                <div class="hd">
                    <h2>2019-02-20　昨天</h2>
                    <span></span>
                </div>
                <div class="mt30 ui_imgs">
                    <ul class="container">

                        <li class="item last-row" style="margin-right: 0px;">
                            <div class="img">
                                <a href="goods.php?media_id=MSBQ13715300095548" target="_blank"><img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs//MSBQ13715300095548/MSBQ13715300095548.jpg"></a>
                            </div>
                            <div class="cover ui_cover">
                                <dl sn="MSBQ13715300095548" title="扔满纸团的桌面">
                                    <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                    <dd class="sp1_1" title="已经添加"></dd>
                                    <dd class="sp2" title="添加至收藏夹"></dd>
                                    <dd class="sp2_1" title="取消收藏"></dd>
                                    <dd class="sp3" title="查看相似图片 "></dd>
                                </dl>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="item mt60" style="display: none;">
                <div class="hd">
                    <h2>30天内</h2>
                    <span></span>
                </div>
                <div class="mt30 ui_imgs">
                    <ul class="container">

                        <li class="item last-row" style="margin-right: 10px;">
                            <div class="img">
                                <a href="goods.php?media_id=88344662" target="_blank"><img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/1592314/88344662/api_thumb_450.jpg"></a>
                            </div>
                            <div class="cover ui_cover">
                                <dl sn="88344662" title="圣诞装饰红色星和古董婴儿鞋">
                                    <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                    <dd class="sp1_1" title="已经添加"></dd>
                                    <dd class="sp2" title="添加至收藏夹"></dd>
                                    <dd class="sp2_1" title="取消收藏"></dd>
                                    <dd class="sp3" title="查看相似图片 "></dd>
                                </dl>
                            </div>
                        </li>

                        <li class="item" style="margin-right: 0px;">
                            <div class="img">
                                <a href="goods.php?media_id=20177673" target="_blank"><img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/1005833/20177673/api_thumb_450.jpg"></a>
                            </div>
                            <div class="cover ui_cover">
                                <dl sn="20177673" title="美丽年轻的金发女孩，穿着黑色衣服的肖像">
                                    <dd class="sp1" title="添加至购物车" style="display: none;"></dd>
                                    <dd class="sp1_1" title="已经添加"></dd>
                                    <dd class="sp2" title="添加至收藏夹"></dd>
                                    <dd class="sp2_1" title="取消收藏"></dd>
                                    <dd class="sp3" title="查看相似图片 "></dd>
                                </dl>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <!--账号管理-->
        <div class="body user_manage user_manage2" style="display: none;">
            <div class="hd">
                <ul>
                    <li class="c1"><a href="user.php?act=profile">账户设置</a><span></span></li>
                </ul>
            </div>
            <div class="bd user_subaccount">
                <h3>设置账户信息，<span>*</span>号为必填项</h3>
                <div class="result">
                    <form name="formEdit" action="user.php" method="post" onsubmit="return userEdit()">
                        <ul>
                            <li>
                                <h5>手机号码</h5>
                                <input type="text" name="extend_field5" class="p_txt p_txt01" id="user_phone_number" readonly="" value="<?php echo $user_information['user_phone_number'] ?>">

                            </li>
                            <li>
                                <h5>昵称<span>*</span></h5>
                                <input type="text" name="extend_field102" class="p_txt" id="user_little_name" value="<?php echo $user_information['user_little_name'] ?>">
                            </li>
                            <li>
                                <h5>真实姓名</h5>
                                <input type="text" name="extend_field100" class="p_txt" id="user_real_name" value="<?php echo $user_information['user_real_name'] ?>">
                            </li>
                            <li>
                                <h5>公司名称</h5>
                                <input type="text" name="extend_field101" class="p_txt" id="user_company" value="<?php echo $user_information['user_company'] ?>" placeholder="个人用户无需填写">
                            </li>
                            <li>
                                <h5>QQ</h5>
                                <input type="text" name="extend_field2" id="user_qq" class="p_txt" value="<?php echo $user_information['user_qq'] ?>">
                            </li>
                            <li>
                                <h5>邮箱</h5>
                                <input type="text" name="email" class="p_txt" id="user_email" value="<?php echo $user_information['user_email'] ?>">
                            </li>
                            <li class="edit_password">
                                <h5>当前密码</h5>
                                <!--当前密码输入窗口-->
                                <input type="password" name="" readonly="" class="p_txt p_txt01 p_txt02" id="now_password" value="<?php echo $user_information['user_pwd'] ?>">
                                <a href="javascript:void(0)" class="xg_mm">修改密码</a>
                            </li>
                            <li class="last">
                                <input name="act" type="hidden" value="act_edit_profile">
                                <!--保存基本信息按钮-->
                                <input type="button" class="subm" name="" id="save_inform_button" value="保    存">
                            </li>
                        </ul>
                    </form>
                </div>
                <div class="result result01 xg_mm_div" style="display: none">
                    <form name="formPassword" action="user.php" method="post" onsubmit="return editPassword()">
                        <ul>
                            <li>
                                <h5>当前密码<span>*</span></h5>
                                <input type="password" name="old_password" class="p_txt" id="old_password" value="">
                            </li>
                            <li>
                                <h5>新密码<span>*</span></h5>
                                <input type="password" name="new_password" class="p_txt" id="new_password1" value="" placeholder="6-16位数字或英文，暂不支持@#等特殊字符">
                            </li>
                            <li>
                                <h5>确认新密码<span>*</span></h5>
                                <input type="password" name="comfirm_password" class="p_txt" id="new_password2" value="" placeholder="6-16位数字或英文，暂不支持@#等特殊字符">
                            </li>
                            <li class="last">
                                <input name="act" type="hidden" value="act_edit_password">
                                <input type="button" class="subm" name="" id="save_password_button" value="保    存"><a class="ui_btn n2 subm_cancel" href="javascript:void(0)">取消</a>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
        <!--添加专题-->
        <div class="body user_manage add_topic2" style="display: none;">
            <div class="hd">
                <ul>
                    <li class="c1"><a href="user.php?act=profile">创建专题</a><span></span></li>
                </ul>
            </div>
            <div class="bd user_subaccount">
                <h3>创建专题，<span>*</span>号为必填项</h3>
                <div class="result">
                    <form name="formEdit" action="user.php" method="post" onsubmit="return userEdit()">
                        <ul>
                            <li>
                                <h5>专题名称</h5>
                                <input type="text" name="topic_name" class="p_txt" id="topic_name"  value="">

                            </li>
                            <li>
                                <h5>主页大图URL地址<span>*</span></h5>
                                <input type="text" name="display_photo_url" class="p_txt" id="display_photo_url" value="">
                            </li>
                            <li>
                                <h5>展示URL地址<span>*</span></h5>
                                <input type="text" name="display_photo_little_url" class="p_txt" id="display_photo_little_url" value="">
                            </li>
                            <li>
                                <h5>专题描述</h5>
                                <input type="text" name="topic_message" class="p_txt" id="topic_message" value="">
                            </li>
                            <li class="last">
                                <input name="act" type="hidden" value="act_edit_profile">
                                <!--保存基本信息按钮-->
                                <input type="button" class="subm" name="" id="add_topic_button" value="添    加">
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	include "footer.php"
?>

<!--我的收藏 start-->
<style>
    .modal-content {
        border-radius: 0px;
    }

    .modal-line {
        margin: 0 auto;
        width: 44px;
        background-color: #FC4349;
        height: 3px;
        display: block;
    }

    .modal-title {
        margin-top: 30px;
        margin-left: 0px;
        line-height: 60px;
        font-size: 24px;
        color: #FC4349;
    }

    .modal-ul li {
        margin-bottom: 15px;
        height: 42px;
    }

    .band-phone-code {
        width: 216px !important;
        height: 40px;
        border: 1px solid #e3e3e3;
        background-color: #fff;
        padding-left: 10px;
    }

    .get-code:hover {
        border: 1px solid #FC4349;
    }

    .collection-url {
        width: 308px;
        height: 40px;
        border: 1px solid #e3e3e3;
        background-color: #fff;
        padding-left: 10px;
    }

    .get-code {
        width: 88px;
        height: 42px;
        display: inline;
        text-align: center;
        padding: 0;
        background-color: #fff;
        font-size: 13px;
        color: #1a1a1a;
        text-indent: 0;
        cursor: pointer;
    }

    .copy-collection-commit {
        width: 320px;
        height: 45px;
        font-size: 15px;
        background-color: #1a1a1a;
        display: inline-block;
        line-height: 45px;
        text-align: center;
        color: #fff;
    }

    .copy-collection-commit:hover {
        background-color: #FC4349;
    }
</style>


<div class="modal band-phone d_none" id="copy-collection-modal">
    <div class="modal-dialog" style="width: 400px" role="document">
        <div class="modal-content" style="width: 400px;height: 300px;text-align: center;">
            <div style="margin-top: 30px" class="modal-body" style="text-align: center;">
                <form id="copy-collection-form">
                    <ul class="modal-ul" style="text-align: center">
                        <li><input type="text" name="collection-url" class="txt collection-url" id="collection-url"
                                   value="" placeholder="请粘贴分享收藏夹的链接"></li>
                    </ul>
                </form>
                <div style="width: 308px;margin-top: 40px;margin-left: 40px;">
                    <a class="copy-collection-commit" href="javascript:void(0)">导入</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="./js/jquery.nicescroll.js"></script>

<script type="text/javascript">
    window.onscroll = function () {
        getSearchIds();
        showItems();
    }
    var show_array = []; // 显示的所有pids
    var send_status = 1; // 发送状态 默认允许发

    function getSearchIds() {

        var items = $(".imgList").find(".imgItem");
        var len = items.length;
        var start = 0;

        for (var i = start; i < len; i++) {
            var elem = items[i];
            if ($(elem).offset().top <= $(window).height() + $(window).scrollTop() && $(elem).offset().top + $(elem).outerHeight() > $(window).scrollTop()) {

                var img = $(elem).find("img");
                var pid = $(img).parent().attr("data-id");
                var is_has = show_array.indexOf(pid);
                if (is_has < 0) {
                    show_array.push(pid);
                }
                start = i;
                send_status = 0;
            }
            else {
                if ($(elem).offset().top > $(window).height() + $(window).scrollTop()) {
                    send_status = 1;
                    break;
                }
            }
        }
        // 解决只有一排数据不发送的问题
        if (len <= 5 && len > 0) {
            send_status = 1;
        }
    }

    function showItems() {

        var items = $(".imgList").find(".imgItem");
        var len = items.length;
        var start = 0;
        for (var i = start; i < len; i++) {
            var elem = items[i];
            if ($(elem).offset().top < $(window).height() + $(window).scrollTop() && $(elem).offset().top + $(elem).outerHeight() > $(window).scrollTop()) {

                var img = $(elem).find("img");
                if (!$(img).attr("src")) {
                    $(img).attr("src", $(img).attr("data-original")).fadeIn();
                    start = i;
                }
            }
            else {
                if ($(elem).offset().top > $(window).height() + $(window).scrollTop()) {
                    break;
                }
            }
        }

    }

    function setPiclistSize() {
        $(".imgList").Huiphoto({
            wraperWidth: "1130",
            item: ".imgItem",
            margin: 50,
            extra: 0
        });
    }

    $(function () {
        setPiclistSize();
        showItems();
        $(window).resize(function () {
            setPiclistSize();
        });
        $("#copy-collection").live("click", function () {
            layer.open({
                title: '导入收藏夹',
                type: 1,
                area: ['400px', '250px'], //宽高
                content: $('#copy-collection-modal'),
                yes: function (index) {
                    layer.close(index);
                },
                success: function () {

                }
            });
        });
        $('.copy-collection-commit').on('click', function (e) {
            var formData = new FormData($('#copy-collection-form')[0]);
            $.ajax({
                url: 'copy_collection.php',
                type: 'post',
                data: formData,
                async: true,
                cache: false,
                timeout: 30000,
                contentType: false,
                processData: false,
                success: function (returndata) {
                    var data = jQuery.parseJSON(returndata);
                    switch (parseInt(data["code"])) {
                        case -4:
                            dialog('您已收藏该收藏夹', 1);
                            break;
                        case -3:
                            dialog('并无此收藏夹', 2);
                            break;
                        case -2:
                            dialog('缺少参数', 2);
                            break;
                        case 1:
                            layer.closeAll();
                            dialog('复制成功', 1);
                            location.reload();
                            break;
                        default:
                            layer.closeAll();
                            dialog('系统错误', 1);
                    }
                },
                error: function () {
                    layer.closeAll();
                    dialog('系统错误', 1);
                }
            })
        });
        $('#to-discount').on('click', function (e) {
            window.location.href = '/user.php?act=discount_list';
        })
    });
</script>
<!--我的收藏 end-->
<script>
    $(function () {
        $('#to-discount').on('click', function (e) {
            window.location.href = '/user.php?act=discount_list';
        });

        function hide_all() {
            //主页隐藏
            $(".user_home").hide();
            //我的订单隐藏
            $(".user_order").hide();
            //我的下载隐藏
            $(".user_manage1").hide();
            //上传记录隐藏
            $(".user_upload").hide();
            //我的收藏隐藏
            $(".user_collection").hide();
            //我的足迹隐藏
            $(".user_footprint").hide();
            //账号管理隐藏
            $(".user_manage2").hide();
            //添加专题隐藏
            $(".add_topic2").hide();
        }

        //设置点击切换
        $("#down_load_button").click(function () {
            hide_all();
            $(".user_home").hide();
            $(".user_manage1").show();
            $(".c1").removeClass("c1");
            $("#down_load_button").addClass("c1");
        });
        $("#collection_manage_button").click(function () {
            hide_all();
            $(".user_home").hide();
            $(".c1").removeClass("c1");
            $(".user_collection").show();
            $("#collection_manage_button").addClass("c1");
        });
        $("#my_histroy_button").click(function () {
            hide_all();
            $(".user_home").hide();
            $(".c1").removeClass("c1");
            $(".user_footprint").show();
            $("#my_histroy_button").addClass("c1");
        });
        $("#my_manage_button").click(function () {
            hide_all();
            $(".user_home").hide();
            $(".c1").removeClass("c1");
            $(".user_manage2").show();
            $("#my_manage_button").addClass("c1");
        })
        $("#up_load_button").click(function () {
            hide_all();
            $(".user_home").hide();
            $(".c1").removeClass("c1");
            $(".user_upload").show();
            $("#up_load_button").addClass("c1");
        })
        $("#my_main").click(function () {
            hide_all();
            $(".c1").removeClass("c1");
            $(".user_home").show();
            $("#my_main").addClass("c1");
        });
        $("#add_topic").click(function(){
            hide_all();
            $(".c1").removeClass("c1");
            $(".add_topic2").show();
            $("#add_topic").addClass("c1");
        });
    });
</script>
<!--echarts-->
<script type="text/javascript">
    var dom = document.getElementById("container");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;

    setTimeout(function () {

        option = {
            legend: {},
            tooltip: {
                trigger: 'axis',
                showContent: false
            },
            dataset: {
                source: [
                    ['product','1月','2月', '3月', '4月', '5月', '6月'],
                    ['上传'
                    <?php foreach ($data_show[0] as $temp) {
                        echo ",".$temp;
                    } 
                    ?>
                     ],
                    ['下载'
                    <?php foreach ($data_show[1] as $temp) {
                        echo ",".$temp;
                    } 
                    ?>
                    ],
                    ['浏览' 
                    <?php foreach ($data_show[2] as $temp) {
                        echo ",".$temp;
                    } 
                    ?>
                    ]
                ]
            },
            xAxis: {type: 'category'},
            yAxis: {gridIndex: 0},
            grid: {top: '55%'},
            series: [
                {type: 'line', smooth: true, seriesLayoutBy: 'row'},
                {type: 'line', smooth: true, seriesLayoutBy: 'row'},
                {type: 'line', smooth: true, seriesLayoutBy: 'row'},
                {
                    type: 'pie',
                    id: 'pie',
                    radius: '30%',
                    center: ['50%', '25%'],
                    label: {
                        formatter: '{b}: {@1月} ({d}%)'
                    },
                    encode: {
                        itemName: 'product',
                        value: '1月',
                        tooltip: '1月'
                    }
                }
            ]
        };

        myChart.on('updateAxisPointer', function (event) {
            var xAxisInfo = event.axesInfo[0];
            if (xAxisInfo) {
                var dimension = xAxisInfo.value + 1;
                myChart.setOption({
                    series: {
                        id: 'pie',
                        label: {
                            formatter: '{b}: {@[' + dimension + ']} ({d}%)'
                        },
                        encode: {
                            value: dimension,
                            tooltip: dimension
                        }
                    }
                });
            }
        });

        myChart.setOption(option);

    });;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }
</script>
<!--ajax传输，修改用户基本信息-->
<script type="text/javascript">
    $("#save_inform_button").click(function(){
        var user_id=<?php echo '"'.$user_id.'"';?>;
        var user_phone_number=document.getElementById("user_phone_number").value;
        var user_little_name=document.getElementById("user_little_name").value;
        var user_real_name=document.getElementById("user_real_name").value;
        var user_company=document.getElementById("user_company").value;
        var user_qq=document.getElementById("user_qq").value;
        var user_email=document.getElementById("user_email").value;
        $.ajax({
            url:"./receive_user_information.php",
            type:"post",
            timeout: 3000,
            data:{"user_id":user_id,"user_phone_number":user_phone_number,"user_little_name":user_little_name,"user_real_name":user_real_name,"user_company":user_company,"user_qq":user_qq,"user_email":user_email},
            dataType:"json",
            success: function(result){
                console.log(result);
                
            },
            error: function(xhr,state,errorThrown){
                console.log(xhr);
            }
        });
    });
    //保存密码
    $("#save_password_button").click(function(){
        var user_id=<?php echo '"'.$user_id.'"';?>;
        var user_old_password=document.getElementById("now_password").value;//旧密码
        var user_old_password2=document.getElementById("old_password").value;//旧密码
        var user_new_password1=document.getElementById("new_password1").value;//新密码1
        var user_new_password2=document.getElementById("new_password2").value;//新密码1
        if(user_old_password!=user_old_password2){
            alert("当前密码错误");
        }else if(user_new_password1==user_new_password2&&(user_new_password1!="")){
            $.ajax({
                url:"./change_password.php",
                type:"post",
                timeout: 3000,
                data:{"user_id":user_id,"user_password":user_new_password1},
                dataType:"json",
                success: function(result){
                    console.log(result);
                    
                },
                error: function(xhr,state,errorThrown){
                    console.log(xhr);
                }
            })
        }else{
            alert("新两次密码错误，请再次输入");
        }
    });
    $("#add_topic_button").click(function(){
        var topic_name=document.getElementById("topic_name").value;//专题名称
        var display_photo_url=document.getElementById("display_photo_url").value;//专题展示图片
        var display_photo_little_url=document.getElementById("display_photo_little_url").value;//专题小图片地址
        var topic_message=document.getElementById("topic_message").value;
        var data1={"topic_name":topic_name,"display_photo_url":display_photo_url,"display_photo_little_url":display_photo_little_url,"topic_message":topic_message};
        console.log(data1);
        if(topic_name!=""&&display_photo_url!=""&&display_photo_url!=""&&topic_message!=""){
            $.ajax({
                url:"./add_topic.php",
                type:"post",
                timeout: 3000,
                data:{"topic_name":topic_name,"display_photo_url":display_photo_url,"display_photo_little_url":display_photo_little_url,"topic_message":topic_message},
                dataType:"json",
                success: function(result){
                    console.log(result);
                    
                },
                error: function(xhr,state,errorThrown){
                    console.log("error xhr"+xhr);
                    console.log("error state"+state);
                }
            });
        }else{
            alert("输入不完全，请重新输入");
        }
    });
</script>