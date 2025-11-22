<!DOCTYPE html>
<!-- saved from url=(0030)http://account.test.56zxr.com/ -->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <script src="/includes/assets/js/jquery/jquery-3.2.1.min.js"></script>
     <script src="api/jQuery.md5.js"></script>
    <title>ipfs接口测试</title>

</head>
<body>
    <div>
    	<form id= "uploadForm" action= "http://localhost:8080" method= "post" enctype ="multipart/form-data">
			<input type="file" name="ipfs_file" id="ipfs_file" value="" placeholder="nft照片">
			<input type="button" onclick="RunIpfs();" value="上传" name="" style="width:100px;height:30px;">
			<input type="button" onclick="testUrl();" value="显示" name="" style="width:100px;height:30px;display:none;">
		</form>
		预览：
		<img id="ipfs_preview" src="#" /> 
    </div>
    <script type="text/javascript">
       
       function testUrl(){
       	$("#ipfs_preview").attr('src',"https://fs.faceblock.io/ipfs/"+"QmP1TjijyR2B6drSuHnCLeqi42RfrFdw3scu1f1V1dTTHD");
       	}
       function RunIpfs(){
    	   var apiUrl="https://ipfs.faceblock.io/api/v0/add?stream-channels=true&pin=false&wrap-with-directory=false&progress=false";
    	   var formobj =  document.getElementById("uploadForm");
    	   var formData = new FormData(formobj);
    	    //formData.append("file",$("#file_ipfs")[0].files[0]);
    	    //formData.append("demo","sssss");
    	    $.ajax({
    	        url:apiUrl, /*接口域名地址*/
    	        type:'post',
    	        data: formData,
    	        contentType: false,
    	        processData: false,
    	        success:function(d){
    	            console.log(d);
    	            $("#ipfs_preview").attr('src',"https://fs.faceblock.io/ipfs/"+d.Hash);
    	        },
    	        error: function (e) {
    	        	console.log(e);
    	        	}
    	    });
       }

    </script>




</body></html>