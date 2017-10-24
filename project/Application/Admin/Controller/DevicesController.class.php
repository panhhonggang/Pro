<?php
namespace Admin\Controller;
use Admin\Controller\CommonController;
use Think\Controller;

/**
 * Class DevicesController
 * @package Admin\Controller
 * @author 陈昌平 <chenchangping@foxmail.com>
 */
class DevicesController extends Controller
{
    /**
     * 显示设备列表
     */
    public function devicesList()
    {
        $device = D('Devices');
        $deviceList = "Hello";
        $this->assign('deviceList', $deviceList);
        $this->display('devicesList');
    }

    /**
     * 显示设备添加页面
     */
    public function show_add_device()
    {
        $this->display('show_add_device');
    }

    /**
     * 设备添加处理
     */
    public function add_device()
    {
        $devices = D('Devices');
        $code = I(get.code_id);
        /*if( empty($code) || strlen($code) != 16 ){
            $this->error('设备码输入错误', 'devicesList', 0);
        }*/
        if( !$devices->create( $code )){
            exit( $devices->getError() );
        }

    }
}