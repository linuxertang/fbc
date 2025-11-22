<?php
/**
 * search
 * 
 * @package Sngine
 * @author Zamblek
 */

// fetch bootstrap
require('bootstrap.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name='apple-mobile-web-app-capable' content='yes' />
<meta name='full-screen' content='true' />
<meta name='x5-fullscreen' content='true' />
<meta name='360-fullscreen' content='true' />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="format-detection" content="telephone=no" />
<title>价值名片</title>
<script type="text/javascript" src="../includes/assets/js/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="../includes/assets/base64-js/base64.js"></script>
<script type="text/javascript" src="../includes/assets/base64-js/base64image.js"></script>
<script type="text/javascript" src="../includes/assets/base64-js/exif.js"></script>	
	<style type="text/css">
		* {margin:0;padding:0;}
		-webkit-transform:translate3d(0,0,0).
		html, body {height: 100%;}
		a:link { text-decoration: none; }
		.input {height:35px; border:1px solid #dfdfdf; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:35px; padding-left:10px; box-shadow:0px 0px 0px rgba(0,0,0,0); -webkit-appearance:none; color:#666666; outline:none; font-size:12px; border-radius: 0; box-sizing:border-box;}
		.a-upload { 
			width: 100%;
			height: 400px;  
			max-height:400px;
			line-height: 400px;  
			position: relative;  
			cursor: pointer;  
			color: #888;
			background: #fafafa;  
			border: 0px solid #ddd;  
			border-radius: 0px;  
			overflow: hidden;  
			display: inline-block;  
			*display: inline;  
			*zoom: 1  
		}  
		  
		.a-upload  input {  
			position: absolute;  
			font-size: 110px;  
			right: 0;  
			top: 0;  
			opacity: 0;  
			filter: alpha(opacity=0);  
			cursor: pointer  
		}  
	  
	</style>
	<script>
    	Request = {
    		QueryString : function(item){
    			var svalue = location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
    			return svalue ? svalue[1] : svalue;
    		}
    	}

		$(document).ready(function(){
			var user = decodeURI(Request.QueryString("user"));
			$("#ipt_user").val(user);
			info_get(user);
		});
        function info_get(user){
            var sendUrl='';
            $.ajax({
				type    : "get",
				async   : false,
				url     : "../includes/ajax/users/getprofile.php?user=" + user + "&rnd=" + Math.random(),
				data    : sendUrl,
				success : function(msg){
                    var msg = eval('(' + msg + ')');
                    var result = msg.code;
                    var tag = msg.tag;
                    var brief = msg.brief;
                    var nick = msg.nick;
                    var url = msg.url;
                    var islogin = msg.islogin;
                    var isself = msg.self;
                    var img = msg.img;
                    //{"tag":null,"brief":null,"nick":null,"url":null,"code":200,"islogin":false,"self":false}
                    if (result==200) {
                        $("#card_name").html(nick + '&nbsp;&nbsp;&nbsp;<a href="https://www.faceblock.io/?ref='+ user +'"><span style="width:115px; height:26px; margin-top:15px; border:1px solid #fff; border-radius:15px 15px 15px 15px; background:#419FFF; color:#fff; font-size:12px; line-height:26px; text-align:center; display:inline-block">去faceblock看TA</span></a>');
                        $("#card_tag").html(tag);
                        $("#card_url").val();
                        if (url==''){
                        	url="暂无链接";
                        }
                        $("#info_url").html('<a href="' + url +'"><input class="input" type="text" style="width:100%;" name="card_url" id="card_url" readonly="true" onblur="get_config();" autocomplete="off" value=' + url +'></a>');
                        //img = img.replace(/\-/g, "+");
						//img = img.replace(/\_/g, "/");
						
						brief = brief.replace(/\r/g, "<br>");
						brief = brief.replace(/\n/g, "<br>");
						$("#card_brief").html(brief);
						img = img.replace(/\s/g, "+");
						if (img!=''){
							$("#card_img_show").css("background","url(" + img + ")");
							$("#card_img_show").css("background-size","cover");
							$("#edit_card_img_show").css("background","url(" + img + ")");
							$("#edit_card_img_show").css("background-size","cover");
						} else {
							$("#card_img_show").css("background","#419fff");
							$("#card_img_show").css("background-size","cover");
						}

						$("#edit_card_img_path").val(img);
                    	$("#edit_card_url").val(url);
						$("#edit_card_tag").val(tag);
						$("#edit_card_brief").val(brief);
						

                        if (msg.pic.indexOf(".png") != -1 || msg.pic.indexOf(".bmp") != -1 || msg.pic.indexOf(".jpg") != -1 || msg.pic.indexOf(".jpeg") != -1 || msg.pic.indexOf(".bmp") != -1){
							$("#card_head").html('<img src="' + msg.pic + '" style="width:60px; height:60px; border-radius:50%; border:1px solid #fff;">');
                        } else {
                        	$("#card_head").html('<img src="../content/themes/default/images/head_default.png" style="width:60px; border-radius:50%">');
                        }
                       
                        cardurl='<a href="https://www.faceblock.io/?ref='+ user +'"><div style="width:160px; height:30px; margin-top:15px; border:1px solid #419FFF; border-radius:15px 15px 15px 15px; background:#419FFF; color:#fff; font-size:14px; line-height:30px;">去faceblock看TA</div></a>';
                        
                        $("#card_reg").html('<input id="btn" type="button" value="我也想要价值名片" style="width:160px; height:30px; line-height:30px; font-size:14px; border:0px; background-color:#dfdfdf; color:#666; border-radius:20px 20px 20px 20px; cursor:pointer; box-shadow:0px 0px 0px rgba(0,0,0,0); -webkit-appearance:none; " onclick="location.href=\'https://www.faceblock.io/?ref=' + user + '\'">');
                        $("#card_url").html(url);
                        $("#card_brief").html(brief);
                        return true; 
                    } else {
                        alert('信息获取失败');
                        return false; 
                    }
     		    },
                error:function(XHR, TS, ET){},
                complete: function (XHR, TS){ 
                XHR = null;
                }
            }); 
        }
		var fileUp = function (me) {
			//$("#edit_card_img_base64").val("");
			base64Image({
				file: me,                              /*【必填】对应的上传元素 */
				callback: function (imageUrl) {        /*【必填】处理成功后的回调函数 */
					
					/*imageUrl为得到的图片base64数据，这里可以进行上传到服务器或者其他逻辑操作 */

					var sendUrl="act=upload&img=" + escape(imageUrl) + "&rnd=" + Math.random();
					$.ajax({
					type	: "post",
					async	: true,
					url 	: "../upload_img.php",
					data	: sendUrl,
					success	: function(msg){
							var msg = eval('(' + msg + ')');
							if (msg.code==200){
								$("#edit_card_img_path").val(msg.path);
								$("#edit_card_img_show").css("background","url(" + msg.path + ")");
								$("#edit_card_img_show").css("background-size","cover");
							} else {
								$("#edit_card_img_path").val("");
								alert("上传失败，请尽量缩小图片尺寸");
							}
						},
					error:function(XHR, TS, ET){},
					complete: function (XHR, TS){ 
						XHR = null;
						}
					});
				
					
				},
				width:700,                          /*【选填】宽度默认750，如果图片尺寸大于该宽度，图片将被设置为该宽度*/
				ratio:0.90,                         /*【选填】压缩率默认0.75 */
			});
		};
		function info_hide(){
			$("#info_show").hide();
			$("#info_edit").show();
		}
        function info_edit(){
        	var user = decodeURI(Request.QueryString("user"));
        	var nick = '';
        	var url = $("#edit_card_url").val();
        	var img = $("#edit_card_img_path").val();
        	//img = img.replace(/\+/g, "-");
			//img = img.replace(/\//g, "_");
        	var tag = $("#edit_card_tag").val();
        	var brief = $("#edit_card_brief").val();
        	var pwd = $("#edit_card_pass").val();
			var sign =  BASE64.encode('user=' + user + '&nick=' + nick + '&url=' + url + '@lja05v1');
			sign = sign.replace(/\+/g, "-");
			sign = sign.replace(/\//g, "_");
            var sendUrl='user=' + user + '&nick=' + nick + '&url=' + url + '&img=' + escape(img) + '&tag=' + tag + '&brief=' + brief + '&sign=' + sign + '&pwd=' + pwd + '&rnd=' + Math.random();
            $.ajax({
				type    : "post",
				async   : false,
				//https://www.faceblock.io/includes/ajax/users/.php
				url     : "../includes/ajax/users/setprofile.php",
				data    : sendUrl,
				success : function(msg){
                    var msg = eval('(' + msg + ')');
                    if (msg.code==200){
						alert("修改成功");
						location.reload();
						info_get(user);
                    } else {
                    	alert(msg.msg);
                    }
                    
     		    },
                error:function(XHR, TS, ET){},
                complete: function (XHR, TS){ 
                XHR = null;
                }
            }); 
        }
	</script>
</head>
<body style="font-family:微软雅黑; background: #efefef; ">
	<div id="bg"></div>
			<div id="info_show" align="center" style="width:98%; height:100%; font-size:12px; box-sizing:border-box;  padding-top:0px; margin-left:auto; margin-right:auto; margin-bottom:30px; ">
				<div align="center" id="div_vote" style="width:100%; max-width: 650px; border:0px solid #dddddd; padding-bottom:20px; border-radius:10px 10px 10px 10px; background:#fff; color:#666; box-sizing:border-box; ">
					<div align="right" id="card_img_show" class="a-upload" style="width:100%; height: 58vw; max-height:400px; line-height: 100%; text-align:right; border:0px solid #cfcfcf; border-radius:5px 5px 5px 5px;background: url('../content/themes/default/images/video_bg.png') no-repeat center center; background-size:cover; color:#fff; font-size:16px; padding-top:10px; padding-right:10px; box-sizing: border-box; box-sizing: border-box;"  onClick="info_hide();"><div style="position:absolute; width:20%; height:20px; line-height:20px; margin-left:75%; margin-top:10px; text-align:center; border:1px solid #fff; border-radius:15px 15px 15px 15px; background:#419FFF; color:#fff; font-size:12px;">修改</div></div>
					<div style="clear:both"></div>
					<div id="card_head" style="box-sizing:border-box; margin-top:-35px; margin-left:10px; z-index:999; position: absolute;"></div>
					<div align="left" style="box-sizing:border-box; margin-top:-55px; margin-left:80px; z-index:999; position: absolute;">
						<div id="card_name" style="box-sizing:border-box;border:0px solid #000; font-size:16px; font-weight:bold; margin-top:3px; color:#fff; padding-right:5px;"></div>
						<div id="card_tag" style="box-sizing:border-box;border:0px solid #000; font-size:12px; color:#aaaaaa;; margin-top:15px;"></div>
						<div id="card_faceblock" style="margin-top:-10px; width:100%; vertical-align:middle; text-align: center; height:30px; line-height:30px;"></div>
					</div>
					
					<div align="left" style="margin-top:55px;"><font style="color:red">*</font>&nbsp;视频链接：</div>
					<div id="info_url" align="left" style="margin-top:8px;"></div>
					<div align="left" style="margin-top:15px; box-sizing: border-box;"><font style="color:red">*</font>&nbsp;个人简介：</div>
					<div align="left" style="margin-top:8px; box-sizing: border-box;"><div name="card_brief" id="card_brief" style="width:100%; border:1px solid #dfdfdf; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:20px; padding:5px; box-shadow:0px 0px 0px rgba(0,0,0,0); -webkit-appearance:none; color:#666666; outline:none; font-size:12px; box-sizing:border-box; resize:none; border-radius: 0; "></div></div>
					
					<div id="card_reg" align="center" style="margin-top:20px; "></div>
				</div>
			</div>
	
			<div id="info_edit" align="center" style="width:98%; height:100%; font-size:12px; box-sizing:border-box;  padding-top:0px; margin-left:auto; margin-right:auto; margin-bottom:30px; display: none;">
				<div align="center" id="div_vote" style="width:98%; max-width: 650px; border:1px solid #dddddd; padding:15px; padding-bottom:20px; border-radius:0; background:#fff; color:#666; box-sizing:border-box; ">
					<input type="hidden" name="ipt_user" id="ipt_user" value="">
					<input type="hidden" name="edit_card_img_path" id="edit_card_img_path">
					<div align="left" style="margin-top:15px; "><font style="color:red; ">*</font>&nbsp;视频封面：(建议宽:高=0.68)</div>
					<div id="edit_card_img_show" class="a-upload" style="width:100%; height: 58vw; max-height:400px; margin-top:8px; line-height: 100%; text-align:center; border:1px solid #cfcfcf; border-radius:5px 5px 5px 5px;background: url('../content/themes/default/images/video_bg.png') no-repeat center center; background-size: cover; background-repeat: no-repeat; height: 0; padding-top: 66.64%;"><input type="file" accept="image/*" onchange="fileUp(this)" name="edit_card_img" id="edit_card_img" style="border:0px; height:400px; "></div>
					<div style="clear:both"></div>
					<div align="left" style="margin-top:15px;"><font style="color:red">*</font>&nbsp;视频链接：</div>
					<div align="left" style="margin-top:8px;"><input class="input" type="text" style="width:100%;" name="edit_card_url" id="edit_card_url" onblur="get_config();" autocomplete="off" placeholder="请输入视频链接，格式如 http://www.weibo.com.com/12345" /></div>
					<div align="left" style="margin-top:15px; box-sizing: border-box;"><font style="color:red">*</font>&nbsp;个人标签：</div>
					<div align="left" style="margin-top:8px; box-sizing: border-box;"><input type='text' class="input" style="width:100%;" name="edit_card_tag" id="edit_card_tag" autocomplete="off" placeholder="请输入个人标签，多个空格间隔" /></div>
					<div align="left" style="margin-top:15px; box-sizing: border-box;"><font style="color:red">*</font>&nbsp;个人简介：</div>
					<div align="left" style="margin-top:8px; box-sizing: border-box;"><textarea name="edit_card_brief" id="edit_card_brief" style="width:100%; height:90px; border:1px solid #dfdfdf; font-family:Verdana, Arial, Helvetica, sans-serif; line-height:20px; padding:5px; box-shadow:0px 0px 0px rgba(0,0,0,0); -webkit-appearance:none; color:#666666; outline:none; font-size:12px; box-sizing:border-box; resize:none; border-radius: 0; " placeholder="请输入个人简介，方便世界更好地认识您" ></textarea></div>
					<div align="left" style="margin-top:15px; box-sizing: border-box;"><font style="color:red">*</font>&nbsp;登录密码：</div>
					<div align="left" style="margin-top:8px; box-sizing: border-box;"><input type='password' class="input" style="width:100%;" name="edit_card_pass" id="edit_card_pass" autocomplete="off" placeholder="请输入登录密码验证身份" /></div>
					<div align="center" style="margin-top:20px; "><input id="btn" type="button" value="立即修改" style="width:100%; height:40px; line-height:40px; font-size:14px; border:0px; background-color:#419fff; color:#FFFFFF; border-radius:20px 20px 20px 20px; cursor:pointer; box-shadow:0px 0px 0px rgba(0,0,0,0); -webkit-appearance:none; " onClick="info_edit();"></div>
				</div>
			</div>
	
</body>
</html>

