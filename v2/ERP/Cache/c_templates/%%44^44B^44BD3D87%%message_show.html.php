<?php /* Smarty version 2.6.26, created on 2019-11-18 18:15:09
         compiled from sysmanage/message_show.html */ ?>
<!DOCTYPE html>
<html>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row">
		<div class="col-sm-12">
			<div class="ibox float-e-margins">
				<div class="ibox-title">
					<h5><i class="fa fa-home"></i>消息通知</h5>
					<div class="ibox-tools"> <a href="?" class="btn btn-xs btn-danger"><i class="fa fa-refresh"></i>刷新</a> </div>
				</div>
				<div class="ibox-content">
					<div class="row">
            <form id="pagerForm" method="post" class="form-inline">
              <div class="col-sm-3 m-b-xs"> 
				  		<a class="btn btn-info batch_operation" data-act="read" href="javascript:void(0)"><i class="fa fa-eye"></i>标记已读</a>
				  		<a class="btn btn-danger batch_operation" data-act="del" href="javascript:void(0)"><i class="fa fa-remove"></i>批量删除</a>
              </div>
              <div class="col-sm-9 m-b-xs text-right">
				  		<div class="input-group pd-b-5">
                  <input type="text" name="keywords" placeholder="输入主题关键字搜索" class="form-control">
				  		</div>
                <div class="input-group">
                  <span class="input-group-btn">
                  <button type="button" class="btn btn-primary ajaxSearchForm"><i class="fa fa-search"></i> 搜索</button>
                  </span> </div>
              </div>
            </form>
          </div>
					<table class="table table-hover sorttable 07fly-table" width="100%">
						<thead>
							<tr>
								<th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
								<th width="200">消息类型</th>
								<th>提醒内容</th>
								<th width="200">提醒时间</th>
								<th width="200">创建时间</th>
								<th width="120">状态</th>
								<th width="80">操作</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
						<tfoot class="ibox-content">
							<tr>
								<td colspan="11" align="center"></td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script id="tableListTpl" type="text/html">
<% for(var i=0;i<list.length;i++) { %>
	<tr>
		<td><input name="message_id" class="checkboxCtrlId" value="<%=list[i]['id']%>" type="checkbox"></td>
		<td><%=list[i]['msg_type']%></td>
		<td><a href="javascript:void(0)" class="single_operation" data-url="<%=list[i]['url']%>" data-act="view"><%=list[i]['msg_title']%></a></td>
		<td><%=list[i]['remind_time']%></td>
		<td><%=list[i]['create_time']%></td>
		<td><%:=list[i]['flag_arr']['flag_name_html']%></td>
		<td>
		<p><a href="javascript:void(0)" class="single_operation" data-id="<%=list[i]['id']%>" data-act="del">删除</a></p>
		</td>
	</tr>
<% } %>
</script> 
<script src="<?php echo @APP; ?>
/View/template/js/content.js?v=1.0.0"></script>
<script type="text/javascript">
var ajaxUrl='<?php echo @ACT; ?>
/sysmanage/Message/message_show_json/';
$(document).ready(function () {
	turnPage(1);//页面加载时初始化分页

	$("body").on("click", ".batch_operation", function() {
		batch_act =$(this).attr("data-act")
		var chk_value =[]; 
    	$("tbody input[class='checkboxCtrlId']:checked").each(function(){ 
        chk_value.push($(this).val()); 
		}); 
		message_id_txt=chk_value.join(",");
		if(batch_act=="del"){
			act_url="<?php echo @ACT; ?>
/sysmanage/Message/message_del/";
			$.ajax({
				type: "POST",
				url: act_url,
				data:{"message_id":message_id_txt},
				dataType:"json",
				success: function(data){
					if(data.statusCode=='200'){
						layer.msg('操作成功', {icon: 1}); 
						turnPage(1);
					}
				},
				complete: function () {//完成响应
				}
			});
		}else if(batch_act=="read"){
			act_url="<?php echo @ACT; ?>
/sysmanage/Message/message_read/";
			$.ajax({
				type: "POST",
				url: act_url,
				data:{"message_id":message_id_txt},
				dataType:"json",
				success: function(data){
					if(data.statusCode=='200'){
						layer.msg('操作成功', {icon: 1}); 
						turnPage(1);
					}
				},
				complete: function () {//完成响应
				}
			});
		}
	});
	
	$("body").on("click", ".single_operation", function() {
		message_id =$(this).attr("data-id");
		single_act =$(this).attr("data-act")
		single_url =$(this).attr("data-url")
		if(single_act=="view"){
			layer.open({
				type: 2,
				title: '查看通知',
				shadeClose: true,
				fixed: false, //不固定
				area: ['90%', '90%'],
				content: single_url
			});			
			return false;	
		}else if(single_act=="del"){
			act_url="<?php echo @ACT; ?>
/sysmanage/Message/message_del/";
			$.ajax({
				type: "POST",
				url: act_url,
				data:{"message_id":message_id},
				dataType:"json",
				success: function(data){
					if(data.statusCode=='200'){
						layer.msg('操作成功', {icon: 1}); 
						turnPage(1);
					}
				}
			});
		}

	});
	
	
});
</script> 
</body>

<!-- Mirrored from www.upfine.cn/theme/hplus/table_basic.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:20:01 GMT -->
</html>