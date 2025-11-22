<?php
 function guid(){
                mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
                $charid = strtolower(md5(uniqid(rand(), true)));
                $hyphen = chr(45);// "_"
                $uuid = substr($charid, 0, 8).$hyphen
                        .substr($charid, 8, 4).$hyphen
                        .substr($charid,12, 4).$hyphen
                        .substr($charid,16, 4).$hyphen
                        .substr($charid,20,12);
                $uuid = strtolower($uuid);
                return $uuid;
        }
$accepted_origins = array("http://localhost", "http://127.0.0.1", "https://www.faceblock.io", "https://faceblock.io");
reset($_FILES);
$temp = current($_FILES);
        $path = "./content/uploads/img/";
        $temp = current($_FILES);
if (!is_uploaded_file($temp['tmp_name'])){
  // 通知编辑器上传失败
  header("HTTP/1.1 500 Server Error");
  exit;
}

if (isset($_SERVER['HTTP_ORIGIN'])) {
  // 验证来源是否在白名单内
  if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
    header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
  } else {
    header("HTTP/1.1 403 Origin Denied");
    exit;
  }
}

/*
  如果脚本需要接收cookie，在init中加入参数 images_upload_credentials : true
  并加入下面两个被注释掉的header内容
*/
// header('Access-Control-Allow-Credentials: true');
// header('P3P: CP="There is no P3P policy."');

// 简单的过滤一下文件名是否合格
//if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
//    header("HTTP/1.1 400 Invalid file name.");
//    exit;
//}

// 验证扩展名
if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "jpeg", "png"))) {
    header("HTTP/1.1 400 Invalid extension gif jpg png.");
    exit;
}        

$uploaded= false;
        $url ="";
       
            $fpath=$temp["tmp_name"];
            $oname=$temp["name"];
            $tmp = explode(".",$oname);
            $nname=guid().".".$tmp[count($tmp)-1];

            move_uploaded_file($fpath,$path.$nname);
           
                $url ="content/uploads/img/".$nname;// 成功上传后 获取上传信息
               $uploaded= true;
            
      die(json_encode(array('location' => $url)));

?>
