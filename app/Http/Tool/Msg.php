<?php
namespace App\Http\Tool;
/**
 * 推送消息
 * @author ryanye
 **/
class Msg{
	static private $_msg = array('no msg');
	/**
	 * 消息入堆栈
	 **/
	static public function push($msg){
		array_push(self::$_msg,$msg);
	}

	/**
	 * 消息出堆栈
	 **/
	static public function pop(){
		return array_pop(self::$_msg);
	}
}