<?php
/**
 * 零起飞-(07FLY-CRM)
 * ==============================================
 * 版权所有 2015-2028   成都零起飞网络，并保留所有权利。
 * 网站地址: http://www.07fly.xyz
 * ----------------------------------------------------------------------------
 * 如果商业用途务必到官方购买正版授权, 以免引起不必要的法律纠纷.
 * ==============================================
 * Author: kfrs <goodkfrs@QQ.com> 574249366
 * Date: 2019-10-3
 */


namespace app\admin\logic;

/**
 * 授权逻辑
 */
class SysAuthAccess extends AdminBase
{

	/**
	 * 获得权限菜单列表
	 */
	public function getAuthMenuList($sys_user_id = 0,$model='')
	{

		$sort = 'sort';
		if (IS_ROOT) {
			$map=[];
			if(!empty($model)) $map['module']=['in',$model];
			return $this->logicSysMenu->getSysMenuList($map, true, $sort);
		}

		// 获取用户组列表
		$group_list = $this->getUserAuthInfo($sys_user_id);

		$menu_ids = [];

		foreach ($group_list as $group_info) {

			// 合并多个分组的权限节点并去重
			!empty($group_info['rules']) && $menu_ids = array_unique(array_merge($menu_ids, explode(',', trim($group_info['rules'], ','))));
		}

		//2019-12-11 新增加加用户单独权限设置
		$userinfo = session('sys_user_info');
		$menu_ids = array_unique(array_merge($menu_ids, explode(',', trim($userinfo['rules'], ','))));

		// 户单独权限设置************end

		if (empty($menu_ids))  return $menu_ids;// 若没有权限节点则返回空数组

		// 查询条件=>区别按模块
		$where['id'] = ['in', $menu_ids];
		if(!empty($model)) $where['module'] = ['in', $model];//判断模块是否开启
		return $this->logicSysMenu->getSysMenuList($where, true, $sort)->toArray();
	}

	/**
	 * 获得权限菜单URL列表
	 */
	public function getAuthMenuUrlList($auth_menu_list = [])
	{

		$auth_list = [];

		foreach ($auth_menu_list as $info) {
			$auth_list[] = $info['url'];
		}

		return $auth_list;
	}

	/**
	 * 获取会员所属权限组信息
	 */
	public function getUserAuthInfo($sys_user_id = 0)
	{

		$this->modelSysAuthAccess->alias('a');

		is_array($sys_user_id) ? $where['a.sys_user_id'] = ['in', $sys_user_id] : $where['a.sys_user_id'] = $sys_user_id;

		$where['a.' . DATA_ORG_NAME] = ['>', 0];//是得到所有权限列表

		$field = 'a.sys_user_id, a.sys_auth_id, g.name, g.intro, g.rules';

		$join = [
			[SYS_DB_PREFIX . 'sys_auth g', 'a.sys_auth_id = g.id'],
		];


		$this->modelSysAuthAccess->join = $join;

		return $this->modelSysAuthAccess->getList($where, $field, '', false);
	}

	/**
	 * 获取会员所属权限组名称
	 */
	public function getUserAuthListName($sys_user_id = 0)
	{

		$auth_list = $this->getUserAuthInfo($sys_user_id)->toArray();

		return $auth_list;

	}


	/**
	 * 获取授权列表
	 */
	public function getSysAuthAccessList($where = [], $field = 'sys_user_id,sys_user_id', $order = 'sys_user_id', $paginate = false)
	{

		return $this->modelSysAuthAccess->getList($where, $field, $order, $paginate);
	}

}
