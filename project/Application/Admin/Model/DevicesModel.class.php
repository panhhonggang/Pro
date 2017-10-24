<?php
namespace Admin\Model;
use Think\Model;

class DevicesModel extends Model
{
    protected $_validate = array(
        array('code_id', length,'设备码不正确', 16),
    );

    public function getDevicesInfo()
    {
        $this->where()->select();
    }
}