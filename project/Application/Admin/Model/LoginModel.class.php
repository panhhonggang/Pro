<?php

namespace Admin\Model;
use Think\Model;
use Think\Verify;

/**
 * Class 登陆数据处理
 * @package Admin\Model
 * @author 陈昌平 <chenchangping@foxmail.com>
 */
class LoginModel extends Model
{
    // 设置表名
    protected $tableName = "vendors";

    //验证登陆的用户信息
    public function check()
    {
        $user = $_POST['user'];
        $password = $_POST['password'];
        $code = $_POST['code'];
        if(!empty($user) && !empty($password)){
            $data['user'] = $user;
            $user = $this->where( $data )->find();
            $data['password'] = md5($password);
            $password = $this->where($data)->find();
        }
        if( !$user ){
            return "USER FAILED";
        }

        if( !$password ){
            return "PASSWORD FAILED";
        }

        if( !$this->check_code( $code ) ){
            return "CODE FAILED";
        }
        $_SESSION['adminuser'] = $user;
        return "SUCCESS";
    }

    /**
     * 校验验证码
     * @param node
     * @return true/false
     * @author 陈昌平
     */
    public function check_code( $code, $id="" )
    {
        $verify = new Verify();

        $res = $verify->check( $code, $id );

        return $res;
    }


}