<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Tool\Msg;
use App\Http\Tool\Filter;
use DB;
class Admin_Content_Model extends Model{
	static public function check_param($param){

		return true;
	}
	static public function check_p($param){

		return true;
	}
	/**
	 * 修改资料
	 *
	 */
	public function admin_content_edite($clean){
		$data = DB::table('main')->where('id',$clean['id'])
						 ->update(array(
						 	'title'  => $clean['title'],
						 	'tag'    => $clean['tag'],
						 	'file'   => $clean['file'],
						 	'main_img' 	 => $clean['img'],
						 	'href'   => $clean['url'],
						 	'about'  => $clean['about']
						 ));
		return $data;
	}

	/**
	 * 增加资料
	 *
	 *
	 */
	public function admin_content_add($param){
		$data = DB::table('main')->insert(
			array(
				'title'   => $param['title'],
				'tag'	  => $param['tag'],
				'about'   => $param['about'],
				'created_at' => $param['created_at'],
				'main_img' => $param['img'],
				'file'     => $param['file']  
			)
		);
		return $data;
		/*if($data !== 1){
			return false;
		}
		return true;*/
	}

	/**
	 * 删除资料，暂时不删除文件夹的数据
	 *
	 *
	 */
	public function admin_content_del($param){
		$data = DB::table('main')->where('id','=',$param['id'])->delete();
		if($data !== 1){
			return false;
		}
		return true;
	}
}