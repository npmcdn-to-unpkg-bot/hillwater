<?php
 header("Content-type: text/html; charset=utf-8");              
$path=$_SERVER['DOCUMENT_ROOT'].'/admin/';

//var_dump($path);
if(!empty($_FILES)){
 echo "aaaa"."<br/>";
var_dump($_FILES);
if(is_uploaded_file($_FILES['images']['tmp_name'][0])){
 echo "1111"."<br/>";

}

foreach($_FILES['images']['tmp_name'] as $k=>$v){
		if(is_uploaded_file($_FILES['images']['tmp_name'][$k])){
			$save=$path.$_FILES['images']['name'][$k];
			echo $save."<br>";
			if(move_uploaded_file($_FILES['images']['tmp_name'][$k],$save)){
				echo "上传成功！";
			}
		}
	}
	echo "<pre>";
	print_r($_FILES['images']['name']);
	echo "</pre>";
}

?>