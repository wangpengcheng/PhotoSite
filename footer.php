<div class="h_foot" style="display: none;">
    <div class="wrapper">
        <div class="txt">
            还没找到想要的图片？来探索我们的世界吧！
        </div>
        <div class="form">
            <form id="footform" action="http://meisupic.com/searchi.php" method="get">
                <input type="text" class="txt1" name="keyword" id="" value="" placeholder="搜索照片、矢量图和插画，支持双语哦"
                       autocomplete="off"/>
                <input type="submit" class="btn" value=""/>
            </form>
        </div>
    </div>
</div>
<div class="footer">
    <div class="wrapper">
        <div class="logo">
            <a href=""><img src="./htmlimg/f_logo.png"/></a>
            <h4><a href=""></a></h4>
        </div>
        <div class="nav">
            <dl>
                <dd><a href="http://www.xtu.edu.cn/">关于我们</a></dd>
                <!--<dd><a href="">价格体系</a></dd>-->
                <dd><a href="http://www.xtu.edu.cn/xysh/">联系我们</a></dd>
            </dl>
            <dl>
                <dd><a href="">版权说明</a></dd>
                <!--<dd><a href="">服务条款</a></dd>-->
                <dd><a href="http://www.xtu.edu.cn/xxgk/">常见问题</a></dd>
            </dl>
        </div>
        <div class="qrimg">
            <div class="img">
                <img src="./htmlimg/er.jpg"/>
            </div>
            <div class="txt">
                <div class="qq">
                    <a href="http://fuwu.xtu.edu.cn/web/index.jsp" target="_blank">联系方式</a>
                </div>
                <h4>电话：0086-731-58293938<br/>
                    Email: lxsb@xtu.edu.cn</h4>
            </div>
        </div>
    </div>
    <div class="copyright">
        <span></span>
        版权所有 © 湘潭大学. 地址：中国湖南湘潭
    </div>
</div>
<div id="srchimg_wrap" style="display: none;">
    <div class="srchimg_wrap">
        <form id="ECS_SEARCHBYIMG" name="ECS_SEARCHBYIMG" action="searchi.php" method="post"
              enctype="multipart/form-data">
            <div class="head">
                <ul>
                    <li class="selected">
                        <input name="searchtype" checked="checked" value="1" id="searchtype_1" type="radio"
                               autocomplete="off"><label for="searchtype_1"><i></i></label>按链接地址　
                    </li>
                    <li>
                        <input name="searchtype" value="2" id="searchtype_2" type="radio" autocomplete="off"><label
                            for="searchtype_2"><i></i></label>上传图片　
                    </li>
                </ul>
            </div>
            <div class="body">
                <input type="text" name="image_url" id="" class="txt" value="" placeholder="黏贴图片URL"/>
                <input type="submit" name="" id="" class="btn" value="搜索" onclick="dialog('搜索结果加载中...',2);"/>
            </div>

            <div class="body" style="display: none;">
                <div class="upload">
                    <div class="ico">

                    </div>
                    <h4>选择搜索图片</h4>
                    <input type="file" name="searchimg" class="file" id="searchimg" value=""
                           onchange="this.form.submit();dialog('搜索结果加载中...',2);"/>
                </div>
            </div>
        </form>
    </div>
</div>
<!--登录页面-->
<div id="login_wrap" class="d_none">
    <div class="login_wrap">
        <em></em>
        <div class="head">
            <h2>登录</h2>
            <span class="ui_line red"></span>
        </div>
        <form id="ECS_LOGINFORM" name="ECS_LOGINFORM" method="post">
            <div class="login_form">
                <input type="text" name="login_username" id="login_username" placeholder="用户名/手机号"/>
                <input type="password" name="login_password" id="login_password" placeholder="登录密码"/>
                <div class="rem">
                    <input name="checkbox" type="checkbox" value="" id="login_remember" name="login_remember">
                    <label for="login_remember"></label>
                    <span class='lt'>记住密码</span>　
                    <span class='rg' style="display: none;"><a href="">忘记密码？</a></span>
                </div>
            </div>
            <div class="mt200 btn" style="display:block">
                <a  id="login_button">登录</a>
            </div>
        </form>
        <p>还没有账号？<a class="zhuce">马上注册</a></p>

    </div>
</div>
<div id="login_wrap_bf" class="d_none">
    <div class="login_wrap">
        <em></em>
        <div class="head">
            <h2>请登录后再进行收藏或购买</h2>
            <span class="ui_line red"></span>
        </div>

        <div class="login_form">
            <input type="text" placeholder="手机号/用户名"/>
            <input type="password" placeholder="登录密码"/>
            <div class="rem">
                <input name="checkbox" type="checkbox" value="" id="check5">
                <label for="check5"></label>


                <span class='lt'>记住密码</span>　
                <span class='rg'><a href="">忘记密码？</a></span>　　　
            </div>
        </div>
        <div class="mt200 btn">
            <a href="">登录</a>
        </div>

        <p>还没有账号？<a href="" class="zhuce">马上注册</a></p>

    </div>
</div>
<!--注册-->
<div id="register_wrap" class="d_none">
    <div class="login_wrap register_wrap">
        <em></em>
        <div class="head">
            <h2>注册</h2>
            <span class="ui_line red"></span>
        </div>

        <div class="mt40 body">
            <ul>
                <li><input type="text" name="reg_mobile_drag" class="txt" id="reg_mobile_drag" value=""
                           placeholder="手机号" autocomplete="off"/></li>
                <li class="d_none">
                    <input type="button" name="" class="btn btn1" id="" value=""/>
                    <input type="text" name="" class="txt txt1" value="" placeholder="按住滑块，拖动到最右边"/>
                </li>
                <li>
                    <div id="drag"></div>
                </li>
            </ul>
        </div>

        <div class="mt40 btn d_none" id="div_regs">
            <a href="" id="regs">立即注册</a>
        </div>

        <p>已有账号？<a href="" class="denglu">马上登录</a></p>

    </div>
</div>
<!--注册页面-->
<div id="reg_wrap" class="d_none">
    <div class="login_wrap register_wrap02">
        <em></em>
        <div class="head">
            <h2>欢迎来到湘潭</h2>
            <span class="ui_line red"></span>
        </div>
        <form id="ECS_REGFORM" name="ECS_REGFORM" method="post">
            <input id="agreement" name="agreement" value="1" type="checkbox" hidden="">
            <div class="mt40 body">
                <ul>
                    <li><input type="text" name="extend_field102" class="txt" id="extend_field102" value=""
                               placeholder="用户名（必填）" maxlength="20"/></li>
                    <li><input type="password" name="password" class="txt" id="password" value="" placeholder="密码"
                               maxlength="20"/></li>
                    <li><input type="password" name="confirm_password" class="txt" id="confirm_password" value=""
                               placeholder="确认密码" maxlength="20"/></li>
                    <li><input type="text" name="extend_field5" class="txt" id="extend_field5" value=""
                               placeholder="请输入手机号" maxlength="11"/></li>
                    <li>
                        <!--邀请码-->
                        <input type="text" name="sms_code" class="txt" id="sms_code" value="" placeholder="邀请码/非必填" maxlength="11">
                    </li>
                </ul>
            </div>
        </form>
        <div class="label">
            <input id="checkbox1" name="checkbox" value="" type="checkbox" checked>
            <label for="checkbox1"></label>
            我已阅读并同意<a style="color: #FC4349" target="_blank" href="">《服务条款》</a>
        </div>

        <div class="mt40 btn">
            <a id="register_button">提交</a>
        </div>
    </div>
</div>
<div id="xj_wap" class="d_none">
    <div class="xj_wap">
        <input type="text" class="ui_input" name="collect_add_title" id="collect_add_title" value=""
               placeholder="收藏夹名称"/>
    </div>
</div>
<div id="share_wap" class="d_none">
    <div class="share_wrap">
        <ul>
            <li class="n1">
                <a href="">
                    <div class="ico">

                    </div>
                    <h4>链接分享</h4>
                </a>
            </li>
            <li class="n2">
                <a href="" target="_blank">
                    <div class="ico">

                    </div>
                    <h4>发给QQ好友</h4>
                </a>
            </li>
        </ul>
        <div class="foot">
            <h3>下面是本收藏夹的地址</h3>
            <input type="text" class="ui_input" name="" id="" value="http://www.meisupic.com/collects.php?sid="/>
        </div>
    </div>
</div>
<div id="cmm_wrp" class="d_none">
    <div class="cmm_wap">
        <input type="text" class="ui_input cmm_value" name="" id="" value="" placeholder="新的收藏夹名称"/>
    </div>
</div>
<div id="del_authorized" class="d_none">
    <div class="del_wap">
        <h4 class="del_txt">确定要删除用户授权码吗？</h4>
    </div>
</div>
<div id="del_wap" class="d_none">
    <div class="del_wap">
        <h4 class="del_txt">确定要删除收藏夹吗？</h4>
    </div>
</div>
<div id="down_example_wap" class="d_none">
    <div class="del_wap">
        <h4 class="del_txt" id="down_example_wap_coutent"></h4>
    </div>
</div>
<div id="del_goods_wap" class="d_none">
    <div class="del_wap">
        <h4 class="del_txt">确定要删除选择的素材吗？</h4>
    </div>
</div>
<div id="del_cart_good" class="d_none">
    <div class="del_wap">
        <h4 class="del_txt">确定要删除素材吗？</h4>
    </div>
</div>
<div id="del_cart_goods" class="d_none">
    <div class="del_wap">
        <h4 class="del_txt">确定要删除所选素材吗？</h4>
    </div>
</div>
<div id="transfer_wap" class="d_none">
    <div class="transfer_wap">
        <ul class="transfer" style="height: 200px; overflow: auto;">
        </ul>
    </div>
</div>
<div id="transf_wap" class="d_none">
    <div class="transfer_wap">
        <ul class="transfer">
            <li class="c1"><a href="">文艺小清新</a></li>
            <li class="last"><a href="">商务建筑大楼俯视图</a></li>
        </ul>
        <input type="text" class="ui_input" name="" id="" value="" placeholder="新建收藏夹"/>
    </div>
</div>
<div id="cancel_wap" class="d_none">
    <div class="del_wap">
        <h4 class="del_txt">是否取消下载图片？</h4>
    </div>
</div>
<div class="layui-evpi d_none" id="BandPhoneModal">
    <div class="tip">为了您的账户安全，并给您带来更好的使用体验，请完善个人信息</div>
    <div class="form">
        <form id="band-phone">
            <ul>
                <li>
                    <div class="item-l"><span class="c-red">*</span>手机号</div>
                    <!--<div class="item-r">
                        <input class="text" type="text" name="" value="" />
                    </div>-->
                    <div class="item-r">
                        <div class="code-wrap">
                            <input class="text text-phone" id="j_evpi_phone" type="text" name="phone" value=""/>
                            <button class="btn_code get-code" id="j_getevpiCode" type="button">获取验证码</button>
                        </div>
                        <input class="text text-code" type="text" name="sms_code" value="" placeholder="输入验证码"/>
                    </div>
                </li>
                <li>
                    <div class="item-l"><span class="c-red">*</span>姓名</div>
                    <div class="item-r">
                        <input class="text" type="text" name="real_name" value=""/>
                    </div>
                </li>
                <li>
                    <div class="item-l">公司名称</div>
                    <div class="item-r">
                        <input class="text" type="text" name="company_name" value=""/>
                    </div>
                </li>
                <li>
                    <div class="item-l"><span class="c-red">*</span>行业</div>
                    <div class="item-r">
                        <select id="industry_name">
                            <option value="">选择行业</option>
                            <option value="广告策划">广告策划</option>
                            <option value="出版印刷">出版印刷</option>
                            <option value="新媒体">新媒体</option>
                            <option value="互联网">互联网</option>
                            <option value="电商">电商</option>
                            <option value="医药">医药</option>
                            <option value="整形美容">整形美容</option>
                            <option value="金融">金融</option>
                            <option value="房地产">房地产</option>
                            <option value="快消品">快消品</option>
                            <option value="教育">教育</option>
                            <option value="汽车">汽车</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                </li>
            </ul>
        </form>
    </div>
</div>
<div class="layui-evpi d_none" id="MoreInfoModal">
    <div class="tip">为了您的账户安全，并给您带来更好的使用体验，请完善个人信息</div>
    <div class="form">
        <form id="more-info">
            <ul>
                <li>
                    <div class="item-l">手机号</div>
                    <div class="item-r">
                        <input class="text" id="user-has-band-phone-num" type="text" name="phone" value="" readonly/>
                    </div>
                </li>
                <li>
                    <div class="item-l"><span class="c-red">*</span>姓名</div>
                    <div class="item-r">
                        <input class="text" type="text" name="real_name" value=""/>
                    </div>
                </li>
                <li>
                    <div class="item-l">公司名称</div>
                    <div class="item-r">
                        <input class="text" type="text" name="company_name" value=""/>
                    </div>
                </li>
                <li>
                    <div class="item-l"><span class="c-red">*</span>行业</div>
                    <div class="item-r">
                        <select id="more_info_industry_name">
                            <option value="">选择行业</option>
                            <option value="广告策划">广告策划</option>
                            <option value="出版印刷">出版印刷</option>
                            <option value="新媒体">新媒体</option>
                            <option value="互联网">互联网</option>
                            <option value="电商">电商</option>
                            <option value="医药">医药</option>
                            <option value="整形美容">整形美容</option>
                            <option value="金融">金融</option>
                            <option value="房地产">房地产</option>
                            <option value="快消品">快消品</option>
                            <option value="教育">教育</option>
                            <option value="汽车">汽车</option>
                            <option value="其他">其他</option>
                        </select>
                    </div>
                </li>
            </ul>
        </form>
    </div>
</div>
<div id="imgupload_wap" class="d_none">
    <div class="imgupload_wap">
        <h4>恭喜您，您上传的文件已成功提交审核。</h4>
        <h4>通过审核后将以系统消息的形式通知您，请您随时关注个人中心的系统消息，耐心等待！</h4>
    </div>
</div>

<div id="cancelorder_wap" class="d_none">
    <div class="del_wap">
        <h4 class="del_txt">是否要取消此订单？</h4>
    </div>
</div>
<div id="picture_wap" class="d_none">
    <div class="picture_wap">
        <div class="items">
            <h4>标题</h4>
            <p>标题用一句话准确描述的图片或者文件画面呈现出的主要内容，不要使用标点符号</p>
            <p>标题包含画面的主要元素、动作、特征更利于搜索</p>
        </div>
        <div class="items">
            <h4>标签</h4>
            <p>When，时间，图片中明确表明的时间，以及节日，早晨、夜晚，端午、圣诞等等</p>
            <p>Where，地点，从大到小的顺序编写，如亚洲，中国，北京，天安门</p>
            <p>What，事物，画面中主要的具体物体，材质，数量和排列组合方式</p>
            <p>Who，人物，人物的年龄，儿童、青年、老人，身份，如白领，教师，医生</p>
            <p>How，如何，画面的动作，情绪，表达的概念、意图</p>
            <p>Why，何因，图片如何创作，光线，拍摄角度，特别突出的颜色，表现方式</p>
        </div>

        <div class="items">
            <h4>注意事项</h4>
            <p>同一场景不同角度的摆拍如静物类摄影，允许标签标签局部复制，其他内容明显有</p>
            <p>区别的图片，标题标签全部复制将无法通过审核</p>
            <p>不要为增加图片曝光填写与画面内容无关的标签，错误的关键词无法通过审核</p>
        </div>

        <div class="items">
            <h4>举例</h4>
            <p>标题：年轻游客和他的狗在坐在通往山中的小路上看日出</p>
            <img src="./htmlimg/img106.jpg"/>
        </div>
    </div>
    <div class="picture_foot">
        <a href="" class="ui_btn">明白了，马上去编辑</a>
    </div>
</div>
<!--侧边栏-->
<div class="sidebar">
    <ul>
        <!--     <a href="">
                  <li class='n0'></li>
                  <div class="qr">
                      <img src="./htmlimg/img136.jpg"/>
                      <p>扫码加客服微信<br>    发现更多惊喜</p>
                  </div>
                </a>
            <a href="">
              <li class='n1'></li>
            </a>
            <a href="">
              <li class='n2'></li>
            </a>
            <a href="" target="_blank">
              <li class='n3' title="""></li>
            </a> -->
        <a>
            <li class='n4'></li>
        </a>
    </ul>
</div>
<div id="authorization" class="d_none">
    <div class="transfer_wap_n">
        <input type="text" class="ui_input" name="authorized_name" id="authorized_name" value=""
               placeholder="被授权用户的公司全称" maxlength="50" autocomplete="off"/>
    </div>
</div>
<div id="transfer_wap_n" class="d_none">
    <div class="transfer_wap_n">
        <div style="margin: 0 auto;text-align: center;">
            <input type="text" class="ui_input" name="" id="collect_add_title_yd" maxlength="20" value=""
                   placeholder="新建收藏夹" autocomplete="off"/>
        </div>
    </div>
</div>
<div id="profile_avatar" style="display: none;">
    <div class="profile_avatar_wrap">
        <form id="ECS_PROFILE_AVATAR" name="ECS_PROFILE_AVATAR" action="./receive_user_head_photo.php" method="post"
              enctype="multipart/form-data">
            <div class="body" style="">
                <div class="upload">
                    <div class="ico">
                    </div>
                    <h4>选择图片</h4>
                    <input type="hidden" name="upload_avatar" value="1"/>
                    <input type="hidden" name="user_id" value=<?php echo $user_id;?>>
                    <input type="file" name="avatar" class="file" id="" value="" onchange="this.form.submit();"/>
                </div>
            </div>
        </form>
    </div>
</div>
<div id="attorney" class="d_none">
    <div class="attorney">
        <select class="dropdown">
            <option value="" class="label"></option>
            <option value="北京意优创意科技有限公司" class="label">北京意优创意科技有限公司</option>
            <option value="北京广胜科技有限公司">北京广胜科技有限公司</option>
            <option value="北京海伦科技有限公司">北京海伦科技有限公司</option>
        </select>
        <h4>新增用户自动保存</h4>
    </div>
</div>
<input type="hidden" id="hidden_reg_mobile_drag" value="">
</body>
<?php
if(is_index()=="hand_photo.php"){ 
echo '<script src="http://libs.baidu.com/jquery/1.8.3/jquery.min.js"></script>';
echo '<script type="text/javascript" src="http://www.meisubq.com/static/common/layui/layui.js"></script>';
echo '<script type="text/javascript" src="http://www.meisubq.com/static/front/js/lib/jquery.SuperSlide.2.1.12.js"></script>';
echo '<script type="text/javascript" src="http://www.meisubq.com/static/front/js/lib/jquery.validate.min.js"></script>';
echo '<script type="text/javascript" src="http://www.meisubq.com/static/front/js/lib/jquery.serializeJSON.js"></script>';
echo '<script type="text/javascript" src="http://www.meisubq.com/static/front/js/lib/ion.checkRadio.js"></script>';
echo '<script type="text/javascript" src="./js/util.js"></script>';
echo '<script type="text/javascript" src="./js/js.js"></script>';
echo '<script type="text/javascript" src="./js/config.js"></script>';
echo '<script type="text/javascript">';
echo '    layui.use("common");';
echo '</script>';

echo '<!--<script type="text/javascript" src="./js/config.js"></script>-->';
echo '<script type="text/javascript" src="http://www.meisubq.com/static/front/js/lib/jquery.easydropdown.min.js"></script>';
echo '<script type="text/javascript" src="http://www.meisubq.com/static/front/js/jsAddress.js"></script>';
echo '<script type="text/javascript" src="./javascript/webuploader.js"></script>';
echo '<script type="text/javascript" src="./js/WdatePicker.js"></script>';
echo '<script type="text/javascript">';
echo '    layui.use("worksedit");';
echo '</script>';
echo '<script type="text/html" id="img-block">';
echo '    <li class="image">';
echo '        <div class="opus">';
echo '            <div class="opus-img">';
echo '                <img src="http://www.meisubq.com/static/front/imgs/backImage.png" style="display: none"/>';
echo '                <div class="tips-panel" style="display: none">像素不符合要求</div>';
echo '            <div class="layui-progress" style="margin-top: 2px">';
echo '                <div class="layui-progress-bar layui-bg-red" lay-percent="0%"></div>';
echo '            </div>';
echo '            <h4 class="hide"><span class="img-title"></span><a href="#"></a></h4>';
echo '        </div>';
echo '    </li>';
echo '</script>';
//echo '<script type="text/javascript" src="./javascript/jquery-1.7.2.js"></script>';
echo '<script type="text/javascript" src="./jst/jquery.json.js"></script>';
echo '<script type="text/javascript" src="./js/jquery.glide.js"></script>';
echo '<script type="text/javascript" src="./js/jquery.cookie.js"></script>';
echo '<script type="text/javascript" src="./js/layer.js"></script>';
echo '<script type="text/javascript" src="./js/jquery.easydropdown.min.js"></script>';
//echo '<script type="text/javascript" src="./javascript/jquery.poshytip.js"></script>';
echo '<script type="text/javascript" src="./js/jquery.row-grid-display.js"></script>';
echo '<script type="text/javascript" src="./js/template.js"></script>';
echo '<script type="text/javascript" src="./js/XCheck.js"></script>';
echo '<script type="text/javascript" src="./js/script.js"></script>';
echo '<script type="text/javascript" src="./js/dialog.js"></script>';
echo '<script type="text/javascript" src="./js/gy.js"></script>';
echo '<script src="./js/drag.js" type="text/javascript"></script>';
echo '<script src="./js/getVerifyCode.js" type="text/javascript"></script>';
echo '<script src="./js/photo.js" type="text/javascript"></script>';
echo '<script id="_trs_ta_js" src="./javascript/ta.js" async="async" defer="defer"></script>';
echo '<script src="./js/jquery.ui.widget.js"></script>';
echo '<script src="./js/jquery.iframe-transport.js"></script>';
echo '<script type="text/javascript" src="./js/aspect.js"></script>';
echo '<script type="text/javascript" src="./js/keyWord.js"></script>';
echo '<script type="text/javascript" src="./js/my_function.js"></script>';

}else if(is_index()=="photo.php"){
    echo '<script type="text/javascript" src="./js/jquery-1.7.2.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.json.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.cookie.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.glide.js"></script>';
    echo '<script type="text/javascript" src="./js/layer.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.easydropdown.min.js"></script>';
    echo '<script type="text/javascript" src="./js/WdatePicker.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.poshytip.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.row-grid-display.js"></script>';
    echo '<script type="text/javascript" src="./js/template.js"></script>';
    echo '<script type="text/javascript" src="./js/XCheck.js"></script>';
    echo '<script type="text/javascript" src="./js/script.js"></script>';
    echo '<script type="text/javascript" src="./js/dialog.js"></script>';
    echo '<script type="text/javascript" src="./js/gy.js"></script>';
    echo '<script type="text/javascript" src="./js/drag.js"></script>';
    echo '<script src="./js/getVerifyCode.js" type="text/javascript"></script>';
    echo '<script src="./js/photo.js" type="text/javascript"></script>';
    echo '<script id="_trs_ta_js" src="//ta.trs.cn/c/js/ta.js?mpid=1245" async="async" defer="defer"></script>';
    echo '<script src="./js/wangEditor.min.js" type="text/javascript"></script>';
    echo '<script src="https://cdn.bootcss.com/bootstrap/2.3.0/js/bootstrap.min.js" type="text/javascript"></script>';
    echo '<script src="./js/xss.js" type="text/javascript"></script>';
    echo '<script src="./js/wangEditor-fullscreen-plugin.js" type="text/javascript"></script>';
    echo '<script src="./js/zyd.comment.js" type="text/javascript"></script>';
    echo '<script type="text/javascript" src="./js/comment.js"></script>';
    echo '<script type="text/javascript" src="./js/my_function.js"></script>';
}else{
    echo '<script type="text/javascript" src="./js/jquery-1.7.2.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.json.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.glide.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.cookie.js"></script>';
    echo '<script type="text/javascript" src="./js/layer.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.easydropdown.min.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.poshytip.js"></script>';
    echo '<script type="text/javascript" src="./js/jquery.row-grid-display.js"></script>';
    echo '<script type="text/javascript" src="./js/template.js"></script>';
    echo '<script type="text/javascript" src="./js/XCheck.js"></script>';
    echo '<script type="text/javascript" src="./js/script.js"></script>';
    echo '<script type="text/javascript" src="./js/dialog.js"></script>';
    echo '<script type="text/javascript" src="./js/gy.js"></script>';
    echo '<script src="./js/drag.js" type="text/javascript"></script>';
    echo '<script src="./js/getVerifyCode.js" type="text/javascript"></script>';
    echo '<script src="./js/photo.js" type="text/javascript"></script>';
    echo '<script type="text/javascript" src="./js/my_function.js"></script>';
    echo '<script id="_trs_ta_js" src="./javascript/ta.js" async="async" defer="defer"></script>';
    echo '<script src="./js/jquery.ui.widget.js"></script>';
    echo '<script src="./js/jquery.iframe-transport.js"></script>';
    echo '<script src="./js/jquery.fileupload.js"></script>';
    echo '<script type="text/javascript" src="./js/aspect.js"></script>';
    echo '<script type="text/javascript" src="./js/keyWord.js"></script>';
};
if(is_index()=="topic.php"){
    echo '<script type="text/javascript" src="./js/topic_load.js"></script>';
}
?>
</html>