<?php /* Smarty version 2.6.26, created on 2019-10-23 09:57:35
         compiled from crm/sal_contract_detail.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="ibox float-e-margins">
        <div class="ibox-title">
          <h5><i class="fa fa-home"></i>合同详细</h5>
				 <div class="ibox-tools">
				  <button type="button" class="btn btn-xs btn-primary btn-back-reply"><i class="fa fa-reply"></i> 返回</button>
				 </div>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-sm-10">
              <div class="m-b-md">
                <h3>合同编号：<?php echo $this->_tpl_vars['one']['contract_no']; ?>
</h3>
              </div>
            </div>
			  <div class="col-sm-2"><?php echo $this->_tpl_vars['one']['status_arr']['status_name_html']; ?>
</div>
          </div>
          <div class="row">
            <div class="col-sm-6">
						<div class="ibox-content ">
							<p><strong>合同标题：</strong><?php echo $this->_tpl_vars['one']['title']; ?>
</p>
							<p><strong>合同金额：</strong><?php echo $this->_tpl_vars['one']['money']; ?>
</p>
							<p><strong>去零金额：</strong><?php echo $this->_tpl_vars['one']['zero_money']; ?>
</p>
							<p><strong>回款金额：</strong><?php echo $this->_tpl_vars['one']['back_money']; ?>
</p>
							<p><strong>欠款金额：</strong><?php echo $this->_tpl_vars['one']['owe_money']; ?>
</p>
							<p><strong>开始时间：</strong><?php echo $this->_tpl_vars['one']['start_date']; ?>
</p>
							<p><strong>结束时间：</strong><?php echo $this->_tpl_vars['one']['end_date']; ?>
</p>
							<p><strong>卖家备注：</strong><?php echo $this->_tpl_vars['one']['remarks']; ?>
</p>
						</div>
            </div>
			  <div class="col-sm-6">
						<div class="ibox-content ">
							<p><strong>创建时间：</strong><?php echo $this->_tpl_vars['one']['create_time']; ?>
</p>
							<p><strong>客户名称：</strong><?php echo $this->_tpl_vars['one']['customer']['name']; ?>
</p>
							<p><strong>客户代表：</strong><?php echo $this->_tpl_vars['one']['linkman']['name']; ?>
</p>
							<p><strong>我方代表：</strong><?php echo $this->_tpl_vars['one']['our_user_arr']['name']; ?>
</p>
						</div>
            </div>
          </div>
          <div class="row m-t-sm">
            <div class="col-sm-12">
              <div class="panel blank-panel">
                <div class="panel-heading">
                  <div class="panel-options">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="?#tab-1" data-toggle="tab" >合同明细</a> </li>
                      <li class=""><a href="?#tab-2" data-toggle="tab">回款记录</a> </li>
                      <li class=""><a href="?#tab-3" data-toggle="tab">发票记录</a> </li>
                      <li class=""><a href="?#tab-4" data-toggle="tab">日志记录</a> </li>
                    </ul>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab-1">
                      <table class="table table-hover sorttable 07fly-table">
                        <thead>
                          <tr>
                            <th width="100">商品名称/商品规格</th>
                            <th width="50"><span>销售价格</span></th>
                            <th width="50"><span>数量</span></th>
                            <th width="50"><span>小计</span></th>
                            <th width="50"><span>备注</span></th>
                          </tr>
                        </thead>
                        <tbody>                     
                       </tbody>
						  		 <tfoot>
						  			<td colspan="5" class="text-right">
										<strong>商品合计：</strong><span class="text-danger">￥<?php echo $this->_tpl_vars['one']['goods_money']; ?>
</span>
									 </td>
						  		</tfoot>
                        
                      </table>
                    </div>
                    <div class="tab-pane" id="tab-2"> 功能开发中。。。 </div>
                    <div class="tab-pane" id="tab-3"> 功能开发中。。333。 </div>
                    <div class="tab-pane" id="tab-4"> 功能开发中。。444。 </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>

</body>
</html>
<script id="tab-1-Tpl" type="text/html">
<% for(var i=0;i<list.length;i++) { %>

	<tr>
		<td>
			<input type="hidden" name="sku_id[]" value="<%=list[i]['sku_id']%>">
			<input type="hidden" name="sku_name[]" value="<%=list[i]['sku_id']%>">
			<input type="hidden" name="goods_id[]" value="<%=list[i]['goods_id']%>">
			<input type="hidden" name="goods_name[]" value="<%=list[i]['goods_name']%>">
			<%=list[i]['goods_name']%>/<%=list[i]['sku_name']%></td>
		<td><%=list[i]['sale_price']%></td>
		<td><%=list[i]['num']%></td>
		<td><%=list[i]['goods_money']%></td>
		<td><%=list[i]['remarks']%></td>
	</tr>

<% } %>
</script>
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script>
<script type="text/javascript">
$(document).ready(function () {
	var tabl_index=1;
	$.ajax({
		type: "POST",
		url: "<?php echo @ACT; ?>
/crm/SalContractList/sal_contract_list_json/",
		data:{"contract_id":"<?php echo $this->_tpl_vars['one']['contract_id']; ?>
"},
		dataType:"json",
		success: function(returnJsonData){

				var tpl=baidu.template;
				var html=tpl('tab-'+tabl_index +'-Tpl',returnJsonData);
				$("#tab-"+ tabl_index +" tbody").html(html);
		},    
		complete: function() {  },
	});
	//保存数据
	$("body").on("click", ".save-data", function() {
		FormData=$("#goods_list").serialize();
		$.ajax({
			type: "POST",
			url: "<?php echo @ACT; ?>
/crm/SalContractList/sal_contract_list_add/",
			data:FormData,
			dataType:"json",
			success: function(data){
				if(data.statusCode=='200'){
					layer.msg('操作成功', {icon: 1}); 		
				}
			},    
			complete: function() {   
				setTimeout(function(){
					//关闭窗口
					var index = parent.layer.getFrameIndex(window.name); //获取窗口索引
					parent.layer.close(index);
				 },800);

   		  },
		});	
	});
	$("body").on("keyup", ".calculate", function() {
		//查询本行的数据
		var price=$(this).parent().parent().find("input[name='sale_price[]']").val();
		var num=$(this).parent().parent().find("input[name='num[]']").val();
		goods_money = parseFloat(price)*num;
		var goods_money=$(this).parent().parent().find("input[name='goods_money[]']").val(goods_money.toFixed(2));
		
		//计算所有表单的总金额
		var total_goods_money=0;
		$(this).parent().parent().parent().find("input[name='goods_money[]']").each(function(){
			total_goods_money += parseFloat($(this).val());
		});
		$('.total_goods_money').html(total_goods_money.toFixed(2));
	});	

		//统计总金额
	var total_goods_money=0;
	$("#list-table tbody tr").find("input[name='goods_money[]']").each(function(){ 
		total_goods_money += parseFloat($(this).val());
	});	
	$('.total_goods_money').html(total_goods_money.toFixed(2));

});
function delTr(obj){
	$(obj).parent().parent().remove(); 
}
</script>