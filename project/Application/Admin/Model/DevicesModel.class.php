<?php
namespace Admin\Model;
use Think\Model;

class DevicesModel extends Model
{
    protected $_validate = array(
        array('code_id', length,'设备码不正确', 16),
        array('code_id',unique,'设备已添加'),
    );

    public function getDevicesInfo($user_id)
    {
        $this->where(
            'user_id'
        )->select();
    }

    public function add_device($code)
    {
        return $this->add($code);
    }
}