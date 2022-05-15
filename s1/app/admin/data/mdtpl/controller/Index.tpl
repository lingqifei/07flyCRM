<?php
/*
*
* [modulename].controller  模型
*
* =========================================================
* 零起飞网络 - 专注于网站建设服务和行业系统开发
* 以质量求生存，以服务谋发展，以信誉创品牌 !
* ----------------------------------------------
* @copyright Copyright (C) 2017-2022 07FLY Network Technology Co,LTD.
* @license For licensing, see LICENSE.html or http://www.07fly.xyz/html/business
* @author ：kfrs <goodkfrs@QQ.com> 574249366
* @version ：1.1.0
* @link ：http://www.07fly.xyz
* @Date:[datetime]
*/

namespace app\[spacename]\controller;

use app\common\controller\ControllerBase;

/**
 * 模块基类
 */
class Index extends [ModuleBase]
{
    public function index()
    {
        $info = "it is work!";
        $this->assign('info', $info);
        return $this->fetch('index');
    }
}

?>