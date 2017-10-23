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
    public function devicesList()
    {
        $device = D('Devices');
        $this->display('devicesList');
    }

    public function show_add_device()
    {
        $this->display('show_add_device');
    }

    public function add_device()
    {
        $bool = D('Devices');
        $code = I(post.code_id);
        if( empty($code) || strlen($code) != 16 ){
            $this->error('设备码输入错误', 'devicesList', 0);
        }

    }
}