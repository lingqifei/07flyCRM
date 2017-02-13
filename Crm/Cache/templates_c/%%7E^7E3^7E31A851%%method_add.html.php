<?php /* Smarty version 2.6.26, created on 2016-11-21 17:30:01
         compiled from method/method_add.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/Method/method_add/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>方法名称：</label>
				<input name="name" class="required" type="text" size="30" value="栏目名称" alt="请输栏目中文名称"/>
			</p>
			<p>
				<label>关键标签：</label>
				<input name="value" class="required" type="text" size="30" value="链接地址" alt="请输链接地址"/>
			</p>
			<p>
				<label>所以栏目：</label>
				<?php echo $this->_tpl_vars['menuID']; ?>


			</p>
			<p>
				<label>排位序号：</label>
				<input type="text" value="" name="sort" class="required digits">
			</p>
			<p>
				<label>是否启用：</label>
				<input type="checkbox" name="visible" value="1" />
			</p>
		</div>
		<div class="formBar">
			<ul>
				<!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
				<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				<li>
					<div class="button"><div class="buttonContent"><button type="button" class="close">取消</button></div></div>
				</li>
			</ul>
		</div>
	</form>
</div>