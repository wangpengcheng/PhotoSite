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
   
    function is_index(){
         $temp=curPageURL()["path"];
        $result=explode('/', $temp);
        //echo $result["path"];//'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $last=count($result);
        //print_r(($result[$last-1]=="test.php"));
        return $result[$last-1];
    };
    function get_photo_title(){
        echo '照片';
    };
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="Generator" content="ECSHOP v3.6.0"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="Keywords" content="网站关键词描述"/>
    <meta name="Description" content="网站描述"/>
    <title><?php
        if(is_index()=="index.php"){
            echo '校园风景';
        }else if (is_index()=="topic.php") {
            echo '专题';
        }else if (is_index()=="hand_photo.php"){
            echo '编辑信息';
        }else if(is_index()=="user.php"){
            echo '用户信息';
        }else if(is_index()=="photo.php"){
            get_photo_title();
        }
        is_index();
    ?></title>
    <?php
        if(is_index()=="hand_photo.php"){
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/front/css/reset.css">';
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/front/css/ion.checkRadio.css">';
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/front/css/header.css">';
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/front/css/common.css">';
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/common/layui/css/layui.css">';
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/front/css/login.css">';
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/front/webuploader/webuploader.css">';
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/front/css/edit-info.css">';
            echo  '<link rel="stylesheet" href="http://www.meisubq.com/static/front/css/easydropdown.css">';
            echo  '<link rel="stylesheet" href="./css/lf_style.css"/>';
            echo  '<script src="./js/common.js"></script>';
            echo  '<link rel="stylesheet" href="./css/style.css">';
            echo  '<link href="./js/skin/WdatePicker.css" rel="stylesheet" type="text/css"><link id="layuicss-layer" rel="stylesheet" href="http://www.meisubq.com/static/common/layui/css/modules/layer/default/layer.css?v=3.1.1" media="all">';
            echo '<script src="//sgoutong.baidu.com/embed/1551246754/asset/embed/pc_nb.js" charset="UTF-8"></script><link rel="stylesheet" type="text/css" href="//sgoutong.baidu.com/embed/1551246754/asset/embed/css/pc/main.css"><script type="text/javascript" src="//p.qiao.baidu.com/cps2/site/poll?cb=jsonp_bridge_1552472494793_5763948735983571&amp;l=1&amp;v=9117938710011960896&amp;s=11960896&amp;e=24453643&amp;dev=0&amp;auth=%7B%22anonym%22%3A0%2C%22key%22%3A%226848769569247111791eapm9732111027%22%2C%22sn%22%3A%22729123861%22%2C%22id%22%3A%229117938710011960896%22%2C%22from%22%3A4%2C%22token%22%3A%22bridge%22%7D&amp;_time=1552472494793" id="id_jsonp_bridge_1552472494793_5763948735983571" charset="utf-8"></script>';
            echo  '<link rel="stylesheet" href="./css/css.css">';
        }else{
            echo  '<link rel="stylesheet" href="./css/slicy.css">';
            echo  '<link rel="stylesheet" href="./css/glide.css">';
            echo  '<link rel="stylesheet" href="./css/easydropdown.css">';
            echo  '<link rel="stylesheet" href="./css/jquery-ui.css"/>';
            echo  '<link rel="stylesheet" href="./css/style.css">';
            echo  '<link rel="stylesheet" href="./css/lf_style.css"/>';
            echo  '<link rel="stylesheet" href="./css/dxm_style.css"/>';
            echo  '<link rel="stylesheet" href="./css/css.css">';
            echo  '<link rel="stylesheet" href="./css/responsive.css">';
            echo  '<link rel="stylesheet" href="./css/drag.css">';
        };
        if(is_index()=="photo.php"){
             echo  '<link href="https://cdn.bootcss.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" type="text/css">';
             echo  '<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">';
             echo  '<link href="./css/zyd.comment.css" rel="stylesheet" type="text/css">';
             echo  '<link href="./css/wangEditor-fullscreen-plugin.css" rel="stylesheet" type="text/css">';
        }else {
             echo '<link rel="stylesheet" href="./css/new_style.css"/>';
        }
    ?>
    
    <script src="./js/common.js"></script>
    <!--css link end-->
    <meta name="viewport" content="width=1366"/>
    <!-- <script async src="./javascript/e8b0ebdc065d83b84c71bde85f9a2ac7.js"></script> -->
    <script charset="utf-8"
            src="http://goutong.baidu.com/site/429/e9fe99c2267a6f7a9215a8724ce995b4/b.js?siteId=11146853"></script>
    <!-- <script type="text/javascript" async="" src="https://www.google-analytics.com/analytics.js"></script> -->
    <script src="https://hm.baidu.com/hm.js?e9fe99c2267a6f7a9215a8724ce995b4"></script>
   <!--  <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-126144440-2"></script> -->
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'UA-126144440-2');
    </script>
    <!--<link rel="shortcut icon" href="./favicon.ico"/>-->
    <link rel="icon" href="./favicon.ico"/>
    <!--<link rel="icon" href="./animated_favicon.gif" type="image/gif"/>-->
    <link rel="stylesheet" href="./css/temp_activity_2019_01_22.css"/>
    <style>
        .more-topic-btn a {
            display: inline-block;
            height: 40px;
            line-height: 40px;
            padding: 0 20px;
            margin: 0 10px;
            font-size: 14px;
            color: #999;
            border: 1px solid #999;
            border-radius: 20px;
        }

        .more-topic-btn {
            position: absolute;
            right: 20%;
            top: 180%;
        }

        .more-topic-btn a:hover {
            border-color: #fc4349;
            color: #fc4349;
        }

        #free-pictures-login {
            cursor: pointer;
        }
    </style>
    <script type="text/javascript">
        var glide_autoplay = 3000;
    </script>
    <link rel="stylesheet" href="http://meisupic.com/themes/meisu2017/js/skin/default/layer.css?v=3.0.3303"
          id="layuicss-skinlayercss">
    <link href="http://meisupic.com/themes/meisu2017/js/skin/WdatePicker.css" rel="stylesheet" type="text/css">
    <!--  <script src="http://sgoutong.baidu.com/embed/1547804898/asset/embed/pc_nb.js" charset="UTF-8"></script> -->
    <link rel="stylesheet" type="text/css" href="//sgoutong.baidu.com/embed/1547804898/asset/embed/css/pc/main.css">
    <script type="text/javascript" src="//p.qiao.baidu.com/cps2/site/poll?cb=jsonp_bridge_1552203048744_9791668731255698&l=1&v=9117938710011146853&s=11146853&e=24453643&dev=0&auth=%7B%22anonym%22%3A0%2C%22key%22%3A%225534984912114627294swqy9670438334%22%2C%22sn%22%3A%22729409890%22%2C%22id%22%3A%229117938710011146853%22%2C%22from%22%3A4%2C%22token%22%3A%22bridge%22%7D&_time=1552203048744" id="id_jsonp_bridge_1552203008485_7427988791504829" charset="utf-8"></script>

</head>
<body id="all_toper" class="bg_fff" style="height: 100%">
<div class="loader" style="z-index: 198910151;display: none">
</div>
<div class="header <?php if(is_index()!="index.php"){echo 'header_black';} ?>">
    <div class="wrapper">
        <!--LOGO-->
        <div class="logo" style="<?php if(is_index()=="hand_photo.php"){echo 'margin-top: 0px; margin-right: 0px;';}?>">
            <a href=""><img class="logo-normal" src="<?php if(is_index()=="index.php"){echo './htmlimg/logo.png';}else{echo './htmlimg/logo1.png';}?>"/></a>
        </div>
        <!--头部左侧-->
        <div class="copyr">
            <a href="./index.html">首页</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="./topic.html">精选专辑</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="./hand_photo.html">上传图片</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <!--<a href="./zhuanti.html">上传图片</a>-->
            <a href="./researcher_relsult.html"><font color="#FC4349">校园风景</font><i class="huodong_top_hot"></i></a>
            <!-- <a href="">最新活动</a> -->&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
        <font id="ECS_MEMBERZONE">
            <div id="append_parent"></div>
            <div class="nav_bf">
                <dl>
                    <!-- <dt><a href="">套餐价格</a></dt> -->
                    <dd><a href="" id="login">登录</a></dd>
                    <dd><span>|</span></dd>
                    <dd><a href="" id="register">注册</a></dd>
                </dl>

            </div>
            <div class="nav_af" style="display: none">
                <ul>
                     <li class="le le4 <?php if(is_index()=="index.php"){echo 'le5';}else{ /*echo 'selected'*/;} ?> ">
                        <a href="./user_page.html?user_id=" class="mail">1811...</a>
                        <span class="arr"></span>
                        <div class="hdn">
                            <dl>
                                <dd><a href="./user_page.html?user_id=&act=down_list">下载记录</a></dd>
                                <dd><a href="./user_page.html?user_id=&act=collection_list">收藏夹</a></dd>
                                <dd><a href="./user_page.html?user_id=&act=history_list">我的足迹</a></dd>
                                <dd><a href="./user_page.html?user_id=&act=profile">账户管理</a></dd>
                                <dd><a id="logout_button" class="last">退出</a></dd>
                            </dl>
                        </div>
                    </li>
                </ul>
            </div>
        </font>
    </div>
</div>
<div class="toper" style="<?php if(is_index()=="index.php"){echo 'display: none';} ?> ">
    <div class="wrapper">
        <h2 style="margin-top: 0px;">探索我们的世界！</h2>
        <div class="form">
            <form action="searchi.php" method="get" id="myform">
                <input class="s_clearall" type="hidden" value="" name="offset" id="s_offset">
                <input class="s_clearall" type="hidden" value="" name="sort" id="s_sort">
                <input class="s_clearall" type="hidden" value="" name="phototype" id="s_phototype">
                <input class="s_clearall" type="hidden" value="" name="orientation" id="s_orientation">

                <input class="s_clearall" type="hidden" value="" name="people_only" id="s_people_only">
                <input class="s_clearall" type="hidden" value="" name="race" id="s_race">
                <input class="s_clearall" type="hidden" value="" name="age" id="s_age">
                <input class="s_clearall" type="hidden" value="" name="gender" id="s_gender">
                <input class="s_clearall" type="hidden" value="" name="quantity" id="s_quantity">

                <input class="s_clearall" type="hidden" value="" name="color" id="s_color">

                <input class="s_clearall" type="hidden" value="" name="categories" id="s_categories">
                <input class="s_clearall" type="hidden" value="" name="username" id="s_username">
                <input class="s_clearall" type="hidden" value="" name="exclude_keyword" id="s_exclude_keyword">
                <div class="type">
                    <!--<h4>全部图片</h4>-->
                    <div class="bt">
                        <i class="n1"></i>
                        <i class="n2"></i>
                    </div>
                    <div class="dropdown"><span class="old"><select class="" onchange="changeSearch('phototypesearch',this.options[this.options.selectedIndex].value)" id="EasyDropDownF7E7D1">
                        <option value="" class="label">全部图片</option>
                        <option value="" class="label">全部图片</option>
                        <option value="photo">照片</option>
                        <option value="vector">矢量图</option>
                    </select></span><span class="selected">全部图片</span><span class="carat"></span><div><ul><li>全部图片</li><li>照片</li><li>矢量图</li></ul></div></div>
                </div>
                <div class="input">
                    <input type="text" class="txt" placeholder="输入关键词" name="keyword" id="keyword" value="" autocomplete="off">
                    <input onclick="submitForm()" class="btn" value="" type="submit">
                </div>
                <div id="srch_img" class="srch_img"></div>
            </form>
        </div>
    </div>
</div>