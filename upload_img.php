<?php
	function _request($str){ 
		$val = !empty($_POST[$str]) ? $_POST[$str] : null;
		if ($val==""){
			$val = !empty($_GET[$str]) ? $_GET[$str] : null;
		}
		if ($val==""){
			$val = !empty($_COOKIE[$str]) ? $_COOKIE[$str] : null;
		}
		return $val; 
	}

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
	define('FILE_APPEND', 1); 

	if (!function_exists("file_put_contents")) { 

	    function file_put_contents($n, $d, $flag = false) { 
	        $mode = ($flag == FILE_APPEND || strtoupper($flag) == 'FILE_APPEND') ? 'a' : 'w'; 
	        $f = @fopen($n, $mode); 
	        if ($f === false) { 
	            return 0; 
	        } else { 
	            if (is_array($d)) $d = implode($d); 
	            $bytes_written = fwrite($f, $d); 
	            fclose($f); 
	            return $bytes_written; 
	        } 
	    } 

	} 
    function file_write($img,$path,$file){
        //匹配出图片的格式
        if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $img, $result)){
			$img = str_replace('data:image/jpeg;base64,','',$img);
			$img = str_replace('data:image/bmp;base64,','',$img);
			$img = str_replace('data:image/png;base64,','',$img);
			$img = str_replace('data:image/jpg;base64,','',$img);
			$img = str_replace('data:image/gif;base64,','',$img);
			$img = str_replace('   ','+++',$img);
			$img = str_replace('  ','++',$img);
			$img = str_replace(' ','+',$img);
            $type = 'jpg';
            if(!file_exists($path)){
                mkdir($path, 0755);
            }
            $result = file_put_contents($path.'/'.$file.'.'.$type, base64_decode($img));
            return $path.'/'.$file.'.'.$type;
        }else{
            return false;
        }
    }
 
	$act = _request('act');
	
	if ($act=='upload') {
		$img_original = _request('img');
		$path = './content/uploads/photos/'.date('Y/m',time());
		$file = guid();
		$path = file_write($img_original,$path,$file);
		if ($path) {
			print_r('{"code":200,"path":"'.$path.'"}');
		}
	}
?>
