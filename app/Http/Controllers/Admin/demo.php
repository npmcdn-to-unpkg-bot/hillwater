<?php
$zip = new ZipArchive;
$open = $zip->open('text.zip');
var_dump($open);
if($zip->open('text.zip')===TRUE){
	$zip->extractTo('note.txt');
	echo 11;
	$zip->close();
}
else{
	echo 'failed,code';
}