<?php
	include 'ps_header.php'; 
?>

<div class="container3 wrapper">
    <div class="pop-edit" id="pop-edit" style="display: none;">
        <div class="pop_head">
            <h4>提示</h4>
        </div>
        <div class="txt">
            <p align="center">您还未实名认证，请先实名认证！</p>
        </div>
    </div>
    <div class="head">
        <h2>上传图片</h2>
    </div>
    <form id="edit-form" action="" method="post" onkeydown="if(event.keyCode==13){return false;}">
        <div class="body">
            <div class="images-info item">
                <div class="item-head">
                    <h4>上传图片</h4>
                </div>
                <div class="c2-uploadarea">
                    <div class="plus">
                        <i></i><br><span>上传作品</span>
                    </div>
                    <ul class="images-ul" style="display: none;">
                        <li>
                            <div class="mini-plus">
                                <i></i><br><span>上传作品</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="body-foot">
                    <ul>
                        <li>涉及到肖像授权，请同时上传PDF格式人像授权书，<a href="/static/front/file/肖像权使用授权声明.docx">下载模板</a>
                            &nbsp;&nbsp;&nbsp;<a id="upload-pdf-btn">上传授权书</a>
                            &nbsp;&nbsp;&nbsp;<a class="hide auth-cert-name" target="_blank">证书名称.pdf</a>
                            &nbsp;&nbsp;&nbsp;<a class="hide auth-cert-del-btn">删除</a>
                        </li>
                        <li>图片格式仅限<span style="color: #FC4349">JPG、PNG，不低于400万像素，最大20M</span></li>
                        <li>可编辑类图需要上传<span style="color: #FC4349">相同命名的“JPG封面图（20M以内）＋EPS/PSD格式源文件”，暂不支持AI格式。</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="creation-info item">
                <div class="item-head">
                    <h4>创作信息</h4>
                </div>
                <div class="item-body">
                    <dl class="prod-type">
                        <dd>
                            <label class="label">作品类型
                                <div class="prod-type-hint">
                                    <em id="pth-em"></em>
                                    <div class="hint-content" style="">
                                        <ul>
                                            <li>
                                                <h2>摄影</h2>
                                                <p>人物照片、动植物照片、风景照片、艺术摄影等</p>
                                            </li>
                                            <li>
                                                <h2>美术作品</h2>
                                                <p>绘画、插画、漫画、海报、书法、字体、雕塑、表情包、工业设计、陶瓷类工艺品等</p>
                                            </li>
                                            <li>
                                                <h2>工程图</h2>
                                                <p>工程设计图、产品设计图等施工图纸</p>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </label>
                            <ul>
                                <li class="on photoProductRegist"><a href="#" data-id="photoProductRegist"
                                                                     class="p-type-a">摄影</a></li>
                                <li class="artProductRegist sublist">
                                    <a href="#" data-id="artProductRegist" class="p-type-a">美术作品</a>
                                    <dl>
                                        <dd><a href="javascript:void(0)">全部美术作品</a></dd>
                                        <dd><a href="javascript:void(0)">绘画</a></dd>
                                        <dd><a href="javascript:void(0)">海报</a></dd>
                                        <dd><a href="javascript:void(0)">UI设计</a></dd>
                                        <dd><a href="javascript:void(0)">VI设计</a></dd>
                                        <dd><a href="javascript:void(0)">字体</a></dd>
                                        <dd><a href="javascript:void(0)">室内设计</a></dd>
                                    </dl>
                                </li>
                                <li class="chartProductRegist"><a href="#" data-id="chartProductRegist"
                                                                  class="p-type-a">工程图</a></li>
                                <input type="hidden" name="worksType" value="photoProductRegist"/>
                                <input type="hidden" name="creativePurpose" id="creativePurpose"/>
                            </ul>
                        </dd>
                    </dl>
                    <dl class="prod-name">
                        <dd class="pname-dd">
                            <label class="label">作品名称</label>
                            <input type="text" name="worksFullName" value="" maxlength="30"/>
                            <div id="ipn-description"></div>
                        </dd>
                        <dd class="done-date">
                            <label>完成日期</label>
                            <!--日历-->
                            <input type="text" name="creationDate" id="inputCompleteDate" value=""
                                   onClick="WdatePicker()"/>
                        </dd>
                        <dd class="addr" id="addr1">
                            <label>创作地点</label>
                            <!--级联-->

                            <select class="first-select" name="">
                                <option value="中国">中国</option>
                                <option value="海外">海外</option>
                            </select>
                            <div class="div-select">
                                <select name="" id="dd1" class="province">
                                    <!--<option value=""></option>-->
                                </select>
                                <font class="prov-font1" style="display: none">请选择创作省份</font>
                                <select name="" id="dd2" class="last-select city">
                                    <!--<option value="">市/区</option>-->
                                </select>
                                <font class="prov-font2" style="display: none">请选择创作城市</font>
                                <select name="" class="district" style="display: none;">
                                    <option value="creationCity"></option>
                                </select>
                            </div>
                            <div class="div-input" style="display: none;">
                                <input type="text" class="txt1" name="creationCountry" id="creationCountry"
                                       value="中国" placeholder="国家"/>
                                <input type="hidden" name="creationProvince" id="creationProvince" value="">
                                <input type="text" name="creationCity" id="creationCity" value="" placeholder="城市"/>
                            </div>
                        </dd>
                    </dl>
                    <dl class="publish">
                        <dd class="whether">
                            <label class="label">是否发表</label>
                            <ul>
                                <li class="on last"><a href="#" id="nopub">未曾发表</a></li>
                                <li><a href="#" id="haspub">已发表</a></li>
                            </ul>
                            <input type="hidden" name="publishStatus" value="2">
                        </dd>
                        <dd class="first-date" id="first-date" style="display: none">
                            <label>首次发表日期</label>
                            <!--日历-->
                            <input type="text" name="firstPublishDate" id="firstPublishDate" value=""
                                   onClick="WdatePicker()"/>
                        </dd>
                        <dd class="addr" id="addr2" style="display: none;">
                            <label>发表地点</label>
                            <!--级联-->
                            <select name="" class="first-select">
                                <option value="中国">中国</option>
                                <option value="海外">海外</option>
                            </select>
                            <div class="div-select">
                                <select name="" id="dd3" class="province1">
                                    <!--<option value="">省/市</option>-->
                                </select>
                                <select name="" id="dd4" class="last-select city1">
                                    <!--<option value="">市/区</option>-->
                                </select>
                                <select name="" class="district1" style="display: none;">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="div-input" style="display: none;">
                                <input type="text" class="txt1" name="firstPublishCountry" id="firstPublishCountry"
                                       value="中国" placeholder="国家"/>
                                <input type="hidden" name="firstPublishProvince" id="firstPublishProvince"
                                       value="北京市">
                                <input type="text" name="firstPublishCity" id="firstPublishCity" value="北京市"
                                       placeholder="城市"/>
                            </div>
                        </dd>
                    </dl>
                    <dl class="explain">
                        <dd>
                            <label class="label">创作说明</label>
                            <textarea id="creationDesc" name="mainFeatures" rows="" cols=""
                                      placeholder="创作目的：为了更好的将美好的艺术形象留存在照相机镜头中，从而达到让广大的让对摄影作品有广泛认同的人，有所认知。独创性描述：该作品经过作者的独特构思，充分运用美术，画面内容形象生动的体现出太极弘图形文字Logo设计的特点。作品整体独特设计精巧，使整幅作品更容易识别和记忆，具有独创性和显著性两大特征。"></textarea>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="btns">
                <ul>
                    <li class="next-btn"><a href="./html/Information_confirm.html"><input type="submit" value="确定提交"/></a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>



<?php
	include 'footer.php' 
?>