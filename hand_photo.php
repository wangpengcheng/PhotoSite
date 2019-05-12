<?php
	include 'ps_header.php';
    include 'ps_connect.php';
?>
<?php
    $user_id=get_user_id($page_query);
function get_topic_list(){
        global $conn;
        $topic_list_array=[];
        $topic_list_sql="SELECT * FROM ps_topics";
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
    <form id="ImageFrom" action="./receive_photo.php" method="post" enctype="multipart/form-data">
        <div class="body">
            <div class="images-info item">
                <div class="item-head">
                    <h4>上传图片</h4>
                </div>
              <div class="c2-uploadarea">
                    <ul class="images-ul">
                            <li class="image" id="myli_1" style="display: none;">        
                                <div id="divPreview">
                                    <img id="imgHeadPhoto" src="noperson.jpg" style="width: 160px; height: 170px; border: solid 1px #d2e2e2;" alt="" />
                                </div>
                            </li>
                            <li id="myli_2">
                                <div class="mini-plus webuploader-container">
                                    <div class="webuploader-pick">
                                        <i></i>
                                        <br>
                                        <span>上传作品</span>
                                    </div>
                                    <div style="position: absolute; top: 35px; left: 21px; width: 120px; height: 132px; overflow: hidden; bottom: auto; right: auto;">
                                    </div>
                                        <input type="file" name="file"  onchange="PreviewImage(this,'imgHeadPhoto','divPreview');">
                                    
                                </div>
                            </li>
                    </ul>
                </div> 

            </div>
            <div class="creation-info item">
                <div class="item-head">
                    <h4>创作信息</h4>
                </div>
                <div class="item-body">
                    <dl class="prod-type" style="display: none;">
                        <dd style="">
                            <label class="label">专题类型
                            </label>
                            <ul>
                                <li class="artProductRegist sublist">
                                    <a href="#" data-id="artProductRegist" class="p-type-a">专题类型</a>
                                    <dl>
                                        <?php
                                        foreach ($topic_list_array as $temp) {
                                            echo '<dd><a href="javascript:void(0)">'.$temp['topic_id'].$temp['topic_name'].'</a></dd>';
                                        }
                                        ?>
                                    </dl>
                                </li>
                                <input type="hidden" name="worksType" id="worksType" value="photoProductRegist"/>
                                <input type="hidden" name="creativePurpose" id="creativePurpose"/>
                                <input type="hidden" name="topic_id" id="topic_id" value="text" />
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
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
                        <!-- <dd class="whether" style="display: none;">
                            <label class="label">是否发表</label>
                            <ul>
                                <li class="on last"><a href="#" id="nopub">未曾发表</a></li>
                                <li><a href="#" id="haspub">已发表</a></li>
                            </ul>
                            <input type="hidden" name="publishStatus" value="2">
                        </dd>
                        <dd class="first-date" id="first-date" style="display: none">
                            <label>首次发表日期</label>-->
                            <!--日历-->
                            <!-- <input type="text" name="firstPublishDate" id="firstPublishDate" value=""
                                   onClick="WdatePicker()"/>
                        </dd> --> 
                        <dd class="addr" id="addr2" style="margin-left: 0px;">
                            <label style="margin-right: 30px;">专题类型</label>
                            <!--级联-->
                            <select name="" class="first-select1" onchange="checkField(this.value)">
                                <?php
                                    foreach ($topic_list_array as $temp) {
                                        echo '<option value="'.$temp['topic_id'].'">'.$temp['topic_name'].'</option>';
                                    }
                                ?>
                            </select>
                        </dd>
                    </dl>
                    <dl class="explain">
                        <dd>
                            <label class="label">创作说明</label>
                            <textarea id="creationDesc" name="mainFeatures" rows="" cols=""
                                      placeholder="创作目的：为了更好的将美好的艺术形象留存在照相机镜头中，从而达到让广大的让对摄影作品有广泛认同的人，有所认知。独创性描述：该作品经过作者的独特构思，充分运用美术，画面内容形象生动的体现出太极弘图形文字Logo设计的特点。作品整体独特设计精巧，使整幅作品更容易识别和记忆，具有独创性和显著性两大特征。"></textarea>
                        </dd>
                    </dl>
                    <dl class="explain">
                        <dd>
                            <label class="label">作品标签</label>
                            <textarea id="creationDesc" name="mainFeatures2" rows="" cols=""
                                      placeholder="作品标签内容:请将标签以“;”字符分割排列"></textarea>
                        </dd>
                    </dl>
                </div>
            </div>
            <div class="btns">
                <ul>
                    <li class="next-btn"><input type="submit" value="确定提交" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</div>



<?php
	include 'footer.php' 
?>
<script type="text/javascript">
    function checkField(value1){
        document.getElementById("topic_id").value=value1; 
    }
</script>