<?php
namespace Admin\Model;

use Think\Model;

/**
 * Class RuleModel
 * @package Admin\Model
 * @author 陈昌平 <chenchangping@foxmail.com>
 */
class RuleModel extends Model
{
    // 获得树状数据
    static public function getTree()
    {
        return $newData;
    }
}