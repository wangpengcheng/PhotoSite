/*
* this file is used to add function for myself
* 2019-3-7 16:25
*/
//login model
$(function(){
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
           }
       });
       //logout
       $("#logout_button").click(function () {
           change_display($(".nav_af")[0]);
           change_display($(".nav_bf")[0]);
       });
   });
});