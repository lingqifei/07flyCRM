<?php	 
/*
 * 店铺分类管理
 */	 
 /*
 *
 * admin.ShopType  店铺分类管理   
 *
 * =========================================================
 * 零起飞网络 - 专注于网站建设服务和行业系统开发
 * 以质量求生存，以服务谋发展，以信誉创品牌 !
 * ----------------------------------------------
 * @copyright	Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
 * @license    For licensing, see LICENSE.html or http://www.07fly.xyz/crm/license
 * @author ：kfrs <goodkfrs@QQ.com> 574249366
 * @version ：1.0
 * @link ：http://www.07fly.xyz 
 */	
class ShopType extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/sysmanage/Auth');
	}	
	
	public function shop_type(){
		$where_str = "id != 0";
		if( !empty($bdt) ){
			$where_str .=" and adt >= '$bdt'";
		}			
		if( !empty($edt) ){
			$where_str .=" and adt < '$edt'";
		}	
		$sql		 = "select * from fly_shop_type  where $where_str order by sort asc";	
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		$assignArray = array('list'=>$list);	
		return $assignArray;
	}
	public function shop_type_show(){
		$assArr  = $this->shop_type();
		$smarty  = $this->setSmarty();
		$smarty->assign($assArr);
		$smarty->display('admin/shop_type_show.html');	
	}
		
	public function search(){
		$smarty  = $this->setSmarty();
		$smarty->display('shop_type/search.html');	
	}	
	public function shop_type_lookup_search(){
			$assArr  		= $this->shop_type();
			$smarty  		= $this->setSmarty();
			$smarty->assign($assArr);
			$smarty->display('admin/shop_type_lookup_search.html');	
	}	
	
	//增加
	public function shop_type_add(){
		if(empty($_POST)){
			$smarty = $this->setSmarty();
			$smarty->display('admin/shop_type_add.html');	
		}else{
			$typename	  = $this->_REQUEST("typename");
			$typedir	  = $this->_REQUEST("typedir");
			$typetag	  = $this->_REQUEST("typetag");
			$sort		  = $this->_REQUEST("sort");
			$seotitle	  = $this->_REQUEST("seotitle");
			$keywords	  = $this->_REQUEST("keywords");
			$intro		  = $this->_REQUEST("intro");

			$sql= "insert into fly_shop_type(typename,typedir,sort,typetag,seotitle,keywords,intro) 
								values('$typename','$typedir','$typetag','$sort','$seotitle','$keywords','$intro');";
			$this->C($this->cacheDir)->update($sql);	
			$this->location("操作成功","/admin/ShopType/shop_type_show/");		
		}
	}		
	public function shop_type_modify(){
		$id	  = $this->_REQUEST("id");
		if(empty($_POST)){
			$sql 		= "select * from fly_shop_type where id='$id'";
			$one 		= $this->C($this->cacheDir)->findOne($sql);
			$smarty  	= $this->setSmarty();
			$smarty->assign(array("one"=>$one));
			$smarty->display('admin/shop_type_modify.html');	
		}else{
			$typename	  = $this->_REQUEST("typename");
			$typedir	  = $this->_REQUEST("typedir");
			$typetag	  = $this->_REQUEST("typetag");
			$sort		  = $this->_REQUEST("sort");
			$seotitle	  = $this->_REQUEST("seotitle");
			$keywords	  = $this->_REQUEST("keywords");
			$intro		  = $this->_REQUEST("intro");
			
			$sql= "update fly_shop_type set 
								typename='$typename',
								typedir='$typedir',
								typetag='$typetag',
								sort='$sort',
								seotitle='$seotitle',
								keywords='$keywords',
								intro='$intro'
					where id='$id'";
			$this->C($this->cacheDir)->update($sql);	
			$this->location("操作成功","/admin/ShopType/shop_type_show/");			
		}
	}	
	public function shop_type_del(){
		$id	  = $this->_REQUEST("ids");
		$sql  = "delete from fly_shop_type where id in ($id)";
		$this->C($this->cacheDir)->update($sql);	
		$this->location("操作成功","1","/admin/ShopType/shop_type_show/");	
	}	
	
	
	public function shop_type_get_one($id){
		$sql = "select * from fly_shop_type where id='$id'";	
		$pak = $this->C($this->cacheDir)->findOne($sql);	
		return $pak;
	}
	
	//分类下拉选择
	public function shop_type_get_opt($inputname,$value=null){
		$sql = "select * from fly_shop_type;";
		$list= $this->C($this->cacheDir)->findAll($sql);
		$string		="<select name='$inputname' id='$inputname'  class='form-control'>";
		foreach($list as $key=>$row){
			$string.="<option value='$row[id]'";
			if($row["id"]==$value) $string.=" selected";
			$string.=">".$row["typename"]."</option>";
		}
		$string.="</select>";
		return $string;
	}	
	//传入ID返回名字
	public function shop_type_get_name($id){
		if(empty($id)) $id=0;
		$sql ="select * from fly_shop_type where id in ($id)";
		$list=$this->C($this->cacheDir)->findAll($sql);
		$str ="";
		if(is_array($list)){
			foreach($list as $row){
				$str .= "".$row["typename"]."";
			}
		}
		return $str;
	}
}//
?>