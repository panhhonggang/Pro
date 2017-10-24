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
        array('created_at', 'time', 1, 'function'),
    );

    public function getDevicesInfo($user_id)
    {
        // 查询设备
        $bindding = M('binding');
        $bindding->where("{user_id}=". function(){
            
        })->select();
    }

    // 插入数据库
    public function add_device($code)
    {
        return $this->add($data);
    }
}