<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Http\Tool\Msg;
use App\Http\Tool\Filter;
use DB;
class Index_Content_Model extends Model
{
    
    protected $table = 'main';

    static public function demo(){
    	Msg::push('12345552');
    	return false;
    }
    static public function get_index_content($skip,$take){
    	$data = DB::table('main')->skip($skip)->take($take)->get();
    	return $data;
    }
    static public function check_param($param){
    	if(isset($param['skip'])){
    		if(!is_int($param['skip'])){
    			Msg::push('something wrong in param skip');
    			return false;
    		}
    		/*if(!Filter::check_str($param['skip'],Filter::RG_MD5)){
    			$a = Filter::check_str($param['skip'];
    			Msg::push(Filter::check_str($param['skip']);
    			return false;
    		}*/
    	}
    	if(isset($param['take'])){
    		if(!is_int($param['take'])){
    			Msg::push('something wrong in param take');
    			return false;
    		}
    	}
    	return true;
    }


}
