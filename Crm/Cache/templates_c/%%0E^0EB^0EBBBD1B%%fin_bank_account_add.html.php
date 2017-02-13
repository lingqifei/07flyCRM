<?php /* Smarty version 2.6.26, created on 2016-12-13 18:09:23
         compiled from fin_bank_account/fin_bank_account_add.html */ ?>
<div class="pageContent">
	<form method="post" action="<?php echo @ACT; ?>
/FinBankAccount/fin_bank_account_add/type/<?php echo $this->_tpl_vars['type']; ?>
/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<div class="pageFormContent" layoutH="56">
			<p>
				<label>名称：</label>
				<input name="name" class="required" type="text" size="30" value="" alt="请输名称"/>
			</p>
			<p>
				<label>卡号：</label>
				<input name="card" class="required" type="text" size="30" value=""/>
			</p>
			<p>
				<label>开户人：</label>
				<input name="holders" class="required" type="text" size="30" value=""/>
			</p>
			<p>
				<label>开户行地址：</label>
				<input name="address" class="required" type="text" size="30" value=""/>
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