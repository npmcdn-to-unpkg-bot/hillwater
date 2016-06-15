<?php
namespace App\Behavior;

use DB;
use App\Http\Tool\Msg;
class Hillwater_Behavior extends Behavior{
	/**
	 * 诗景详细数据
	 *
	 */
	public function hillwater_get(){
		$id =6;
		$data = DB::table('hillwater')->where('id',$id)->first();
		if(empty($data)){
			Msg::push('没有内容,请选择正确的id(no content)');
			return false;
		}
		$this->ajax_return($data,null,null);
	}
}