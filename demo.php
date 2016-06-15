<?php
header("Content-type: text/html; charset=utf-8");   

$input = "红发散风寒姐啊司法局是否姐啊司法局123123123sjfjsf";
$key = "yatang.udc.pw.encrypt.key.addby.sivl";
/*static function pkcs5_pad($text, $blocksize){
	$pad = $blocksize - (strlen($text) % $blocksize);
    return $text . str_repeat(chr($pad), $pad);
}*/




function encrypt($input,$key){
	$size = mcrypt_get_block_size(MCRYPT_3DES, 'ecb');
	//var_dump($size);
	$pad = ($size - (strlen($input) % $size));
	//var_dump(strlen($input) % $size);
	$char = str_repeat(chr($pad),$pad);
	$input = ($input.(string)str_repeat(chr($pad),$pad));
	$key = str_pad($key,24,"0");
	$td = mcrypt_module_open(MCRYPT_3DES, '', 'ecb', '');
	$iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
	@mcrypt_generic_init($td, $key, $iv);
	$data = mcrypt_generic($td, $input);
	mcrypt_generic_deinit($td);
	mcrypt_module_close($td);
	$data = base64_encode($data);
	echo $data;
}

	/**
	 * Jiemi
	 */
$encrypted = "3jPJBV6J0RkbA4uOaj4B8m7Nw+x6U6HscNGZ70+at1MkmoRkAqIeNkqtkPQpgE4Lvj9pQsQZs+dd5unVOXBTkSdrV0rL6QgS
";
function decrypt($encrypted,$key){
	$encrypted = base64_decode($encrypted);
	$key = str_pad($key, 24, '0');
	$td = mcrypt_module_open(MCRYPT_3DES, '', 'ecb', '');
	$iv = @mcrypt_create_iv(mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
  	$ks = mcrypt_enc_get_key_size($td);
  	@mcrypt_generic_init($td, $key, $iv);
  	$decrypted = mdecrypt_generic($td, $encrypted);
  	mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $pad = ord($decrypted{strlen($decrypted)-1});
    if($pad > strlen($decrypted)){
    	exit("长度不相等，无法解密1");
    	//echo 75;
    }
    if(strspn($decrypted,chr($pad),strlen($decrypted)-$pad) != $pad){
    	//echo 78;
    	exit("长度不相等，无法解密2");
    }
    $return = substr($decrypted,0,-1*$pad);
    echo $return;
}
encrypt($input,$key);
echo "<br/>";
decrypt($encrypted,$key);

