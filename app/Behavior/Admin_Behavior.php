<?php
namespace App\Behavior;

use DB;
use App\Http\Tool\Msg;
use App\Http\Tool\Filter;
class Admin_Behavior extends Behavior{
	/**
	 * 返回首页数据
	 * @param $id 跟据id查询
	 * @return array
	 */
	public function admin_get_content_detai($id){
		$data = DB::table('main')->where('id',$id)->first();
		if(empty($data)){
			Msg::push('没有数据');
			return false;
		}
		return $data;
	}
}