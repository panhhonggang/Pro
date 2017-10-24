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

        $user_id = $_SESSION['adminuser']['id'];

        $deviceList = $device->getDevicesInfo($user_id);
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
        if( !$devices->create( $code )){
            exit( $devices->getError() );
        }
        if(!$devices->add_device()){
            $this->error('添加失败', 'show_add_device');
        }

        $this->success('添加成功', 'show_add_device');

    }
}