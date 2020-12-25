<?php
/*
 * 开票记录类
 *
 * @copyright   Copyright (C) 2017-2018 07FLY Network Technology Co,LTD (www.07FLY.com) All rights reserved.
 * @license     For licensing, see LICENSE.html or http://www.07fly.xyz/crm/license
 * @author      kfrs <goodkfrs@QQ.com>
 * @package     admin.Book
 * @version     1.0
 * @link       http://www.07fly.xyz
 */	 
class FinInvoicePay extends Action{	
	private $cacheDir='';//缓存目录
	public function __construct() {
		_instance('Action/sysmanage/Auth');
		$this->bank=_instance('Action/erp/FinBankAccount');
		$this->sys_user=_instance('Action/sysmanage/User');
		$this->customer=_instance('Action/crm/CstCustomer');
		$this->contract=_instance('Action/crm/SalContract');
		$this->flow=_instance('Action/erp/FinFlowRecord');
	}	
	
	public function fin_invoice_pay($id=null){
		//**获得传送来的数据作分页处理
		$pageNum = $this->_REQUEST("pageNum");//第几页
		$pageSize= $this->_REQUEST("pageSize");//每页多少条
		$pageNum = empty($pageNum)?1:$pageNum;
		$pageSize= empty($pageSize)?$GLOBALS["pageSize"]:$pageSize;
		
		$contract_id 	= $this->_REQUEST("contract_id");
		$customer_id 	= $this->_REQUEST("customer_id");
		$pay_date		= $this->_REQUEST("pay_date");
		$create_date	= $this->_REQUEST("create_date");		
		$customer_name	= $this->_REQUEST("customer_name");
		$contract_name	= $this->_REQUEST("contract_name");	
		
		$where_str	 =" record_id>0 ";
		if($contract_id){
			$where_str .=" and contract_id='$contract_id'";
		}
		if($customer_id){
			$where_str .=" and customer_id='$customer_id'";
		}
		if(!empty($customer_name)){
			$where_str	.= " and customer_name like '%$customer_name%'";
		}
		if(!empty($contract_name)){
			$where_str	.= " and contract_name like '%$contract_name%'";
		}
		
		//到期时间
		if( !empty($pay_date) ){
			switch($pay_date){
				case '3d' :
					$date_range=date('Y-m-d',strtotime("-3 day",time()));
					break;
				case '7d' :
					$date_range=date('Y-m-d',strtotime("-7 day",time()));
					break;
				case '15d' :
					$date_range=date('Y-m-d',strtotime("-15 day",time()));	
					break;
				case '1m' :
					$date_range=date('Y-m-d',strtotime("-1 month",time()));	
					break;
				case '3m' :
					$date_range=date('Y-m-d',strtotime("-3 month",time()));	
					break;
				case '6m' :
					$date_range=date('Y-m-d',strtotime("-6 month",time()));	
					break;
				case '12m' :
					$date_range=date('Y-m-d',strtotime("-12 month",time()));	
					break;
			}
			$where_str .=" and pay_date>'$date_range'";
		}
		//创建日期
		if( !empty($create_date) ){
			switch($create_date){
				case '3d' :
					$date_range=date('Y-m-d',strtotime("+3 day",time()));
					break;
				case '7d' :
					$date_range=date('Y-m-d',strtotime("+7 day",time()));
					break;
				case '15d' :
					$date_range=date('Y-m-d',strtotime("+15 day",time()));	
					break;
				case '1m' :
					$date_range=date('Y-m-d',strtotime("+1 month",time()));	
					break;
				case '3m' :
					$date_range=date('Y-m-d',strtotime("+3 month",time()));	
					break;
				case '6m' :
					$date_range=date('Y-m-d',strtotime("+6 month",time()));	
					break;
				case '12m' :
					$date_range=date('Y-m-d',strtotime("+12 month",time()));	
					break;
					
			}
			$where_str .=" and create_time<'$date_range'";
		}
		//排序操作
		$orderField = $this->_REQUEST("orderField");
		$orderDirection = $this->_REQUEST("orderDirection");
		$order_by="order by";
		if( $orderField=='by_recedate' ){
			$order_by .=" pay_date $orderDirection";
		}else if( $orderField=='by_customer' ){
			$order_by .=" customer_id $orderDirection";
		}else{
			$order_by .=" record_id desc";
		}	
		
		$countSql    = "select record_id from fin_invoice_pay where $where_str";
		$totalCount  = $this->C($this->cacheDir)->countRecords($countSql);	//计算记录数
		$beginRecord = ($pageNum-1)*$pageSize;
		
		$moneySql    = "select sum(money) as total_money from fin_invoice_pay where $where_str";
		$moneyRs	 = $this->C($this->cacheDir)->findOne($moneySql);
		
		$sql		 = "select * from fin_invoice_pay where $where_str $order_by limit $beginRecord,$pageSize";
		$list		 = $this->C($this->cacheDir)->findAll($sql);
		if(is_array($list)){
			foreach($list as $key=>$row){
				$list[$key]['create_user_arr']	=$this->sys_user->user_get_one($row['create_user_id']);
				$list[$key]['customer']	=$this->customer->cst_customer_get_one($row['customer_id']);
				$list[$key]['contract']	=$this->contract->sal_contract_get_one($row['contract_id']);
			}
		}
		$assignArray = array('list'=>$list,"pageSize"=>$pageSize,"totalCount"=>$totalCount,"pageNum"=>$pageNum,"countMoney"=>$moneyRs);	
		return $assignArray;
	}

	public function fin_invoice_pay_json(){
		$list	 = $this->fin_invoice_pay();
		echo json_encode($list);	
	}	

	public function fin_invoice_pay_show(){
		$smarty  = $this->setSmarty();
		$smarty->display('erp/fin_invoice_pay_show.html');	
	}		


	public function fin_invoice_pay_add(){
		$customer_id= $this->_REQUEST("customer_id");
		if(empty($_POST)){
			$customer=$this->customer->cst_customer_list();
			$bank=$this->bank->fin_bank_accoun_select();
			$smarty = $this->setSmarty();
			$smarty->assign(array("customer_id"=>$customer_id,"customer"=>$customer,"bank"=>$bank));
			$smarty->display('erp/fin_invoice_pay_add.html');	
		}else{
			$customer_id=$this->_REQUEST("customer_id");
			$contract_id=$this->_REQUEST("contract_id");
			
			$contract_money =$this->_REQUEST("contract_money");
			$contract_pay_money =$this->_REQUEST("contract_pay_money");
			$contract_zero_money =$this->_REQUEST("contract_zero_money");
			$contract_owe_money =$this->_REQUEST("contract_owe_money");
			$contract_invoice_money =$this->_REQUEST("contract_invoice_money");
			
			$invoice_money =$this->_REQUEST("invoice_money");
			$pay_date =$this->_REQUEST("pay_date");
			$stages =$this->_REQUEST("stages");
			$intro =$this->_REQUEST("intro");
			if(empty($customer_id) || empty($contract_id)){
				$this->L("Common")->ajax_json_error("选择供应商和采购合同");
				return false;
			}
			if(empty($invoice_money)){
				$this->L("Common")->ajax_json_error("收票的金额不能为0");
				return false;
			}
			$owe_invoice_money=$contract_money-$contract_invoice_money;
			if($owe_invoice_money<$invoice_money){
				$this->L("Common")->ajax_json_error("本次收票的金额不能超过 $owe_invoice_money");
				return false;				
			}
			$into_data=array(
				'customer_id'=>$customer_id,
				'customer_name'=>$this->_REQUEST("customer_name"),
				'contract_name'=>$this->_REQUEST("contract_name"),
				'contract_id'=>$contract_id,
				'money'=>$invoice_money,
				'pay_date'=>$pay_date,
				'stages'=>$stages,
				'invoice_no'=>$this->_REQUEST("invoice_no"),
				'name'=>$this->_REQUEST("name"),
				'intro'=>$this->_REQUEST("intro"),
				'create_time'=>NOWTIME,
				'create_user_id'=>SYS_USER_ID,
			);
			//插入记录
			$this->C($this->cacheDir)->insert('fin_invoice_pay',$into_data);
			
			//更改采购订单状态
			$sql ="select * from sal_contract where contract_id='$contract_id'";
			$one = $this->C($this->cacheDir)->findOne($sql);
			if($one){
				$contract_money		=$one["money"];
				$contract_invoice_money =$one["invoice_money"];
				if(($contract_invoice_money+$invoice_money)>=$contract_money){
					$invoice_status=3;//全部
				}else{
					$invoice_status=2;//部分
				}
				$upt_contract=array(
					'invoice_status'=>$invoice_status,
					'invoice_money'=>$contract_invoice_money+$invoice_money,
				);
				$this->C($this->cacheDir)->modify('sal_contract',$upt_contract,"contract_id='$contract_id'");				
			}
			//更新合同状态
			$this->contract->sal_contract_modify_status($contract_id);			
			$this->L("Common")->ajax_json_success("操作成功");	
			
		}
	}	


	public function fin_invoice_pay_del(){
		$record_id=$this->_REQUEST("record_id");
		$record_arr=explode(",",$record_id);
		foreach($record_arr as $id){
			$sql ="select * from fin_invoice_pay where record_id='$id'";
			$one = $this->C($this->cacheDir)->findOne($sql);
			$contract_id	=$one['contract_id'];
			$invoice_money	=$one['money'];

			
			//删除记录
			$this->C($this->cacheDir)->delete('fin_invoice_pay',"record_id='$id'");	
			
			//更改全同发票状态
			$sql ="select * from sal_contract where contract_id='$contract_id'";
			$con = $this->C($this->cacheDir)->findOne($sql);
			if($one){
				$contract_money			=$con["money"];
				$contract_invoice_money =$con["invoice_money"];
				$owe_invoice_money		=$contract_money-$contract_invoice_money;
				if(($owe_invoice_money+$invoice_money)>=$contract_money){
					$invoice_status=1;//要求
				}else{
					$invoice_status=2;//部分
				}
				$upt_contract=array(
					'invoice_status'=>$invoice_status,
					'invoice_money'=>$contract_invoice_money-$invoice_money
				);
				$this->C($this->cacheDir)->modify('sal_contract',$upt_contract,"contract_id='$contract_id'");
			}
			//更新合同执行状态
			$this->contract->sal_contract_modify_status($contract_id);
		}
		$this->L("Common")->ajax_json_success("操作成功");	
	}	
			
}//
?>