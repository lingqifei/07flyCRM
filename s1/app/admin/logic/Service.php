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
 * 服务逻辑
 */
class Service extends AdminBase
{
    
    // 对象实例
    protected static $instance = [];
    
    /**
     * 获取驱动信息
     */
    public function getDriverInfo($where = [], $field = true)
    {
        
        return $this->modelDriver->getInfo($where, $field);
    }
    
    /**
     * 驱动安装
     */
    public function driverInstall($data = [])
    {
        
        $where['service_name'] = $data['service_name'];
        $where['driver_name']  = $data['driver_name'];
        
        $info = $this->modelDriver->getInfo($where);
        
        $info['config']       = serialize($data['param']);
        $info['service_name'] = $data['service_name'];
        $info['driver_name']  = $data['driver_name'];
        
        $url = url('service/servicelist', ['service_name' => $data['service_name']]);
        
        $result = $this->modelDriver->setInfo($info);
        
        $result && action_log('安装', '驱动安装或设置，service_name：' . $data['service_name'] . '，driver_name' . $data['driver_name']);
        
        return $result ? [RESULT_SUCCESS, '操作成功', $url] : [RESULT_ERROR, $this->modelDriver->getError()];
    }
    
    /**
     * 驱动卸载
     */
    public function driverUninstall($data = [])
    {
        
        $where['service_name'] = $data['service_class'];
        $where['driver_name']  = $data['driver_class'];
        
        $result = $this->modelDriver->deleteInfo($where, true);
        
        $result && action_log('卸载', '驱动卸载，service_name：' . $data['service_class'] . '，driver_name' . $data['driver_class']);
        
        return $result ? [RESULT_SUCCESS, '操作成功'] : [RESULT_ERROR, $this->modelDriver->getError()];
    }
    
    /**
     * 获取服务 or 驱动列表
     */
    public function getServiceList($service_name)
    {
        
        $object_list = $this->getObjectList($service_name);
              
        $list = [];
        
        foreach ($object_list as $object)
        {
            
            if (is_null($service_name)) {
                
                $info = $object->serviceInfo();
            } else {
                
                $info = $object->driverInfo();
                
                $dv_info = $this->modelDriver->getInfo(['driver_name' => $info['driver_class']]);

                empty($dv_info) ? $info['is_install'] = DATA_DISABLE : $info['is_install'] = DATA_NORMAL;
            }
            
            $list[] = $info;
        }
        
        return $list;
    }
    
    /**
     * 获取对象列表
     */
    public function getObjectList($service_name)
    {

        if (is_null($service_name)) {
            
            $file_list  = file_list(PATH_SERVICE);

            $object_path = SYS_DS_CONS . SYS_APP_NAMESPACE . SYS_DS_CONS . SYS_COMMON_DIR_NAME . SYS_DS_CONS . LAYER_SERVICE_NAME;
            
        } else {
            
            $driver_name = strtolower($service_name);
            
            $file_list  = file_list(PATH_SERVICE . $driver_name. DS . SYS_DRIVER_DIR_NAME);

            $object_path = SYS_DS_CONS . SYS_APP_NAMESPACE . SYS_DS_CONS . SYS_COMMON_DIR_NAME . SYS_DS_CONS . LAYER_SERVICE_NAME . SYS_DS_CONS . $driver_name . SYS_DS_CONS . SYS_DRIVER_DIR_NAME;
        }
        
        foreach ($file_list as $v) {
            
            $class_name = sr($v, EXT);
            
            if (false === strpos($class_name, 'Base') && !isset(self::$instance[$class_name])) {
                
                $class = $object_path . SYS_DS_CONS . $class_name;
        
                self::$instance[$class_name] = new $class();
            }
        }
        
        return self::$instance;
    }


    public function  testSms(){
        // 短信发送
        $parameter['nationCode']='86';
        $parameter['mobile']='18030402705';
        $parameter['template_id']='659759';
        $parameter['params_array']=['3040','10'];
        $parameter['sign']='人人海外';
        $res= $this->serviceSms->driverTencent->sendSms($parameter);
        if($res){
            return [RESULT_SUCCESS,'发送成功'];
        }else{
            return [RESULT_ERROR,'发送失败'];
        }
    }

}
