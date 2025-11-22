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

$file = $_FILES["pic"];

        $path = "./content/uploads/photos/".date('Y/m',time());
        
        $uploaded= false;
        $url ="";
       
        if($file){
            $fpath=$file["tmp_name"];
            $oname=$file["name"];
            $tmp = explode(".",$oname);
            $nname=guid().".".$tmp[count($tmp)-1];

            move_uploaded_file($fpath,$path."/".$nname);
           
                $url =$path."/".$nname;// 成功上传后 获取上传信息
               $uploaded= true;
            
        }
      die(json_encode(['uploaded'=> $uploaded,'url'=>$url]));

?>
