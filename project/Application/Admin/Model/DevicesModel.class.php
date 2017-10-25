<?php
namespace Admin\Model;
use Think\Model;

/**
 * Class DevicesModel
 * @package Admin\Model
 * 设备添加操作
 * @author 陈昌平 <chenchangping@foxmail.com>
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
        $data = M()->table('pub_vendors vendors')
            ->join('__BINDING__ on vendors.id = __BINDING__.vid', 'left')
            ->join('__DEVICES__ on __BINDING__.did = __DEVICES__.id', 'left')
            ->join('__FILTERS__ on __DEVICES__.id = __FILTERS__.device_id', 'left')
            ->join('__DEVICES_STATU__ on __DEVICES__.id = __DEVICES_STATU__.device_id', 'left')
            ->where("vendors.id={$user_id}")
            ->select();

        return $data;
    }

    // 滤芯处理
    public function filterAction()
    {

    }

    // 插入数据库
    public function add_device($code)
    {
        return $this->add($code);
    }

    // 获取滤芯状态
    public function getFilters($device_id)
    {
        return $this->where("device_id={$device_id}")->find();
    }

    // 获取绑定经销商
    public function getVendors($device_id)
    {
        return $this->where("did={$device_id}")->find();
    }

}