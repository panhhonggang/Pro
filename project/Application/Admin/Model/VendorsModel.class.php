<?php
namespace Admin\Model;

use Think\Model;

/**
 * Class 经销商数据处理
 * @package Admin\Model
 * @author 潘宏钢 <619328391@qq.com>
 */
class VendorsModel extends Model
{   
    // 自动验证
    protected $_validate = array(
        array('user','require','账户名不能为空'),
        array('user','','该账户已存在，请换一个试试',0,'unique',1),
        array('repassword','password','两次密码不相同',0,'confirm'), //验证确认密码是否和密码一致
        array('phone','/^1[34578]\d{9}$/','电话号码格式不对',1,'regex'),
        array('name','require','昵称不能为空')
    );


    // 自动完成
    protected $_auto = array ( 
         
        array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        
    );


    // 处理查询数据
    public function getAll()
    {
        $list = $this->select();

        $leavel = array('超级管理员','一级经销商','二级经销商');
        foreach ($list as $key => $val) {
            $list[$key]['leavel'] = $leavel[$val['leavel']];
        }
        return $list;
    }
    
}