<?php
namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Home_Controller;
use App\Content;
use DB;
use App\Model\Index_Content_Model;
use App\Behavior\Home_Behavior;
use App\Http\Tool\Msg;
use App\Http\Tool\Filter;

class IndexController extends Home_Controller{
	const SUCCESS = 0;
	const ERR = 100000;

	/**
	 * 根据标签查询
	 * @example tag_search
	 * @param string $tag
	 * @return array
	 */
	public function tag_search(){
		//参数过滤
		$this->param_isset('GET',array('tag','skip','take'));
		
		//将$clean 参数进行过滤
		$clean['tag'] = $_GET['tag'];
		$clean['skip'] = (int)$_GET['skip'];
		$clean['take'] = (int)$_GET['take'];
		if($clean['skip'] !== 0){
			$clean['skip'] = ($clean['skip']-1)*5;
		}
		//$clean['param_search'] = $_GET['']
		//$a = $this->param_isset('GET',array('pag','aaa','display'));
		if(!Index_Content_Model::check_param($clean)){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		//判断，如果为空
		$B = new Home_Behavior();
		$re = $B->tag_search($clean['tag'],$clean['skip'],$clean['take']);
		if($re === false){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		//成功 返回数据给前端
		$this->ajax_return($re,'SUCCESS',self::SUCCESS);
	}
	/**
	 * 获取数据count
	 * @example get_all_count 
	 * @return count
	 */
	public function get_all_count(){
		//获取全部数据/5 省略而成的条数
		$B = new Home_Behavior();
		$re = $B->get_all_count();
		if($re === false){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}
		
		//成功,返回JSON给前端
		$this->ajax_return($re,'SUCCESS',self::SUCCESS);
	}
	/**
	 * 获取全部数据
	 * @example admin_get_all
	 * @return json
	 */
	public function admin_get_all(){
		$arr = DB::table("main")->get();
		$this->ajax_return($arr,'success',self::SUCCESS);
	}
	/**
	 * 获取首页数据
	 * @example get_index_content
	 * @param int $clean['skip'] 起始条数 int $clean['take'] 拿几条
	 * @return json
	 */
	public function get_index_content(){
		//默认设定首页取前0-5条
		$clean['skip'] = 0;
		$clean['take'] = 5;

		//将$clean 参数进行过滤
		if(!Index_Content_Model::check_param($clean)){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		//获取数据
		$B = new Home_Behavior();
		$re = $B->get_index_content($clean['skip'],$clean['take']);
		if($re === false){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		//成功。向前端返回JSON
		$this->ajax_return($re,'SUCCESS',self::SUCCESS);
	}
	/**
	 * 获取分页数据
	 * @example get_content
	 * @param int $page int $count
	 * @return json
	 */
	public function get_content(){	
		//检查参数
		$this->param_isset('GET',array('page','display'));
	
		//参数过滤
		$page = (int)$_GET['page'];
		$clean['count'] = (int)$_GET['display'];
		$clean['page']  = ($page-1)*5;
		if(!Index_Content_Model::check_param($clean)){
			$this->ajax_return(null,pop(),self::ERR + __LINE__);
		}

		//获取数据
		$B = new Home_Behavior();
		$re = $B->get_limit_content($clean['page'],$clean['count']);
		if($re === false){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}
		
		//成功。向前端返回JSON
		$this->ajax_return($re,'SUCCESS',self::SUCCESS);
	}

	public function get_tag_all_count(){
		//获取全部数据/5 省略小数点而成的条数
		$B = new Home_Behavior();
		$re = $B->get_tag_all_count();
		if($re === false){
			$this->ajax_return(null,Msg::pop(),self::ERR +__LINE__);
		}

		//层高，返回JSON给前端
		$this->ajax_return($re,'SUCCESS',self::SUCCESS);
	}
}