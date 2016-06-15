<?php
namespace App\Http\Controllers\Hillwater;

use App\Http\Controllers\Hillwater_Controller;
use App\Model\Hillwater_Model;
use App\Behavior\Hillwater_Behavior;
use App\Http\Tool\Filter;
use App\Http\Tool\Msg;
use DB;
class IndexController extends Hillwater_Controller{
	const SUCCESS = 0;
	const ERR = 100000;
	/**
	 * 增加数据 id 自增
	 * @example hillwater_content_add
	 * @param verse诗词歌赋 tag分类 analyses评析 place名胜古迹 picture图片 picture_in图片文件夹
	 * @return array 
	 */
	public function hillwater_content_add(){
		//参数检查
		
		$this->param_isset('POST',array('title','verse','tag','analyses','place','picture','picture_in'));	
		//过滤
		$clean['verse'] = $_POST['verse'];
		$clean['tag'] = Filter::get_str($_POST['tag']);
		$clean['analyses'] = Filter::get_str($_POST['analyses']);
		$clean['place'] = Filter::get_str($_POST['place']);
		$clean['picture'] = Filter::get_str($_POST['picture']);
		$clean['picture_in'] = $_POST['picture_in'];
		$clean['created_at'] = time();
		$clean['title'] = Filter::get_str($_POST['title']);
		$clean['author'] = Filter::get_str($_POST['author']);

		//var_dump($clean['picture']);
		//$this->ajax_return($clean['picture'],Msg::pop(),self::ERR + __LINE__);


		//$this->ajax_return($clean,'success',null);
		//$clean
		if(!Hillwater_Model::check_param($clean)){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		//判断数据是否进库
		$M  = new Hillwater_Model();
		$re = $M->hillwater_content_add($clean);
		//var_dump($re);
		if($re !== true){
			$this->ajax_return($re,'error',self::ERR + __LINE__);
		}
		$this->ajax_return($re,'success',self::SUCCESS);
	}

	/**
	 * 根据id修改数据
	 * @example hillwater_editor
	 * @param verse诗词歌赋 tag分类 analyses评析 place名胜古迹 picture图片(只传字段) updated_at更新时间
	 *        //picture_in 根据图片时间戳放至图片
	 * @return array
	 */
	public function hillwater_editor(){
		//参数检查
		$this->param_isset('POST',array('id','title','verse','tag','analyses','place','picture'));
		//过滤
		$clean['verse'] = $_POST['verse'];
		$clean['tag'] = Filter::get_str($_POST['tag']);
		$clean['analyses'] = Filter::get_str($_POST['analyses']);
		$clean['place'] = Filter::get_str($_POST['place']);
		$clean['picture'] = Filter::get_str($_POST['picture']);
		$clean['id'] = (int)$_POST['id'];
		$clean['title'] = Filter::get_str($_POST['title']);
		$clean['updated_at'] = time();
		$clean['author'] = Filter::get_str($_POST['author']);

		//检查规则
		if(!Hillwater_Model::check_param($clean)){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		//判断是否进库
		$M = new Hillwater_Model();
		$re = $M->hillwater_editor($clean);
		var_dump($re);
		if($re !== 1){
			$this->ajax_return($re,'error in editor',self::ERR + __LINE__);
		}
		$this->ajax_return($re,'success',self::SUCCESS);
	}

	/**
	 * 获取资料
	 *
	 *
	 */
	public function hillwater_get(){

		$id = (int)$_GET['where'];
		$data = DB::table('hillwater')->where('id',$id)->first();

		if($data === false){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		$this->ajax_return($data,'success',self::SUCCESS);
	}
	/**
	 * 删除资料
	 *
	 *
	 *
	 */
	public function hillwater_del(){
		//参数检查
		$this->param_isset('POST',array('id'));

		$clean['id'] = (int)Filter::get_str($_POST['id']);

		$data = DB::table('hillwater')->where('id','=',$clean['id'])->delete();
		if($data !== 1){
			$this->ajax_return(null,'删除失败',self::ERR + __LINE__);
		}
		$this->ajax_return(null,'删除成功',self::SUCCESS);
	}
	/**
	 * 全部资料获取
  	 *
	 *
	 */
	public function hillwater_all_get(){
		$data = DB::table('hillwater')->get();
		
		$this->ajax_return($data,'success',self::SUCCESS);
	}
}