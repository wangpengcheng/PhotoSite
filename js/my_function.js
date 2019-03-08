/*
* this file is used to add function for myself
* 2019-3-7 16:25
*/
//login model
$(function(){
    function requesFail(xhr){
        var status = xhr.status;
        if (status) {
            console.log("error", "网络错误", "发生网络错误，错误码为：" + xhr.status);
        } else {
            console.log("error", "网络错误", "未知网络错误, 请确保设备处在联网状态");
        }
    }
    function sleep(delay) {
        var start = (new Date()).getTime();
        while ((new Date()).getTime() - start < delay) {
            continue;
        }
    }
  var change_display=function (element) {
      if(element.style.display==="none"){
            element.style.display="inline"
      }else {
          element.style.display="none";
      };
  };
   $("#login_button").click(function(){
       var user_name=document.getElementById("login_username").value;
       var user_passwd=document.getElementById("login_password").value;
       var result_string="";
       $.ajax({
           url:"http://118.24.113.233/PhotoSite/ps_login.php",
           type:"post",
           timeout: 1000,
           data:{"user_name":user_name,"user_pwd":user_passwd },
           dataType:"json",
           success:function(result){
               switch (parseInt(result["result_state"])){
                   case 0:
                       result_string="登录成功";
                       layer.closeAll();
                       //change hiden
                       var nav_af=$(".nav_af")[0];
                       var nav_bf=$(".nav_bf")[0];
                       change_display(nav_af);
                       change_display(nav_bf);
                        //change HTML
                       var user_id=result["user_id"];
                       var user_name=result["user_name"];
                       $(".nav_af>ul>.le>a")[0].innerText=user_name;
                       $(".nav_af>ul>.le>a")[0].href="./user_page.html?user_id="+user_id;
                        //change hraf
                       var temp_a=$(".hdn>dl>dd>a");
                       for(var i=0;i<temp_a.length;++i){
                           temp_a[i].href.replace("user_id=","user_id="+user_id);
                       }
                       break;
                   case 1:
                       result_string="密码错误";
                       break;
                   case 3:
                       result_string="用户名错误";
                       break;
                   default:

               };
               layer.msg(result_string,
                   {
                       icon: 1,
                       time:2000
                   });
           },
           error:function(xhr,state,errorThrown){
               requesFail(xhr);
           }
       });
       //logout
       $("#logout_button").click(function () {
           change_display($(".nav_af")[0]);
           change_display($(".nav_bf")[0]);
       });

   });
   $("#register_button").click(function () {
       var user_name=document.getElementById("extend_field102").value;
       var user_pwd=document.getElementById("password").value;
       var pwd_confirm=document.getElementById("confirm_password").value;
       var phone=document.getElementById("extend_field5").value;
       $.ajax({
           url:"http://118.24.113.233/PhotoSite/ps_register.php",
           type:"post",
           timeout: 3000,
           data:{"user_name":user_name,"user_pwd":user_pwd,"pwd_confirm":pwd_confirm,"phone":phone},
           dataType:"json",
           success:function(result){
               //$("#div1").html(result);
               console.log(result["result"]);
               if(result["result"]=="注册成功,请登录"||
                   result["result"]=="该用户名已存在,请登录"){
                   layer.closeAll();
                   var index = layer.open({
                       type: 1,
                       title: false,
                       closeBtn: 1,
                       area: ['520px', '470px'], //宽高
                       content: $('#login_wrap'),
                       yes: function(index){
                           layer.close(index);
                       }
                   });
               };
               layer.msg(result["result"],
                   {
                       icon: 1,
                       time:2000
                   });
           },
           error:function(xhr,state,errorThrown){
               requesFail(xhr);
           }
       });
   });
});