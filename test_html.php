<!DOCTYPE html>
<html>
<head>
	<title>html 测试</title>
</head>
<body>
<script type="text/javascript" src="./js/jquery-1.7.2.js"></script>
<script type="text/javascript" src="./js/jquery.json.js"></script>
<script type="text/javascript" src="./js/jquery.cookie.js"></script>
<!-- <script type="text/javascript" src="./js/get_url_request.js"></script> -->
<script type="text/javascript">
	//添加下载按钮时间，添加下载记录
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
    var data={"user_id":user_id,"photo_id":photo_id,"load_type":"0"};
    console.log(data);
	$(function(){
		$($(".btns>ul>li>a")[0]).click(function(){
    		$.ajax({
    			url:"ps_up_dwon_history.php",
    			type:"post",
    			timeout:3000,
    			data:{"user_id":user_id,"photo_id":photo_id,"load_type":"0"},
    			dataType:"json",
    			success:function(result){
    				console.log(result);
    			},
    			error:function(xhr,state,errorThrown){
               			requesFail(xhr);
           		}
    		});
		});
	});
</script>
</body>
</html>