<?php /* Smarty version 2.6.26, created on 2016-11-18 21:39:57
         compiled from email/email_receiver_add.html */ ?>
<div class="pageContent">
  <form method="post" action="<?php echo @ACT; ?>
/EmailSend/email_receiver_add/" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
    <div class="pageFormContent" layoutH="56">
      <p>
        <label>分组：</label>
        <?php echo $this->_tpl_vars['groupoption']; ?>

        <span class="info">&nbsp;邮件地址分组选择</span> 
      </p>
      <p>
        <label>名称：</label>
        <input type="text"  name="name" class="required"  value="" alt="请输名称"/>
        <span class="info">&nbsp;接收名称</span> 
      </p>
      <p>
        <label>地址：</label>
        <input type="text" value="" name="account" class="required">
        <span class="info">&nbsp;接收邮件地址</span> </p>
      <p>
        <label>备注：</label>
        <input type="text" value="" name="intro" class="">
        <span class="info">&nbsp;备注说明</span> </p>
        <p> <span class="info">说明：地址说明</span></p>
    </div>
    <div class="formBar">
      <ul>
        <!--<li><a class="buttonActive" href="javascript:;"><span>保存</span></a></li>-->
        <li>
          <div class="buttonActive">
            <div class="buttonContent">
              <button type="submit">保存</button>
            </div>
          </div>
        </li>
        <li>
          <div class="button">
            <div class="buttonContent">
              <button type="button" class="close">取消</button>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </form>
</div>