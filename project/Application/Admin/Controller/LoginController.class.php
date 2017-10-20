<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/20/0020
 * Time: 9:28
 */
namespace Admin\Controller;
use Think\Controller;
// use Think\Verify;

/**
 * Class 登陆
 * @author 陈昌平 <chenchangping@foxmail.com>
 */
// class LoginController extends Controller
// {
//     // 登陆页面
//     public function index()
//     {
//         $this->display('index');
//     }

//     /**
//      * 登陆的数据处理
//      * @param none
//      * @return true/false
//      * @author 陈昌平
//      */
//     public function action()
//     {
//         $vendors = D('login');

//         $bool = $vendors->check();
//         /*if($bool){
//             $this->success('登陆成功，欢迎回来！', U('Index/index'), 200);
//         } else {
//             $this->error('用户或密码错误，请重新登陆！', U('Login/index'), 200);
//         }*/
//         switch ($bool){
//             case "USER FAILED":
//                 $this->error('请输入正确用户名！', U('Login/index'), 3);
//                 break;
//             case "PASSWORD FAILED":
//                 $this->error('请输入正确密码！', U('Login/index'), 3);
//                 break;
//             case "CODE FAILED":
//                 $this->error('验证码输入错误！', U('Login/index'), 3);
//                 break;
//             case "SUCCESS":
//                 $this->success('登陆成功，欢迎回来！', U('Index/index', 3));
//                 break;
//             default:
//                 break;
//         }

//     }

//     /**
//      * 生成验证码
//      * @param none
//      * @return true/false
//      * @author 陈昌平
//      */
//     public function verify()
//     {
//         $verify = new Verify();
//         $verify->fontSize = 18;
//         $verify->length = 4;
//         $verify->useNoise = false;
//         $verify->imageW = 300;
//         $verify->entry();
//     }
// }
class LoginController extends Controller
{   
    // 登录方法
    public function login()
    {
        if (IS_POST) {
            // 验证验证码是否OK
            $Verify = new \Think\Verify();
            $res = $Verify->check($_POST['code']);
            if(!$res) $this->error('验证码不对');

            $password = md5($_POST['password']);
            $info = M('vendors')->where("user='{$_POST['name']}'")->find();

            if($info){
                if ($info['password'] == $password) {
                    // 万事大吉
                    $_SESSION['adminuser'] = $info;
                    $this->redirect('Index/index');
                }else{
                    $this->error('您的密码输入错误！');
                }
            }else{
                $this->error('您输入的用户名不存在！');
            }

        }else{
            $this->display();
        }
    }


    // 验证码方法
    public function yzm()
    {
        $config = array(
            'font-Size'     =>   20, //验证码大学
            'length'        =>   3,  //验证码个数
            'useNoise'      =>   false, //关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }


    public function logout()
    {
        unset($_SESSION['adminuser']);
        $this->redirect('Login/login');
    }

}
