<?php /* Smarty version 2.6.26, created on 2017-07-18 15:59:58
         compiled from customer/customer_show.html */ ?>
<div class="pageHeader">
  <form onsubmit="return navTabSearch(this);" action="<?php echo @ACT; ?>
/Customer/customer_show/" method="post">
    <div class="searchBar">
      <table class="searchContent">
        <tr>
          <td><select class="combox" name="searchKeyword">
              <option value="name">客户名称</option>
              <option value="tel">客户电话</option>
              <option value="zipcode">邮编</option>
              <option value="address">联系地址</option>
              <option value="intro">简介</option>
            </select></td>
          <td><input type="text" name="searchValue" /></td>
          <td> 建档日期：
            <input type="text" class="date" name="bdt" size="15" readonly="true" value="<?php echo $this->_tpl_vars['bdt']; ?>
" />
            -
            <input type="text" class="date" name="edt" size="15" readonly="true" value="<?php echo $this->_tpl_vars['edt']; ?>
"  /></td>
            <td>所属行业：</td>
            <td>
            	<input name="trade.id" value="<?php echo $this->_tpl_vars['trade']; ?>
" type="hidden"/>
				<input class="required" value="<?php echo $this->_tpl_vars['trade_name']; ?>
" name="trade.name" type="text" postField="keyword" suggestFields="name" 
					suggestUrl="<?php echo @ACT; ?>
/CstDict/cst_dict_select/type/trade/" lookupGroup="trade"/></td>
            
          <td><ul>
              <li>
                <div class="buttonActive">
                  <div class="buttonContent">
                    <button type="submit">检索</button>
                  </div>
                </div>
              </li>
            </ul></td>
          <td><ul>
              <li><a class="button" href="<?php echo @ACT; ?>
/Customer/advanced_search/" target="dialog" mask="true" title="查询框"><span>高级检索</span></a></li>
            </ul></td>
        </tr>
      </table>
      <div class="subBar"></div>
    </div>
  </form>
</div>
<div class="pageContent">
  <div class="panelBar">
    <ul class="toolBar">
      <li><a class="add" href="<?php echo @ACT; ?>
/Customer/customer_add/"  rel="customer_add"  title="客户添加" target="dialog" width="850" height="450"><span>添加</span></a></li>
      <li class="line">line</li>
      <li><a class="delete" href="<?php echo @ACT; ?>
/Customer/customer_del/" postType="string" title="确实要删除这些记录吗?" target="selectedTodo" rel="ids" ><span>删除</span></a></li>
      <li class="line">line</li>
      <li><a class="edit" href="<?php echo @ACT; ?>
/Customer/customer_modify/id/{sid_user}/" rel="customer_modify" target="dialog" width="850" height="450"><span>修改</span></a></li>
      <li class="line">line</li>
      <li><a class="talk" href="<?php echo @ACT; ?>
/CstTalk/cst_talk_show/cusID/{sid_user}/" target="dialog" targetType="navTab" title="沟通记录"><span>沟通记录</span></a></li>
      <li class="line">line</li>
      <li><a class="people" href="<?php echo @ACT; ?>
/CstLinkman/cst_linkman_show/cusID/{sid_user}/"  rel="cst_linkman_show"  target="navTab" title="联系人" width="850" height="450"><span>联系人</span></a></li>
      <li class="line">line</li>
      <li><a class="pro" href="<?php echo @ACT; ?>
/CstService/cst_service_show/cusID/{sid_user}/"  rel="customer_modify"  target="navTab" title="服务记录" width="850" height="450"><span>服务</span></a></li>
      <li class="line">line</li>
      <li><a class="search" href="<?php echo @ACT; ?>
/CstService/cst_service_show/cusID/{sid_user}/"  rel="customer_modify"  target="navTab" title="服务记录" width="850" height="450"><span>服务</span></a></li>
    </ul>
  </div>
  <table class="table" width="100%" layoutH="138">
    <thead>
      <tr>
        <th width="22"><input type="checkbox" group="ids" class="checkboxCtrl"></th>
        <th width="50">编号</th>
        <th width="150">客户名称</th>
        <th width="50">联系人</th>
        <th width="100">手机</th>
        <th width="80">电话</th>
        <th width="100">沟通记录</th>
        <th width="60">等级</th>
        <th width="60">来源</th>
        <th width="60">经济类型</th>
        <th width="80">所属行业</th>
        <th width="100">主营产品</th>
        <th width="100">地址</th>
      </tr>
    </thead>
    <tbody>
    
    <?php $_from = $this->_tpl_vars['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
    <tr target="sid_user" rel="<?php echo $this->_tpl_vars['v']['id']; ?>
">
      <td><input name="ids" value="<?php echo $this->_tpl_vars['v']['id']; ?>
" type="checkbox"></td>
      <td><?php echo $this->_tpl_vars['v']['id']; ?>
</td>
      <td><a target="dialog"  href="<?php echo @ACT; ?>
/Customer/customer_show_one/cusID/<?php echo $this->_tpl_vars['v']['id']; ?>
/" rel="customer_show_one_<?php echo $this->_tpl_vars['v']['id']; ?>
" title="<?php echo $this->_tpl_vars['v']['name']; ?>
" width="980" height="480"><?php echo $this->_tpl_vars['v']['name']; ?>
</a></td>
      <td><?php echo $this->_tpl_vars['v']['linkman']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['mobile']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['tel']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['talk']; ?>
</td>
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['level']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['source']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['ecotype']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['dict'][$this->_tpl_vars['v']['trade']]; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['main_pro']; ?>
</td>
      <td><?php echo $this->_tpl_vars['v']['address']; ?>
</td>
    </tr>
    <?php endforeach; endif; unset($_from); ?>
      </tbody>
    
  </table>
  <div class="panelBar">
    <form id="pagerForm" method="post" action="<?php echo @ACT; ?>
/Customer/customer_show/">
      <input type="hidden" name="pageNum" value="1" />
      <input type="hidden" name="numPerPage" value="<?php echo $this->_tpl_vars['numPerPage']; ?>
" />
      <input type="hidden" name="orderField" value="${param.orderField}" />
      
       <input type="hidden" name="trade_id" value="<?php echo $this->_tpl_vars['trade']; ?>
" />
       <input type="hidden" name="trade_name" value="<?php echo $this->_tpl_vars['trade_name']; ?>
" />
       <input type="hidden" name="bdt" value="<?php echo $this->_tpl_vars['bdt']; ?>
" />
       <input type="hidden" name="edt" value="<?php echo $this->_tpl_vars['edt']; ?>
" />
    </form>
    <div class="pages"> <span>显示</span>
      <select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
        <option value="20" <?php if ($this->_tpl_vars['numPerPage'] == '20'): ?> selected="selected" <?php endif; ?>>20</option>
        <option value="50" <?php if ($this->_tpl_vars['numPerPage'] == '50'): ?> selected="selected" <?php endif; ?>>50</option>
        <option value="100" <?php if ($this->_tpl_vars['numPerPage'] == '100'): ?> selected="selected" <?php endif; ?>>100</option>
        <option value="200" <?php if ($this->_tpl_vars['numPerPage'] == '200'): ?> selected="selected" <?php endif; ?>>200</option>
        <option value="500" <?php if ($this->_tpl_vars['numPerPage'] == '500'): ?> selected="selected" <?php endif; ?>>500</option>
      </select>
      <span>条，共<?php echo $this->_tpl_vars['totalCount']; ?>
条</span> </div>
    <div class="pagination" targetType="navTab" totalCount="<?php echo $this->_tpl_vars['totalCount']; ?>
" numPerPage="<?php echo $this->_tpl_vars['numPerPage']; ?>
" pageNumShown="10" currentPage="<?php echo $this->_tpl_vars['currentPage']; ?>
"></div>
  </div>
</div>