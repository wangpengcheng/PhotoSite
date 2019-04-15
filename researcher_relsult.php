<?php
    include 'ps_header.php';
?>
<?php
    include 'ps_connect.php';
    $photos=[];//图片查询结果
    //获得关键词
	$key_word=get_key_word($page_query);
	
	//更新照片id
	if($key_word!="empty"){
		//设置查询语句
		//SELECT * FROM ps_targets WHERE target_name like '%美女%' GROUP BY photo_id;
		$keyword_sql_query="SELECT  photo_id FROM ps_targets WHERE target_name like "."'%".$key_word."%' GROUP BY photo_id;";
		print_r($keyword_sql_query."\n");
		//执行查询语句
		$key_word_result=$conn->query($keyword_sql_query);
		if(mysqli_num_rows($key_word_result)!==0){
			$key_words_result=$key_word_result->fetch_all(MYSQLI_ASSOC);
			//sprint_r($key_words_result);
			foreach ($key_words_result as $temp) {
				# code...
				# //获取图片地址，宽度和高度
				$photo_query_sql=  "SELECT photo_address,photo_width,photo_height FROM ps_photos "." WHERE photo_id = '".$temp['photo_id']."'";
				//print_r($photo_query_sql."\n");
				$photo_result=$conn->query($photo_query_sql);
				if(mysqli_num_rows($photo_result)){
					//获取图片信息
					$photo_array = $photo_result->fetch_all(MYSQLI_ASSOC);
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
        <h2><?php echo $key_word;?></h2><span style='font-size: 14px;line-height: 103px;padding-left: 7px;'>共 1766 个搜索结果</span>
        <div class="form">
            <form action="searchi.php" method="get" id="myform">
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
                    <div class="bt">
                        <i class="n1"></i>
                        <i class="n2"></i>
                    </div>
                    <select class="dropdown"
                            onchange="changeSearch('phototypesearch',this.options[this.options.selectedIndex].value)">
                        <option value="" class="label">全部图片</option>
                        <option value="" class="label">全部图片</option>
                        <option value="photo">照片</option>
                        <option value="vector">矢量图</option>
                    </select>
                </div>
                <div class="input">
                    <input type="text" class="txt" placeholder="输入关键词" name="keyword" id="keyword" value=<?php echo "\"".$key_word."\"";?>
                           autocomplete="off"/>
                    <input class="btn" value="" onclick="submitForm()" type="submit"/>
                </div>
                <div id="srch_img" class="srch_img"></div>
            </form>
            <!-- <div id="srch_img" class="srch_img"> </div> -->
        </div>
    </div>
</div>


<div class="srch_head">
    <div class="srch_head_l  srch_head_l1">
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
    <div class="srch_head_l srch_head_l2">
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
    <div class="srch_head_r">
        <label>共18页</label>
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
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="11382349" title="">
                            <dd class="sp1" title="添加至购物车"></dd>
                            <dd class="sp1_1" title="已经添加"></dd>
                            <dd class="sp2" title="添加至收藏夹"></dd>
                            <dd class='sp2_1' title="取消收藏"></dd>
                            <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic9.depositphotos.com%2F1658611%2F1138%2Fi%2F380%2Fdepositphotos_11382349-stock-photo-university-campus.jpg&id=11382349&userid=1658611&imgfile=thumbs"/></a>
                </li>
                class="imgItem maskWraper item" data-width="450" data-height="301">
                <div class="cover ui_cover">
                    <dl sn="82174080" title="">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                    </dl>
                </div>
                <a href="" target="_blank"><img class="lazyload"
                                                data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1708346%2F8217%2Fi%2F380%2Fdepositphotos_82174080-stock-photo-modern-college-campus-buildings.jpg&id=82174080&userid=1708346&imgfile=thumbs"/></a>
                </li> class="imgItem maskWraper item" data-width="450" data-height="298">
                <div class="cover ui_cover">
                    <dl sn="11345209" title=""
                    ">
                    <dd class="sp1" title="添加至购物车"></dd>
                    <dd class="sp1_1" title="已经添加"></dd>
                    <dd class="sp2" title="添加至收藏夹"></dd>
                    <dd class='sp2_1' title="取消收藏"></dd>
                    <dd class='sp3' title="查看相似图片"></dd>
                    </dl>
                </div>
                <a href="" target="_blank"><img class="lazyload"
                                                data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic9.depositphotos.com%2F1658611%2F1134%2Fi%2F380%2Fdepositphotos_11345209-stock-photo-educational-building-on-campus.jpg&id=11345209&userid=1658611&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="450">
                    <div class="cover ui_cover">
                        <dl sn="85239978" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F5389310%2F8523%2Fv%2F380%2Fdepositphotos_85239978-stock-illustration-graduated-concept.jpg&id=85239978&userid=5389310&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="22164023" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1400069%2F2216%2Fi%2F380%2Fdepositphotos_22164023-stock-photo-bench-in-the-autumn-park.jpg&id=22164023&userid=1400069&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="72542817" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1658611%2F7254%2Fi%2F380%2Fdepositphotos_72542817-stock-photo-building-on-campus.jpg&id=72542817&userid=1658611&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="298">
                    <div class="cover ui_cover">
                        <dl sn="26082271" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1171396%2F2608%2Fi%2F380%2Fdepositphotos_26082271-stock-photo-park-bench-highlighted-by-late.jpg&id=26082271&userid=1171396&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="337">
                    <div class="cover ui_cover">
                        <dl sn="63760635" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1010801%2F6376%2Fi%2F380%2Fdepositphotos_63760635-stock-photo-birds-eye-view-of-historic.jpg&id=63760635&userid=1010801&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="318">
                    <div class="cover ui_cover">
                        <dl sn="137710704" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F2885805%2F13771%2Fv%2F380%2Fdepositphotos_137710704-stock-illustration-university-complex-building-isometric-view.jpg&id=137710704&userid=2885805&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="76384745" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1372933%2F7638%2Fi%2F380%2Fdepositphotos_76384745-stock-photo-interior-of-private-ivy-league.jpg&id=76384745&userid=1372933&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="82174090" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1708346%2F8217%2Fi%2F380%2Fdepositphotos_82174090-stock-photo-modern-college-campus-buildings.jpg&id=82174090&userid=1708346&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="82174082" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1708346%2F8217%2Fi%2F380%2Fdepositphotos_82174082-stock-photo-modern-college-campus-buildings.jpg&id=82174082&userid=1708346&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="11850159" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic9.depositphotos.com%2F1390894%2F1185%2Fi%2F380%2Fdepositphotos_11850159-stock-photo-cornell-university-ivy-league-uris.jpg&id=11850159&userid=1390894&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="301">
                    <div class="cover ui_cover">
                        <dl sn="43613743" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1767404%2F4361%2Fi%2F380%2Fdepositphotos_43613743-stock-photo-modern-educationaloffice-building-on-campus.jpg&id=43613743&userid=1767404&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="454">
                    <div class="cover ui_cover">
                        <dl sn="92010012" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1526816%2F9201%2Fv%2F380%2Fdepositphotos_92010012-stock-illustration-children-leaving-school-after-classes.jpg&id=92010012&userid=1526816&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="325">
                    <div class="cover ui_cover">
                        <dl sn="85867532" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1763191%2F8586%2Fv%2F380%2Fdepositphotos_85867532-stock-illustration-children-at-the-park-in.jpg&id=85867532&userid=1763191&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="299">
                    <div class="cover ui_cover">
                        <dl sn="91113990" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1000833%2F9111%2Fi%2F380%2Fdepositphotos_91113990-stock-photo-oxford-university-uk.jpg&id=91113990&userid=1000833&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="338">
                    <div class="cover ui_cover">
                        <dl sn="96729086" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3352229%2F9672%2Fi%2F380%2Fdepositphotos_96729086-stock-photo-trinity-hall-cambridge-university-on.jpg&id=96729086&userid=3352229&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="298">
                    <div class="cover ui_cover">
                        <dl sn="12105253" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic9.depositphotos.com%2F1027852%2F1210%2Fi%2F380%2Fdepositphotos_12105253-stock-photo-university-quadrangle.jpg&id=12105253&userid=1027852&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="311">
                    <div class="cover ui_cover">
                        <dl sn="82174050" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1708346%2F8217%2Fi%2F380%2Fdepositphotos_82174050-stock-photo-modern-college-campus-buildings.jpg&id=82174050&userid=1708346&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="298">
                    <div class="cover ui_cover">
                        <dl sn="78471866" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1723045%2F7847%2Fi%2F380%2Fdepositphotos_78471866-stock-photo-view-of-the-city-centre.jpg&id=78471866&userid=1723045&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="306">
                    <div class="cover ui_cover">
                        <dl sn="66153330" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F4489556%2F6615%2Fi%2F380%2Fdepositphotos_66153330-stock-photo-college-campus-housing.jpg&id=66153330&userid=4489556&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="94460634" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1262731%2F9446%2Fi%2F380%2Fdepositphotos_94460634-stock-photo-columbia-university-campus-in-new.jpg&id=94460634&userid=1262731&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="450">
                    <div class="cover ui_cover">
                        <dl sn="85239884" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F5389310%2F8523%2Fv%2F380%2Fdepositphotos_85239884-stock-illustration-school-concept.jpg&id=85239884&userid=5389310&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="32122995" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1003386%2F3212%2Fi%2F380%2Fdepositphotos_32122995-stock-photo-oxford-england.jpg&id=32122995&userid=1003386&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="307">
                    <div class="cover ui_cover">
                        <dl sn="85327010" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1763191%2F8532%2Fv%2F380%2Fdepositphotos_85327010-stock-illustration-children-using-computer-in-the.jpg&id=85327010&userid=1763191&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="153">
                    <div class="cover ui_cover">
                        <dl sn="47812891" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F3284155%2F4781%2Fi%2F380%2Fdepositphotos_47812891-stock-photo-station-in-novosibirsk.jpg&id=47812891&userid=3284155&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="315">
                    <div class="cover ui_cover">
                        <dl sn="90142918" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3899029%2F9014%2Fv%2F380%2Fdepositphotos_90142918-stock-illustration-school-and-education-building.jpg&id=90142918&userid=3899029&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="637">
                    <div class="cover ui_cover">
                        <dl sn="29866321" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1526816%2F2986%2Fv%2F380%2Fdepositphotos_29866321-stock-illustration-a-female-biker-standing-in.jpg&id=29866321&userid=1526816&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="258">
                    <div class="cover ui_cover">
                        <dl sn="101621882" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1763191%2F10162%2Fv%2F380%2Fdepositphotos_101621882-stock-illustration-children-playing-tug-of-war.jpg&id=101621882&userid=1763191&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="502">
                    <div class="cover ui_cover">
                        <dl sn="136132362" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F1526816%2F13613%2Fv%2F380%2Fdepositphotos_136132362-stock-illustration-school-building-with-no-students.jpg&id=136132362&userid=1526816&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="305">
                    <div class="cover ui_cover">
                        <dl sn="90373982" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F5671960%2F9037%2Fi%2F380%2Fdepositphotos_90373982-stock-photo-modern-office-park-with-green.jpg&id=90373982&userid=5671960&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="650">
                    <div class="cover ui_cover">
                        <dl sn="78472232" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1723045%2F7847%2Fi%2F380%2Fdepositphotos_78472232-stock-photo-view-of-new-college-and.jpg&id=78472232&userid=1723045&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="17649961" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1165406%2F1764%2Fi%2F380%2Fdepositphotos_17649961-stock-photo-landscape-of-tsinghua-university-campus.jpg&id=17649961&userid=1165406&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="95078016" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1035350%2F9507%2Fi%2F380%2Fdepositphotos_95078016-stock-photo-university-campus-in-spring.jpg&id=95078016&userid=1035350&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="56315425" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1385248%2F5631%2Fi%2F380%2Fdepositphotos_56315425-stock-photo-oxford.jpg&id=56315425&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="344">
                    <div class="cover ui_cover">
                        <dl sn="47109123" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F3284155%2F4710%2Fi%2F380%2Fdepositphotos_47109123-stock-photo-new-university.jpg&id=47109123&userid=3284155&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="76384763" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1372933%2F7638%2Fi%2F380%2Fdepositphotos_76384763-stock-photo-private-ivy-league-cornell-university.jpg&id=76384763&userid=1372933&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="450">
                    <div class="cover ui_cover">
                        <dl sn="90142316" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3899029%2F9014%2Fv%2F380%2Fdepositphotos_90142316-stock-illustration-building-school-and-education.jpg&id=90142316&userid=3899029&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="166650644" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F1035350%2F16665%2Fi%2F380%2Fdepositphotos_166650644-stock-photo-athens-georgia-usa.jpg&id=166650644&userid=1035350&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="330">
                    <div class="cover ui_cover">
                        <dl sn="85327370" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1763191%2F8532%2Fv%2F380%2Fdepositphotos_85327370-stock-illustration-international-children-at-school.jpg&id=85327370&userid=1763191&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="283">
                    <div class="cover ui_cover">
                        <dl sn="76720363" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1723045%2F7672%2Fi%2F380%2Fdepositphotos_76720363-stock-photo-kelvingrove-museum-and-glasgow-university.jpg&id=76720363&userid=1723045&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="315">
                    <div class="cover ui_cover">
                        <dl sn="90142326" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3899029%2F9014%2Fv%2F380%2Fdepositphotos_90142326-stock-illustration-building-school-and-education.jpg&id=90142326&userid=3899029&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="56315459" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1385248%2F5631%2Fi%2F380%2Fdepositphotos_56315459-stock-photo-oxford.jpg&id=56315459&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="164129302" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F1385248%2F16412%2Fi%2F380%2Fdepositphotos_164129302-stock-photo-oxford-university-with-beautiful-tree.jpg&id=164129302&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="124071246" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1000970%2F12407%2Fi%2F380%2Fdepositphotos_124071246-stock-photo-cornell-university-in-ithaca.jpg&id=124071246&userid=1000970&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="35517935" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1048171%2F3551%2Fi%2F380%2Fdepositphotos_35517935-stock-photo-stadium-in-a-university-campus.jpg&id=35517935&userid=1048171&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="35518263" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1048171%2F3551%2Fi%2F380%2Fdepositphotos_35518263-stock-photo-tsinghua-university-campus-architecture-and.jpg&id=35518263&userid=1048171&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="325">
                    <div class="cover ui_cover">
                        <dl sn="135577032" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F1177973%2F13557%2Fi%2F380%2Fdepositphotos_135577032-stock-photo-modern-school-building.jpg&id=135577032&userid=1177973&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="299">
                    <div class="cover ui_cover">
                        <dl sn="72542825" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1658611%2F7254%2Fi%2F380%2Fdepositphotos_72542825-stock-photo-building-on-campus.jpg&id=72542825&userid=1658611&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="280">
                    <div class="cover ui_cover">
                        <dl sn="78272168" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1751039%2F7827%2Fi%2F380%2Fdepositphotos_78272168-stock-photo-government-building-capital-lake-olympia.jpg&id=78272168&userid=1751039&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="123156562" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1000970%2F12315%2Fi%2F380%2Fdepositphotos_123156562-stock-photo-cornell-university-in-ithaca.jpg&id=123156562&userid=1000970&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="338">
                    <div class="cover ui_cover">
                        <dl sn="38039745" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1010801%2F3803%2Fi%2F380%2Fdepositphotos_38039745-stock-photo-birds-eye-view-of-courtyard.jpg&id=38039745&userid=1010801&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="84219688" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1029440%2F8421%2Fi%2F380%2Fdepositphotos_84219688-stock-photo-stack-of-book-and-open.jpg&id=84219688&userid=1029440&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="675">
                    <div class="cover ui_cover">
                        <dl sn="35518201" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1048171%2F3551%2Fi%2F380%2Fdepositphotos_35518201-stock-photo-ginkgo-tree-in-the-fall.jpg&id=35518201&userid=1048171&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="166">
                    <div class="cover ui_cover">
                        <dl sn="50139717" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F3284155%2F5013%2Fi%2F380%2Fdepositphotos_50139717-stock-photo-academgorodok.jpg&id=50139717&userid=3284155&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="266">
                    <div class="cover ui_cover">
                        <dl sn="66011355" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1723045%2F6601%2Fi%2F380%2Fdepositphotos_66011355-stock-photo-uni-bastions-the-oldest-building.jpg&id=66011355&userid=1723045&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="306">
                    <div class="cover ui_cover">
                        <dl sn="155932894" title=""
                        "Skolkovo" ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F2620725%2F15593%2Fi%2F380%2Fdepositphotos_155932894-stock-photo-modern-energy-efficient-flat-roof.jpg&id=155932894&userid=2620725&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="299">
                    <div class="cover ui_cover">
                        <dl sn="27579461" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F2443439%2F2757%2Fi%2F380%2Fdepositphotos_27579461-stock-photo-golden-tree-garden-beside-lake.jpg&id=27579461&userid=2443439&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="76384797" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1372933%2F7638%2Fi%2F380%2Fdepositphotos_76384797-stock-photo-private-ivy-league-cornell-university.jpg&id=76384797&userid=1372933&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="675">
                    <div class="cover ui_cover">
                        <dl sn="165012624" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F1385248%2F16501%2Fi%2F380%2Fdepositphotos_165012624-stock-photo-the-oxford-university-city.jpg&id=165012624&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="7420047" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic7.depositphotos.com%2F1037473%2F742%2Fi%2F380%2Fdepositphotos_7420047-stock-photo-modern-architecture.jpg&id=7420047&userid=1037473&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="675">
                    <div class="cover ui_cover">
                        <dl sn="69204393" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3396639%2F6920%2Fi%2F380%2Fdepositphotos_69204393-stock-photo-girl-sitting-on-the-campus.jpg&id=69204393&userid=3396639&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="301">
                    <div class="cover ui_cover">
                        <dl sn="141878812" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F10082172%2F14187%2Fi%2F380%2Fdepositphotos_141878812-stock-photo-library-of-national-taiwan-university.jpg&id=141878812&userid=10082172&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="338">
                    <div class="cover ui_cover">
                        <dl sn="1868552" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic3.depositphotos.com%2F1004813%2F186%2Fi%2F380%2Fdepositphotos_1868552-stock-photo-soccer-field.jpg&id=1868552&userid=1004813&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="79340500" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1029440%2F7934%2Fi%2F380%2Fdepositphotos_79340500-stock-photo-stack-of-book-and-open.jpg&id=79340500&userid=1029440&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="65862133" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1385248%2F6586%2Fi%2F380%2Fdepositphotos_65862133-stock-photo-the-oxford-university-city.jpg&id=65862133&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="79340742" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1029440%2F7934%2Fi%2F380%2Fdepositphotos_79340742-stock-photo-stack-of-book-and-open.jpg&id=79340742&userid=1029440&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="450">
                    <div class="cover ui_cover">
                        <dl sn="58103363" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3060179%2F5810%2Fv%2F380%2Fdepositphotos_58103363-stock-illustration-road-elements-isometric-road-font.jpg&id=58103363&userid=3060179&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="301">
                    <div class="cover ui_cover">
                        <dl sn="80434756" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F2769299%2F8043%2Fi%2F380%2Fdepositphotos_80434756-stock-photo-cow-near-tents-in-campus.jpg&id=80434756&userid=2769299&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="8569253" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic8.depositphotos.com%2F1385248%2F856%2Fi%2F380%2Fdepositphotos_8569253-stock-photo-green-trees-under-blue-sky.jpg&id=8569253&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="163918452" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F1372933%2F16391%2Fi%2F380%2Fdepositphotos_163918452-stock-photo-michigan-state-university-spartan-stadium.jpg&id=163918452&userid=1372933&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="164661530" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F1385248%2F16466%2Fi%2F380%2Fdepositphotos_164661530-stock-photo-asian-man-smiling-happily.jpg&id=164661530&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="338">
                    <div class="cover ui_cover">
                        <dl sn="38039755" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1010801%2F3803%2Fi%2F380%2Fdepositphotos_38039755-stock-photo-birds-eye-view-of-courtyard.jpg&id=38039755&userid=1010801&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="298">
                    <div class="cover ui_cover">
                        <dl sn="33103583" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1875497%2F3310%2Fi%2F380%2Fdepositphotos_33103583-stock-photo-bench-metal.jpg&id=33103583&userid=1875497&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="163918516" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst3.depositphotos.com%2F1372933%2F16391%2Fi%2F380%2Fdepositphotos_163918516-stock-photo-michigan-state-university-campus.jpg&id=163918516&userid=1372933&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="599">
                    <div class="cover ui_cover">
                        <dl sn="112898986" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1000336%2F11289%2Fi%2F380%2Fdepositphotos_112898986-stock-photo-bench-in-autumn-park.jpg&id=112898986&userid=1000336&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="80131314" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3800275%2F8013%2Fi%2F380%2Fdepositphotos_80131314-stock-photo-opened-hardback-book-diary-on.jpg&id=80131314&userid=3800275&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="282">
                    <div class="cover ui_cover">
                        <dl sn="78471384" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1723045%2F7847%2Fi%2F380%2Fdepositphotos_78471384-stock-photo-view-of-the-city-centre.jpg&id=78471384&userid=1723045&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="41046923" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1454412%2F4104%2Fi%2F380%2Fdepositphotos_41046923-stock-photo-aerial-view-of-boulder-colorado.jpg&id=41046923&userid=1454412&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="118970804" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F2079965%2F11897%2Fi%2F380%2Fdepositphotos_118970804-stock-photo-old-wooden-bench.jpg&id=118970804&userid=2079965&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="675">
                    <div class="cover ui_cover">
                        <dl sn="124068096" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1000970%2F12406%2Fi%2F380%2Fdepositphotos_124068096-stock-photo-cornell-university-in-ithaca.jpg&id=124068096&userid=1000970&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="65862087" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1385248%2F6586%2Fi%2F380%2Fdepositphotos_65862087-stock-photo-the-oxford-university-city.jpg&id=65862087&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="30263699" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F2298621%2F3026%2Fi%2F380%2Fdepositphotos_30263699-stock-photo-bishan-county-north-elementary-school.jpg&id=30263699&userid=2298621&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="56315455" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1385248%2F5631%2Fi%2F380%2Fdepositphotos_56315455-stock-photo-oxford.jpg&id=56315455&userid=1385248&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="338">
                    <div class="cover ui_cover">
                        <dl sn="1868317" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api4.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic3.depositphotos.com%2F1004813%2F186%2Fi%2F380%2Fdepositphotos_1868317-stock-photo-soccer-field.jpg&id=1868317&userid=1004813&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="7553082" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic7.depositphotos.com%2F1265483%2F755%2Fi%2F380%2Fdepositphotos_7553082-stock-photo-solar-array.jpg&id=7553082&userid=1265483&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="80131388" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3800275%2F8013%2Fi%2F380%2Fdepositphotos_80131388-stock-photo-back-to-school-opened-hardback.jpg&id=80131388&userid=3800275&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="294">
                    <div class="cover ui_cover">
                        <dl sn="47109117" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F3284155%2F4710%2Fi%2F380%2Fdepositphotos_47109117-stock-photo-academgorodok.jpg&id=47109117&userid=3284155&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="80131458" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3800275%2F8013%2Fi%2F380%2Fdepositphotos_80131458-stock-photo-back-to-school-opened-hardback.jpg&id=80131458&userid=3800275&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="338">
                    <div class="cover ui_cover">
                        <dl sn="1868312" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic3.depositphotos.com%2F1004813%2F186%2Fi%2F380%2Fdepositphotos_1868312-stock-photo-soccer-field.jpg&id=1868312&userid=1004813&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="35703983" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst.depositphotos.com%2F1193075%2F3570%2Fi%2F380%2Fdepositphotos_35703983-stock-photo-red-running-track-lanes.jpg&id=35703983&userid=1193075&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="80131578" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3800275%2F8013%2Fi%2F380%2Fdepositphotos_80131578-stock-photo-back-to-school-opened-hardback.jpg&id=80131578&userid=3800275&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="299">
                    <div class="cover ui_cover">
                        <dl sn="4732169" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic5.depositphotos.com%2F1016267%2F473%2Fi%2F380%2Fdepositphotos_4732169-stock-photo-the-girl-with-books-sitting.jpg&id=4732169&userid=1016267&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="675">
                    <div class="cover ui_cover">
                        <dl sn="64459277" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api2.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3396639%2F6445%2Fi%2F380%2Fdepositphotos_64459277-stock-photo-college-student-sitting-on-the.jpg&id=64459277&userid=3396639&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="284">
                    <div class="cover ui_cover">
                        <dl sn="1325216" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api3.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fstatic3.depositphotos.com%2F1000824%2F132%2Fi%2F380%2Fdepositphotos_1325216-stock-photo-diverse-young-college-or-university.jpg&id=1325216&userid=1000824&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="80131346" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3800275%2F8013%2Fi%2F380%2Fdepositphotos_80131346-stock-photo-opened-hardback-book-diary-on.jpg&id=80131346&userid=3800275&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="80131462" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F3800275%2F8013%2Fi%2F380%2Fdepositphotos_80131462-stock-photo-back-to-school-opened-hardback.jpg&id=80131462&userid=3800275&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="84219658" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api5.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1029440%2F8421%2Fi%2F380%2Fdepositphotos_84219658-stock-photo-stack-of-book-and-open.jpg&id=84219658&userid=1029440&imgfile=thumbs"/></a>
                </li>
                <li class="imgItem maskWraper item" data-width="450" data-height="300">
                    <div class="cover ui_cover">
                        <dl sn="95784726" title=""
                        ">
                        <dd class="sp1" title="添加至购物车"></dd>
                        <dd class="sp1_1" title="已经添加"></dd>
                        <dd class="sp2" title="添加至收藏夹"></dd>
                        <dd class='sp2_1' title="取消收藏"></dd>
                        <dd class='sp3' title="查看相似图片"></dd>
                        </dl>
                    </div>
                    <a href="" target="_blank"><img class="lazyload"
                                                    data-original="http://api1.meisupic.com/getImg.php?imgurl=https%3A%2F%2Fst2.depositphotos.com%2F1029440%2F9578%2Fi%2F380%2Fdepositphotos_95784726-stock-photo-stack-of-books-and-open.jpg&id=95784726&userid=1029440&imgfile=thumbs"/></a>
                </li>


            </ul>
        </div>
        <div class="next_pages">
            <a href="" class="ui_btn">下一页</a></div>
    </div>
    <div class="srch_head_r">
        <label>共18页</label>
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