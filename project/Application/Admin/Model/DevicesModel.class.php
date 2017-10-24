<?php
namespace Admin\Model;
use Think\Model;

/**
 * Class DevicesModel
 * @package Admin\Model
 * 设备添加操作
 */
class DevicesModel extends Model
{
    // 自动验证
    protected $_validate = array(
        array('device_code', '16', '请输入正确的设备编码', '3', 'length'),
        array('device_code', '/^\d{16}$/', '设备编码只能是数字', '2', 'regex'),
        array('device_code', '', '请不要重复录入', '1', 'unique'),
    );

    // 自动完成
    protected $_auto = array(
        array('device_statu', '1'),
        array('created_at', 'getNowTime', 1, 'callback'),
    );

    public function getDevicesInfo($user_id)
    {
        $this->where(
            'user_id='{}
        )->getField();
    }

    // 插入数据库
    public function add_device($code)
    {
        return $this->add($data);
    }

    // 获取当前时间
    public function getNowTime()
    {
        return date('Y-m-s H:i:s', time());
    }
}