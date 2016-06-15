<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Tool\Msg;
use App\Http\Tool\Filter;
use DB;
class Hillwater_Model extends Model{
	static public function check_param($param){
		if($param['verse'] === ""){
			Msg::push('诗词歌赋内容不能为空');
			return false;
		}
		if($param['tag'] === ""){
			Msg::push('标签不能为空');
			return false;
		}
		return true;
	}
	/**
	 * 增加资料
	 *
	 */
	public function hillwater_content_add($param){
		$data = DB::table('hillwater')->insert(
			array(
				'verse'  	 => $param['verse'],
				'tag'  	 	 => $param['tag'],
				'analyses' 	 => $param['analyses'],
				'place'	 	 => $param['place'],
				'picture'    => $param['picture'],
				'picture_in' => $param['picture_in'],
				'created_at' => $param['created_at'],
				'title'      => $param['title'],
				'author'	 => $param['author']
			)
		);
		return true;
	}

	/**
	 * 修改资料
	 *
	 *
	 */
	public function hillwater_editor($param){
		$data = DB::table('hillwater')->where('id',$param['id'])
						->update(array(
							'verse' 	 => $param['verse'],
							'tag'   	 => $param['tag'],
							'analyses'   => $param['analyses'],
							'place'   	 => $param['place'],
							'picture' 	 => $param['picture'],
							'updated_at' => $param['updated_at'],
							'title'      => $param['title'],
							'author'	 => $param['author']
						 ));
		return $data;
	}
}