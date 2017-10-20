<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20/0020
 * Time: 9:28
 */
namespace Admin\Controller;
use Think\Controller;
use Think\Verify;

/**
 * Class 登陆
 * @author 陈昌平 <chenchangping@foxmail.com>
 */
class LoginController extends Controller
{
    // 登陆页面
    public function index()
    {
        $this->display('index');
    }

    /**
     * 登陆的数据处理
     * @param none
     * @return true/false
     * @author 陈昌平
     */
    public function action()
    {
        $vendors = D('login');

        $bool = $vendors->check();
        /*if($bool){
            $this->success('登陆成功，欢迎回来！', U('Index/index'), 200);
        } else {
            $this->error('用户或密码错误，请重新登陆！', U('Login/index'), 200);
        }*/
        switch ($bool){
            case "USER FAILED":
                $this->error('请输入正确用户名！', U('Login/index'), 3);
                break;
            case "PASSWORD FAILED":
                $this->error('请输入正确密码！', U('Login/index'), 3);
                break;
            case "CODE FAILED":
                $this->error('验证码输入错误！', U('Login/index'), 3);
                break;
            case "SUCCESS":
                $this->success('登陆成功，欢迎回来！', U('Index/index', 3));
                break;
            default:
                break;
        }

    }

    /**
     * 生成验证码
     * @param none
     * @return true/false
     * @author 陈昌平
     */
    public function verify()
    {
        $verify = new Verify();
        $verify->fontSize = 18;
        $verify->length = 4;
        $verify->useNoise = false;
        $verify->imageW = 300;
        $verify->entry();
    }
}