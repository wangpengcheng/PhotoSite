<?php
    include 'ps_header.php'
?>

<div class="picture_info">
    <div class="picture_head picture_head01">
        <div class="wrapper">
            <div class="img">
                <img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/1592314/88344662/api_thumb_450.jpg"
                     height="384px">
                <div id="my_change" class="btn">
                    <ul>
                        <li class="n1" sn="88344662" title="圣诞装饰红色星和古董婴儿鞋"><a href="javascript:void(0)">收藏</a></li>
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
                    <img src="http://meisupic.oss-cn-beijing.aliyuncs.com/thumbs/1592314/88344662/api_thumb_450.jpg">
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
                    <p>名称：圣诞装饰红色星和古董婴儿鞋</p>

                    <p>ID：88344662</p>
                    <p>作者：
                        <a href="homedp.php?username=LiliGraphie" class="goods_username">LiliGraphie</a>
                    </p>
                    <p>尺寸：4115×3850px／ dpi</p>
                    <p>格式：照片</p>
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
                        <li sn="88344662" title="圣诞装饰红色星和古董婴儿鞋"><a href="javascript:void(0)" id="goodsinfo_add">
                            下载原图</a></li>
                        <li sn="88344662" title="圣诞装饰红色星和古董婴儿鞋"><a href="javascript:void(0)" class="red" id="forward">查看评论</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!--comments-->
    <!--弹框-->
    <div class="modal fade bs-example-modal-sm" id="detail-modal" tabindex="-1" role="dialog"
         aria-labelledby="detail-modal-label">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="detail-modal-label">评论信息框</h4>
                </div>
                <div class="modal-body">
                    <form id="detail-form">
                        <div class="form-group input-logo">
                            <input type="text" class="form-control" placeholder="必填" value="匿名">
                            <span class="fa fa-user pull-left" aria-hidden="true">昵称</span>
                        </div>
                        <div class="form-group input-logo">
                            <input type="text" class="form-control" placeholder="选填">
                            <span class="fa fa-envelope pull-left" aria-hidden="true">邮箱</span>
                        </div>
                        <div class="form-group input-logo">
                            <input type="text" class="form-control" placeholder="选填">
                            <span class="fa fa-globe pull-left" aria-hidden="true">网址</span>
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-default btn-sm" id="detail-form-btn">提交评论</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
                <h3><i class="fa fa-comments-o fa-fw"></i><em>20</em>条评论~~~</h3>
                <ul class="comment">
                    <li>
                        <div class="comment-body" id="comment-1">
                            <div class="cheader">
                                <a target="_blank" href="https://github.com/zhangyd-c">
                                    <img class="userImage" src="img/user/11.jpg">
                                    <strong>张三</strong>
                                </a>
                                <div class="timer">
                                    <i class="fa fa-clock-o fa-fw"></i>2018-01-01 14:14:14
                                    <i class="fa fa-map-marker fa-fw"></i>北京市朝阳区
                                </div>
                            </div>
                            <div class="content">
                                <a href="#comment-5" class="comment-quote">@钱五</a>
                                在圣诞节中，北京真是个充满生机的城市…<img
                                    src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3c/pcmoren_wu_org.png"
                                    alt="[污]" data-w-e="1">
                            </div>
                            <div class="sign">
                                <i class="icons os-win2"></i>win8 <i class="sepa"></i>
                                <i class="icons browser-chrome"></i>chrome 15.0.0.12 <i class="sepa"></i>
                                <a href="#comment-1" class="comment-reply" onclick="$.comment.reply(1, this)"><i
                                        class="fa fa-reply fa-fw"></i>回复</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="comment-body" id="comment-2">
                            <div class="cheader">
                                <a target="_blank" href="https://github.com/zhangyd-c">
                                    <img class="userImage" src="img/user/3.jpg">
                                    <strong>李四</strong>
                                </a>
                                <div class="timer">
                                    <i class="fa fa-clock-o fa-fw"></i>2018-01-01 14:14:14
                                    <i class="fa fa-map-marker fa-fw"></i>北京市朝阳区
                                </div>
                            </div>
                            <div class="content">在圣诞节晚会，最后就我一个人去了。<img
                                    src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3c/pcmoren_wu_org.png"
                                    alt="[污]" data-w-e="1"></div>
                            <div class="sign">
                                <i class="icons os-linux"></i>Linux <i class="sepa"></i>
                                <i class="icons browser-tt"></i>TT 15.0.0.12 <i class="sepa"></i>
                                <a href="#comment-1" class="comment-reply" onclick="$.comment.reply(1, this)"><i
                                        class="fa fa-reply fa-fw"></i>回复</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="comment-body" id="comment-3">
                            <div class="cheader">
                                <a target="_blank" href="https://github.com/zhangyd-c">
                                    <img class="userImage" src="img/user/5.jpg">
                                    <strong>王二麻子</strong>
                                </a>
                                <div class="timer">
                                    <i class="fa fa-clock-o fa-fw"></i>2018-01-01 14:14:14
                                    <i class="fa fa-map-marker fa-fw"></i>北京市朝阳区
                                </div>
                            </div>
                            <div class="content">世界上有许多你意想不到的事，比如，这个圣诞节。<img
                                    src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3c/pcmoren_wu_org.png"
                                    alt="[污]" data-w-e="1"></div>
                            <div class="sign">
                                <i class="icons os-mac"></i>Mac <i class="sepa"></i>
                                <i class="icons browser-safari"></i>safari 15.0.0.12 <i class="sepa"></i>
                                <a href="#comment-1" class="comment-reply" onclick="$.comment.reply(1, this)"><i
                                        class="fa fa-reply fa-fw"></i>回复</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="comment-body" id="comment-4">
                            <div class="cheader">
                                <a target="_blank" href="https://github.com/zhangyd-c">
                                    <img class="userImage" src="img/user/6.jpg">
                                    <strong>赵一</strong>
                                </a>
                                <div class="timer">
                                    <i class="fa fa-clock-o fa-fw"></i>2018-01-01 14:14:14
                                    <i class="fa fa-map-marker fa-fw"></i>北京市朝阳区
                                </div>
                            </div>
                            <div class="content">床前明月光，疑是地上霜。举头望明月，低头思故乡。<img
                                    src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3c/pcmoren_wu_org.png"
                                    alt="[污]" data-w-e="1"></div>
                            <div class="sign">
                                <i class="icons os-ipad"></i>Ipad <i class="sepa"></i>
                                <i class="icons browser-safari"></i>safari 15.0.0.12 <i class="sepa"></i>
                                <a href="#comment-1" class="comment-reply" onclick="$.comment.reply(1, this)"><i
                                        class="fa fa-reply fa-fw"></i>回复</a>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="comment-body" id="comment-5">
                            <div class="cheader">
                                <a target="_blank" href="https://github.com/zhangyd-c">
                                    <img class="userImage" src="img/user/7.jpg">
                                    <strong>钱五</strong>
                                </a>
                                <div class="timer">
                                    <i class="fa fa-clock-o fa-fw"></i>2018-01-01 14:14:14
                                    <i class="fa fa-map-marker fa-fw"></i>北京市朝阳区
                                </div>
                            </div>
                            <div class="content">你以为你是铅笔盒啊，装那么多笔。<img
                                    src="http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/3c/pcmoren_wu_org.png"
                                    alt="[污]" data-w-e="1"></div>
                            <div class="sign">
                                <i class="icons os-android"></i>Android <i class="sepa"></i>
                                <i class="icons browser-safari"></i>safari 15.0.0.12 <i class="sepa"></i>
                                <a href="#comment-1" class="comment-reply" onclick="$.comment.reply(1, this)"><i
                                        class="fa fa-reply fa-fw"></i>回复</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--评论js-->
<script src="./js/wangEditor.min.js" type="text/javascript"></script>
<!--<script src="./js/jquery-1.7.2.min.js" type="text/javascript"></script>-->
<!--<script src="http://libs.baidu.com/jquery/2.1.4/jquery.min.js"></script>-->
<script src="https://cdn.bootcss.com/bootstrap/2.3.0/js/bootstrap.min.js" type="text/javascript"></script>
<script src="./js/xss.js" type="text/javascript"></script>
<script src="./js/wangEditor-fullscreen-plugin.js" type="text/javascript"></script>
<script src="./js/zyd.comment.js" type="text/javascript"></script>
<script type="text/javascript">
    var E = window.wangEditor
    var editor = new E('#editor')
    // 自定义菜单配置
    editor.customConfig.menus = [
        'code', // 插入代码
        //      'head', // 标题
        'bold', // 粗体
        'italic', // 斜体
        'underline', // 下划线
        //      'strikeThrough', // 删除线
        //      'foreColor', // 文字颜色
        //      'backColor', // 背景颜色
        'image', // 插入图片
        'link', // 插入链接
        'list', // 列表
        //      'justify', // 对齐方式
        'quote', // 引用
        'emoticon', // 表情
        //      'table', // 表格
        //      'video', // 插入视频
        //      'undo', // 撤销
        //      'redo' // 重复
    ];
    // debug模式下，有 JS 错误会以throw Error方式提示出来
    editor.customConfig.debug = true;

    // 关闭粘贴样式的过滤
    editor.customConfig.pasteFilterStyle = false;
    // 自定义处理粘贴的文本内容
    editor.customConfig.pasteTextHandle = function (content) {
        // content 即粘贴过来的内容（html 或 纯文本），可进行自定义处理然后返回
        return content + '<p>在粘贴内容后面追加一行</p>'
    };
    // 插入网络图片的回调
    editor.customConfig.linkImgCallback = function (url) {
        console.log(url) // url 即插入图片的地址
    };
    editor.customConfig.zIndex = 100;
    editor.create();
    E.fullscreen.init('#editor');
    //    editor.txt.clear(); //清空编辑器内容
    //    editor.txt.html('<p>用 JS 设置的内容</p><strong>hello</strong><script>alert(/xss/);<\/script>');
    //    editor.txt.append('<p>追加的内容</p>');
    // 读取 html
    console.log(editor.txt.html());
    // 读取 进行 xss 攻击过滤后的html
    console.log(filterXSS(editor.txt.html()));
    // 读取 text
    console.log(editor.txt.text());
    // 获取 JSON 格式的内容
    console.log(editor.txt.getJSON());
    //设置样式
    $("#my_change").css("display", "inherit");
</script>

<?php
	include 'footer.php' 
?>