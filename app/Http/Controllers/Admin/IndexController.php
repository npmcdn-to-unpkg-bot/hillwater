<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin_Controller;
use App\Behavior\Admin_Behavior;
use App\Model\Admin_Content_Model;
use App\Http\Tool\Filter;
use App\Http\Tool\Msg;
use App\Http\Tool\UploadFile;
use App\Http\Tool\FileUpload;
use DB;
use Input;
class IndexController extends Admin_Controller{
	const SUCCESS = 0;
	const ERR = 100000;
	/**
	 * 根据id 查询
	 * @example admin_get_content_detai
	 * @param int id // secret = id
	 * @return array 
	 */
	public function admin_get_content_detai(){
		//参数检查
		$this->param_isset('GET',array('id','secret'));

		//过滤
		$clean['id'] = (int)$_GET['id'];
		$clean['secret'] = Filter::get_str($_GET['secret']);
		if(!Admin_Content_Model::check_param($clean)){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		//判断，如果为空
		$B = new Admin_Behavior();
		$re = $B->admin_get_content_detai($clean['id']);
		if($re === false){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		//成功 数据返回给前端
		$this->ajax_return($re,'SUCCESS',self::SUCCESS);
	}

	/**
	 * 根据id secret 修改
	 * @example admin_content_edite
	 * @param
	 * @return bool 
	 */
	public function admin_content_edite(){
		//参数检查
		//$this->param_isset('POST',array('title','img','about','file','tag','id','url'));
		//过滤
	
		$clean['title']  = Filter::get_str($_POST['title']);
		$clean['img']    = Filter::get_str($_POST['old_img']);
		$clean['about']  = Filter::get_str($_POST['about']);
		$clean['file']   = Filter::get_str($_POST['old_rar']);
		$clean['tag']    = Filter::get_str($_POST['tag']);
		$clean['id']     = Filter::get_str($_POST['id']);
		
		if(Input::hasFile('img')){
			$clean['img']  = Input::file('img')->getClientOriginalName();
			Input::file('img')->move("./IMG/",$clean['img']);
		}
		if(Input::hasFile('rar')){
			$clean['file'] = Input::file('rar')->getClientOriginalName();
			Input::file('rar')->move("./all/".$clean['id'],$clean['file']);
			$zip = new \ZipArchive;

			//print_r($zip->open('./all/'.$clean['id']."".$clean['file']));
			//$open = $zip->open("./all/".$clean['id']."/".$clean['file']);
			//var_dump($open);
			//var_dump("./all/".$clean['id']."/".$clean['file']);
			if($zip->open("./all/".$clean['id']."/".$clean['file']) === true){
				//var_dump('123true');
				$what = $zip->extractTo("./all/".$clean['id']);
				//var_dump($what);
				$zip->close();
			}else{
				$this->ajax_return(null,'上传失败！',self::ERR + __LINE__);
			}

		}
		$clean['url'] = $clean['img'];

		if(!Admin_Content_Model::check_p($clean)){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		$M = new Admin_Content_Model();
		$re = $M->admin_content_edite($clean);
		//var_dump($re);
		if($re !== 1){
			$this->ajax_return ($re,'error',self::ERR + __LINE__);
		}
		$this->ajax_return($re,'SUCCESS',self::SUCCESS);		
	}

	/**
	 * 删除数据 id 
	 * @example admin_content_del
	 * @param
	 * @return bool 
	 */
	public function admin_content_del(){
		//参数检查
		//$this->param_isset('POST',array('id'));
		$clean['id'] = (int)Filter::get_str($_POST['id']);
		$clean['sercet'] = '123123123123';

		$M = new Admin_Content_Model();
		$re = $M->admin_content_del($clean);
		//var_dump($re);
		if($re === false){
			$this->ajax_return($re,null,self::ERR + __LINE__);
		}
		$this->ajax_return($re,null,self::SUCCESS);
	}

	/**
	 * 增加数据 id 自增
	 * @example admin_content_add
	 * @param
	 * @return bool 
	 */
	public function admin_content_add(){
		//参数检查
		$this->param_isset('POST',array('title','about','tag'));

		$clean['title']  = Filter::get_str($_POST['title']);
		$clean['tag']    = Filter::get_str($_POST['tag']);
		$clean['about']  = Filter::get_str($_POST['about']);
		$clean['created_at'] = time();
	
		if(Input::hasFile('pic')){
			$clean['img']  = Input::file('pic')->getClientOriginalName();
			Input::file('pic')->move("./IMG/",$clean['img']);
		}
		if(!Input::hasFile('zip')){
			$this->ajax_return(null,'上传失败！up error',self::ERR + __LINE__);
		}
		if(!Input::hasFile('pic')){
			$this->ajax_return(null,'上传失败！',self::ERR + __LINE__);
		}
		if(Input::hasFile('zip')){
			$clean['file'] = Input::file('zip')->getClientOriginalName();
			Input::file('zip')->move("./all/".$clean['created_at'],$clean['file']);
			$zip = new \ZipArchive;

			//print_r($zip->open('./all/'.$clean['id']."".$clean['file']));
			//$open = $zip->open("./all/".$clean['id']."/".$clean['file']);
			//var_dump($open);
			//var_dump("./all/".$clean['id']."/".$clean['file']);
			if($zip->open("./all/".$clean['created_at']."/".$clean['file']) === true){
				//var_dump('123true');
				$what = $zip->extractTo("./all/".$clean['created_at']);
				//var_dump($what);
				$zip->close();
			}else{
				$this->ajax_return(null,'上传失败！',self::ERR + __LINE__);
			}

		}
		//var_dump($clean);
		if(!Admin_Content_Model::check_p($clean)){
			$this->ajax_return(null,Msg::pop(),self::ERR + __LINE__);
		}

		$M = new Admin_Content_Model();
		$re = $M->admin_content_add($clean);
		//var_dump($re);
		if($re === false){
			$this->ajax_return($re,'error',self::ERR + __LINE__);
		}
		$this->ajax_return ($re,'success',self::SUCCESS);	
	}
	/*****/
public function demo(){



    	var_dump($_FILES);
   
if(Input::hasFile('bbs')){
			$clean['img']  = Input::file('bbs')->getClientOriginalName();
			Input::file('bbs')->move("./upload/",$clean['img']);
			$this->ajax_return ($clean['img'],'',"");
		}
  

    /*if(file_exists("./upload/" . $_FILES["file_data"]["name"]))
      {
      	//var_dump($_FILES["file_data"]["name"]);
     // echo $_FILES["file_data"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file_data"]["tmp_name"],
      "./upload/" . $_FILES["file_data"]["name"]);
      $this->ajax_return($_FILES["file_data"]["name"],null,null);
      }*/

}
}