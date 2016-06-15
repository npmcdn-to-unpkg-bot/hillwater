<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Tool\Up;

class BaseController extends Controller{

	const ERR = 10000;

	/**
	 * 格式化json返回值
	 * @param $data 内容
	 * @param $info 说明
	 * @param $status 状态
	 **/
	protected function ajax_return($data,$info,$status){
		$result = json_encode(array(
			'data'   => $data,
			'info'   => $info,
			'status' => $status
		));
		header("Content-type:application/json");
		exit($result);
	}

	/**
	 * 检查必要参数是否上传
	 * @param string $method POST or GET
	 * @param array fields
	 * @return json or bool
	 **/
	protected function param_isset($method, $fields){
		if(empty($fields)){
			return true;
		}
		$temp = $method == 'POST' ? $_POST : $_GET;
		if(!is_array($fields)){
			$fields = array($fields);
		}
		$re = array();
		foreach($fields as $v){
			if(!isset($temp[$v])){
				$re[] = $v;
			}
		}
		if($re){
			$this->ajax_return($re,'缺少此等参数(lose some param like this)',self::ERR + __LINE__);
		}
		return true;
	}

	/**
	 * 图片上传
	 * 
	 *
	 */
	
}