<?php
namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
use DB;
use App\Http\Tool\Msg;
class Home_Controller extends BaseController{
	protected function get_limit_content($page,$count){
		$data = DB::table('main')->skip($page)->take($count)->get();
		return $data;
	}
	protected function msg_test(){
		Msg::push('商品异常');
		return false;
	}
}
