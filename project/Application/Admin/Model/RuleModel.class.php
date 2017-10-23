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
    protected $tableName = 'auth_rule';
    // 获得树状数据
    static public function getTree()
    {
        echo "<pre>";
        $newTable = M('auth_rule');
        $newData = $newTable->select();
        for ($i = 0; $i <= count($newData); $i++){
            foreach ($newData[$i] as $key => $value ){
                var_dump("$key=>$value");
            }
        }
        return $newData;
    }
}