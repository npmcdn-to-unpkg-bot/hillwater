<?php
namespace App\Behavior;

use DB;
use App\Http\Tool\Msg;
class Home_Behavior extends Behavior{
	/**
	 * 返回首页数据
	 * @param $skip(起始条数) $take(拿几条)
	 * @return array
	 */
	public function get_index_content($skip,$take){
		$data = DB::table('main')->skip($skip)->take($take)->get();
		if(empty($data)){
			Msg::push('没有内容,请确认输入是否正确(no content)');
			return false;
		}
    	return $data;
	}

	/**
	 * 返回首页数据的count
	 * @param $page(页码) $count(拿多少条)
	 * @return array
	 */
	public function get_limit_content($page,$count){
		$data = DB::table('main')->skip($page)->take($count)->get();
		if(empty($data)){
			Msg::push('没有数据，没有条数(no content count)');
			return false;
		}
		return $data;
	}

	/**
	 * 获取总数据count
	 * @return $count
	 */
	public function get_all_count(){
		$count = ceil(count(DB::table('main')->get())/5);
		if(empty($count)){
			Msg::push('没有数据，没有条数(no all count)');
			return false;
		}
		return $count;
	}

	/**
	 * 获取tag查询的总条数
	 * @return $count
	 */
	public function get_tag_all_count(){
		$tag = $_GET['tag'];
		//先拿到全部数据的 tag 字段 id 字段
		$data = DB::table('main')->lists('tag','id');
		$arr = array();
		foreach($data as $k=>$v){
			if(strstr($v,$tag) !== false){
				$arr[] = $k;
			}
		};

		//返回数据
		$re = DB::table('main')->whereIn('id',$arr)->get();
		if(empty($re)){
			Msg::push('没有数据,此标签下面没有数据(this tag no content)');
			return false;
		}

        //除以5
        $count = ceil(count($re)/5);
        return $count;
	}

	/**
	 * @根据标签查询数据
	 * @param $tag
	 * @return array
	 */
	public function tag_search($_tag,$_skip,$_take){
		$tag = $_tag;
		$skip = $_skip;
		$take = $_take;
		//先拿到全部数据的 tag字段 id字段
		$data = DB::table('main')->lists('tag','id');
		$arr = array();
		foreach($data as $k=>$v){
			if(strstr($v,$tag) !== false){
				$arr[] = $k;
			}
		};
		
		//返回数据
		$re = DB::table('main')->whereIn('id',$arr)
							   ->skip($skip)
	                           ->take($take)
                               ->get();
        if(empty($re)){
        	Msg::push('没有数据,此标签下面没有数据(this tag no content)');
        	return false;
        }
        return $re;
	}
}