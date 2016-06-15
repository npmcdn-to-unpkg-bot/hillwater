<?php
namespace App\Http\Tool;
/**
 * 过滤类
 * @author yll
 * @version 2016/04/19
 **/
class Filter{
	const RG_MD5 = '/^[a-zA-Z0-9]{32}$/';
	const RG_CHAR = '/^[a-zA-Z_]{1,20}$/';
	const RG_YMD = '/^\d{4}-\d{2}-\d{2}$/';

	/*
	 * 过滤标签和特殊字符包括引号
	 **/
	static public function get_str($str,$filter = FILTER_SANITIZE_STRING){
		return addslashes(filter_var($str,FILTER_SANITIZE_STRING));
	}

	/**
	 * 检查整型范围
	 **/
	static public function check_int_range($int,$min,$max){
		if(!is_integer($int) || $int<$min || $int>$max){
			return false;
		}
		return true;
	}

	/**
	 * 检查字符串
	 **/
	static public function check_str($str,$regex){
		if(!preg_match($regex,$str)){
			return false;
		}
		return true;
	}
}