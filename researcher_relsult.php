<?php
    include 'ps_header.php';
?>
<?php
    include 'ps_connect.php';
    $reseach_photo_array=[];
    //获得关键词
	$key_word=get_key_word($page_query);
	$usr_id=get_user_id($page_query);
	//更新照片id
	if($key_word!="empty"){
		//设置查询语句
		//SELECT * FROM ps_targets WHERE target_name like '%美女%' GROUP BY photo_id;
		$keyword_sql_query="SELECT  photo_id FROM ps_targets WHERE target_name like "."'%".$key_word."%' GROUP BY photo_id;";
		//执行查询语句
		$key_word_result=$conn->query($keyword_sql_query);
		if(mysqli_num_rows($key_word_result)!==0){
			$key_words_result=$key_word_result->fetch_all(MYSQLI_ASSOC);
			//sprint_r($key_words_result);
			foreach ($key_words_result as $temp) {
				# code...
				# //获取图片地址，宽度和高度
				$photo_query_sql=  "SELECT photo_address,photo_id FROM ps_photos "." WHERE photo_id = '".$temp['photo_id']."'";
				//print_r($photo_query_sql."\n");
				$photo_result1=$conn->query($photo_query_sql);
				if(mysqli_num_rows($photo_result1)){
					//获取图片信息
					$temp_photo_array = $photo_result1->fetch_array(MYSQLI_ASSOC);
					array_push($reseach_photo_array,$temp_photo_array);
					//print_r($reseach_photo_array);
				}else{
					echo "no image";
				}
			}
		}else{
			echo "no this words";
		}
	}
    //关闭连接
	$conn->close();
	//print_r($photo_array);
	//print_r($author_array);
?>
<!--style start-->
<style type="text/css">
        .imgListInit {
            height: 0;
            overflow: hidden;
        }

        .imgList {
            font-size: 0;
            letter-spacing: -3px;
            line-height: 0;
            margin: 0 auto;
        }

        .imgList .imgItem {
            border: 1px solid #ebebeb;
            box-sizing: border-box;
            display: inline-block;
            overflow: hidden;
            vertical-align: top;
        }

        .imgList .imgItem .icon-down {
            margin-left: 10px;
        }

        .imgList .imgItem a {
            display: inline-block;
            text-decoration: none;
        }

        .imgList .imgItem a img {
            display: inline-block;
            height: auto;
        }

        .imgItem {
            display: inline-block;
            position: relative;
            z-index: 0;
        }

        #nopic {
            display: none;
            font-size: 18px;
            letter-spacing: 0;
            line-height: 30px;
            text-align: center;
        }

        .dci-logo {
            position: absolute;
            left: 9px;
            top: 9px;
            background: url(/themes/meisu2017/imgs/dci.png) no-repeat center;
            width: 26px;
            height: 34px;
        }

        .dci-logo h4 {
            display: none;
            position: absolute;
            top: 0;
            left: 35px;
            padding: 0 8px;
            height: 26px;
            line-height: 26px;
            color: #fff;
            font-size: 10px;
            background-color: rgba(0, 0, 0, .7);
            font-style: normal;
            letter-spacing: 0;
        }

        .dci-logo:hover h4 {
            display: block;
        }

        .dci-logo h4:after {
            content: "";
            position: absolute;
            left: -5px;
            top: 50%;
            margin-top: -5px;
            width: 5px;
            height: 10px;
            background: url(/themes/meisu2017/imgs/sanjiao.png) no-repeat center;
        }


    </style>
<!--style end-->
<div class="toper toper_w">
    <div class="wrapper">
        <h2><?php echo $key_word;?></h2><span style='font-size: 14px;line-height: 103px;padding-left: 7px;'>共 <?php count($reseach_photo_array);?>个搜索结果</span>
        <div class="form">
            <form action="./researcher_relsult.php" method="get" id="myform">
                <input class="s_clearall" type="hidden" value=<?php echo "'".$key_word."'";?> name="s_keyword" id="s_keyword" autocomplete="off">
                <input class="s_clearall" type="hidden" value='1' name="offset" id="s_offset" autocomplete="off">
                <input class="s_clearall" type="hidden" value='4' name="sort" id="s_sort" autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="phototype" id="s_phototype" autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="orientation" id="s_orientation"
                       autocomplete="off">

                <input class="s_clearall" type="hidden" value='' name="people_only" id="s_people_only"
                       autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="race" id="s_race" autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="age" id="s_age" autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="gender" id="s_gender" autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="quantity" id="s_quantity" autocomplete="off">

                <input class="s_clearall" type="hidden" value='' name="color" id="s_color" autocomplete="off">

                <input class="s_clearall" type="hidden" value='' name="categories" id="s_categories" autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="username" id="s_username" autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="exclude_keyword" id="s_exclude_keyword"
                       autocomplete="off">
                <input class="s_clearall" type="hidden" value='' name="image_url" id="image_url" autocomplete="off">
                <div class="type">
                    <!--<h4>全部图片</h4>-->
                    <div class="bt" style="display: none;">
                        <i class="n1"></i>
                        <i class="n2"></i>
                    </div>
                    <select class="dropdown"
                            onchange="changeSearch('phototypesearch',this.options[this.options.selectedIndex].value)">
                        <option value="" class="label">搜索图片</option>
                        <option value="" class="label">搜索图片</option>
                        <option value="photo">照片</option>
                        <option value="vector">矢量图</option>
                    </select>
                </div>
                <div class="input">
                    <input type="text" class="txt" placeholder="输入关键词" name="keyword" id="keyword" value=<?php echo "\"".$key_word."\"";?>
                           autocomplete="off"/>
                    <input class="btn" value="" onclick="submitForm()" type="submit"/>
                </div>
                <div id="srch_img" class="srch_img" style="display: none;"></div>
            </form>
            <!-- <div id="srch_img" class="srch_img"> </div> -->
        </div>
    </div>
</div>


<div class="srch_head">
    <div class="srch_head_l  srch_head_l1" style="display: none;">
        <ul>

            <li class="selected">
                <div class="label">
                    <a href="" sort',4)">热门</a>
                </div>
            </li>
            <li>
                <div class="label">
                    <a href="" sort',5)">最新</a>
                </div>
            </li>
        </ul>
        <div class="f-line">

        </div>
    </div>
    <div class="srch_head_l srch_head_l2" style="display: none;">
        <ul>
            <li>
                <select class="dropdown" id="phototype">
                    <option value="" class="label">全部图片</option>
                    <option value="" class="label">全部图片</option>
                    <option value="photo">照片</option>
                    <option value="vector">矢量图</option>
                </select>
            </li>
            <li class="n2">
                <select class="dropdown" id="orientation">
                    <option value="" class="label">方向</option>
                    <option value="" class="label">不限</option>
                    <option value="horizontal">横向</option>
                    <option value="vertical">纵向</option>
                    <option value="square">正方</option>
                </select>
            </li>
            <li>
                <div class="tit">
                    <span>人物</span>
                    <i></i>
                </div>
                <div class="con con_user" style="display: none;">
                    <div class="con_user_h">
                        <div class="l">

                            <input type="checkbox" name="people_only" id="people_only" value="1"
                                   onchange="javascript:changeSearch('people_only')"/>
                            <label for="people_only"></label>
                            仅看有人物的
                        </div>
                        <div class="r">
                            清除所选
                        </div>
                    </div>
                    <div class="con_user_b">
                        <dl>
                            <dt>种族</dt>
                            <dd><a href="" race','asian')">亚洲人</a></dd>
                            <dd><a href="" race','multi')">白人</a></dd>
                            <dd><a href="" race','black')">黑人</a></dd>
                            <dd><a href="" race','caucasian')">中东人</a></dd>
                            <dd><a href="" race','brazilian')">巴西人</a></dd>
                            <dd><a href="" race','other')">其他</a></dd>
                        </dl>
                        <dl>
                            <dt>年龄</dt>
                            <dd><a href="" age','infant')">婴儿</a></dd>
                            <dd><a href="" age','child')">儿童</a></dd>
                            <dd><a href="" age','teenager')">青少年</a></dd>
                            <dd><a href="" age','70')">老人</a></dd>
                            <dd><a href="" age','20')">20+</a></dd>
                            <dd><a href="" age','30')">30+</a></dd>
                            <dd><a href="" age','40')">40+</a></dd>
                            <dd><a href="" age','50')">50+</a></dd>
                        </dl>
                        <dl>
                            <dt>性别</dt>
                            <dd><a href="" gender','male')">男性</a></dd>
                            <dd><a href="" gender','female')">女性</a></dd>
                        </dl>
                        <dl>
                            <dt>数量</dt>
                            <dd onclick="javascript:changeSearch('quantity','1')"><a href="" quantity','1')">1</a></dd>
                            <dd onclick="javascript:changeSearch('quantity','2')"><a href="" quantity','2')">2</a></dd>
                            <dd onclick="javascript:changeSearch('quantity','3')"><a href="" quantity','3')">3</a></dd>
                            <dd onclick="javascript:changeSearch('quantity','any')"><a href="" quantity','any')">4+</a>
                            </dd>
                        </dl>
                        <div class="btn">
                            <input class="ui_btn" name="" id="" value="提交" onclick="submitForm()"/>
                        </div>
                    </div>
                </div>
            </li>
            <li>
                <div class="tit">
                    <span>色彩</span>
                    <i></i>
                </div>
                <div class="con con_color" style="display: none;">
                    <dl>
                        <dt><img src="./htmlimg/dxm2.png"/></dt>
                        <dd><span style="background-color: #000000;"
                                  onclick="javascript:changeSearch('color','#000000')"></span></dd>
                        <dd><span style="background-color: #ffffff;"
                                  onclick="javascript:changeSearch('color','#ffffff')"></span></dd>
                        <dd><span style="background-color: #7a7a7a;"
                                  onclick="javascript:changeSearch('color','#7a7a7a')"></span></dd>
                        <dd><span style="background-color: #bfbfbf;"
                                  onclick="javascript:changeSearch('color','#bfbfbf')"></span></dd>
                        <dd><span style="background-color: #810081;"
                                  onclick="javascript:changeSearch('color','#810081')"></span></dd>
                        <dd><span style="background-color: #ff01ff;"
                                  onclick="javascript:changeSearch('color','#ff01ff')"></span></dd>
                        <dd><span style="background-color: #653201;"
                                  onclick="javascript:changeSearch('color','#653201')"></span></dd>
                        <dd><span style="background-color: #7e0004;"
                                  onclick="javascript:changeSearch('color','#7e0004')"></span></dd>
                        <dd><span style="background-color: #fe0000;"
                                  onclick="javascript:changeSearch('color','#fe0000')"></span></dd>
                        <dd><span style="background-color: #fecd9b;"
                                  onclick="javascript:changeSearch('color','#fecd9b')"></span></dd>
                        <dd><span style="background-color: #f9be00;"
                                  onclick="javascript:changeSearch('color','#f9be00')"></span></dd>
                        <dd><span style="background-color: #ffff00;"
                                  onclick="javascript:changeSearch('color','#ffff00')"></span></dd>
                        <dd><span style="background-color: #04fe00;"
                                  onclick="javascript:changeSearch('color','#04fe00')"></span></dd>
                        <dd><span style="background-color: #027f00;"
                                  onclick="javascript:changeSearch('color','#027f00')"></span></dd>
                        <dd><span style="background-color: #01ffff;"
                                  onclick="javascript:changeSearch('color','#01ffff')"></span></dd>
                        <dd><span style="background-color: #0005fd;"
                                  onclick="javascript:changeSearch('color','#0005fd')"></span></dd>
                        <dd><span style="background-color: #00007c;"
                                  onclick="javascript:changeSearch('color','#00007c')"></span></dd>

                    </dl>
                </div>
            </li>

            <li>
                <div class="tit tit_more">
                    <span>更多条件</span>
                    <i></i>
                </div>
                <div class="con con_more" style="display: none;">
                    <dl>
                        <dd>
                            <label>类别</label>
                            <select class="dropdown"
                                    onchange="changeSearch('categories',this.options[this.options.selectedIndex].value)">
                                <option value="6">抽象</option>
                                <option value="7">动物</option>
                                <option value="8">房屋建筑</option>
                                <option value="9">艺术品</option>
                                <option value="10">美丽和时尚</option>
                                <option value="11">商业/金融</option>
                                <option value="12">名人</option>
                                <option value="13">城市</option>
                                <option value="14">电脑/电子产品</option>
                                <option value="15">概念/观点</option>
                                <option value="16">装饰</option>
                                <option value="17">教育</option>
                                <option value="18">动物&植物</option>
                                <option value="19">饮食</option>
                                <option value="20">节日/事件</option>
                                <option value="21">插图</option>
                                <option value="22">工业</option>
                                <option value="23">室内装饰</option>
                                <option value="24">首饰/宝石</option>
                                <option value="25">医疗和健康</option>
                                <option value="26">杂项</option>
                                <option value="27">物体</option>
                                <option value="28">其它</option>
                                <option value="29">人物</option>
                                <option value="30">地方</option>
                                <option value="31">宗教</option>
                                <option value="32">科学</option>
                                <option value="33">购物</option>
                                <option value="34">符号及标志</option>
                                <option value="35">运动</option>
                                <option value="36">科技</option>
                                <option value="37">纹理和背景</option>
                                <option value="38">工具</option>
                                <option value="39">运输及车辆</option>
                                <option value="41">复古与怀旧</option>
                                <option value="42">大自然</option>
                                <option value="43">旅游</option>
                                <option value="44">职业</option>
                            </select>
                        </dd>
                        <dd>
                            <label>
                                <div class="wrap">
                                    <em class="em1"></em>
                                    <div class="wrap_txt">
                                        <i class="i1"></i>
                                        <p class="p1">通过输入用户名或昵称，您可以快速找到您关注的供稿人（如果此信息在供稿人的公开档案中）</p>
                                        <p class="p2 mt10">示例说明：</p>
                                        <p class="p2 mt10">输入用户名“Limiesuser”或者昵称“李湘潭”，将会获得供稿人“Limiesuser
                                            /李湘潭”的供稿专辑链接，点击链接可以直接查看该供稿人的所有作品文件
                                        </p>
                                        <ul>
                                            <li>
                                                <div class="hd">
                                                    Limeisuser <span>|</span>
                                                </div>
                                                <div class="bd">
                                                    <div class="img">
                                                        <img src="./htmlimg/img79.jpg"/>
                                                    </div>
                                                    <div class="tx">
                                                        <h4>Limeisuser / 李湘潭</h4>
                                                        <h4>作品 18926</h4>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <h6> 或</h6>
                                            </li>
                                            <li>
                                                <div class="hd">
                                                    Limeisuser <span>|</span>
                                                </div>
                                                <div class="bd">
                                                    <div class="img">
                                                        <img src="./htmlimg/img79.jpg"/>
                                                    </div>
                                                    <div class="tx">
                                                        <h4>Limeisuser / 李湘潭</h4>
                                                        <h4>作品 18926</h4>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                供稿人</label>
                            <input type="text" name="username" id="username" class="txt" value=""
                                   placeholder="请输入供稿人名称"/>
                            <em class="em_img" style="display: none;"></em>

                        </dd>
                        <dd>
                            <label>
                                <div class="wrap">
                                    <em class="em2"></em>
                                    <div class="wrap_txt">
                                        <i class="i2"></i>
                                        <p class="p1">排除关键字可以帮您更精准的定位搜索结果</p>
                                        <p class="p1">使用逗号、分号或空格将多个关键字或者词语分开</p>
                                        <p class="p1 mt10">示例说明：</p>
                                        <p class="p2 mt10">在搜索框内输入“科技”，在排除关键字框内输入“电脑”，
                                            搜索结果中就会出现带有关键字“科技”
                                            但是不带关键字“电脑”的图片或素材
                                        </p>
                                        <p class="p1 mt10">输入样式举例：</p>
                                        <p class="p2 mt10">电脑 书桌 水杯</p>
                                        <p class="p2">电脑 书桌 水杯</p>
                                        <p class="p2">电脑 书桌 水杯</p>
                                    </div>
                                </div>

                                排除关键字</label>
                            <input type="text" name="exclude_keyword" class="txt" id="exclude_keyword" value=""
                                   placeholder="多个关键字可用空格分开"/>
                            <em class="em_img" style="display: none;"></em>


                        </dd>
                    </dl>
                    <div class="btn">
                        <input class="ui_btn" name="" id="" value="提交" onclick="submitForm()"/>
                    </div>
                </div>
            </li>

        </ul>
    </div>
    <div class="srch_head_r" >
        <label>共1页</label>
        <ul>
            <li class="prev"><a href=""></a></li>
            <li><input type="text" class="sr" name="pagenowt" id="pagenowt" value="1"/>
            <li class="next"><a href=""></a></li>
        </ul>
    </div>
</div>

<!--边界线-->
<div class="label_wrap">
    <dl>
    </dl>
</div>
<!--查询结果-->
<div class="search_content">
    <div class="wrapper1">
        <div id="searchCon2" class="imgs ui_imgs">
            <ul class="imgList" id="goods-img-list">
            	<?php
            	foreach ($reseach_photo_array as $photo_temp) {
	                echo '<li class="imgItem maskWraper item" data-width="450" data-height="300">';
	                echo '<div class="cover ui_cover">';
	                echo '        <dl sn="11382349" title="">';
	                echo '            <dd class="sp1" title="添加至购物车"></dd>';
	                echo '            <dd class="sp1_1" title="已经添加"></dd>';
	                echo '            <dd class="sp2" title="添加至收藏夹"></dd>';
	                echo '            <dd class="sp2_1" title="取消收藏"></dd>';
	                echo '            <dd class="sp3" title="查看相似图片"></dd>';
	                echo '        </dl>';
	                echo '    </div>';
	                echo '    <a href="';
	                echo "./photo.php?photo_id=".$photo_temp["photo_id"]."&user_id=".$usr_id;
	                echo '" target="_blank"><img class="lazyload" data-original="';
	                echo $photo_temp["photo_address"]."&user_id=".$usr_id;
	                echo '"/></a>';
	                echo '</li>';
                }
                ?>
            </ul>
        </div>
        <div class="next_pages">
            <a href="" class="ui_btn">下一页</a></div>
    </div>
    <div class="srch_head_r">
        <label>共1页</label>
        <ul>
            <li class="prev"><a href=""></a></li>
            <li><input type="text" class="sr" name="pagenowb" id="pagenowb" value="1"/>
            <li class="next"><a href=""></a></li>
        </ul>
    </div>
</div>
<?php
	include 'footer.php'
?>
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
        $("#goods-img-list").Huiphoto({
            wraperWidth: "auto",
            item: ".imgItem",
            margin: 50,
            extra: 0
        });
    }

    function setTopicPiclistSize() {
        $("#topic-img-list").Huiphoto({
            wraperWidth: "auto",
            item: ".item",
            minHeight: 200,
            margin: 50,
            extra: 0,
        });
    }

    $(function () {
        setPiclistSize();
        setTopicPiclistSize();
        showItems();
        $(window).resize(function () {
            setPiclistSize();
            setTopicPiclistSize();
        });
    });
</script>