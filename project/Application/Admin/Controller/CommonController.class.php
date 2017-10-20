<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 管理员控制器
 * 后台控制器除login外必须继承我
 * @author 潘宏钢 <619328391@qq.com>
 */

class CommonController extends Controller 
{
	/**
     * 初始化
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function _initialize()
    {	
    	// 登录检测
    	if(empty($_SESSION['adminuser'])) $this->redirect('Login/index');

    	// 权限检测
    	$name = $_SESSION['adminuser']['user'];
    	$auth = $this->auth($name);
    	if(!$auth) $this->redirect('Index/index');

    	// 获取用户配置
    	$user_config = D('Admin/Config');
    	$config = $user_config->getconfig();
    	$this->assign('config', $config); // 后台用户配置
    }

    /**
     * 调用权限验证方法
     * @param string $name 登录用户名
     * @return ture/false
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function auth($name)
    {
    	if ('权限验证') {
    		
    		return ture;
    	}

    	return false;
    }
}