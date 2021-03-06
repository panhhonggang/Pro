<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * 经销商控制器
 * 
 * @author 潘宏钢 <619328391@qq.com>
 */

class VendorsController extends CommonController 
{
	/**
     * 经销商列表（本质就是后台用户）
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function index()
    {	
        // 根据用户昵称进行搜索
    	if(!empty($_GET['name'])) $map['name'] = array('like',"%{$_GET['name']}%");

        $user = D('vendors');
        $total = $user->where($map)->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $userlist = $user->where($map)->limit($page->firstRow.','.$page->listRows)->getAll();

        $this->assign('list',$userlist);
        $this->assign('button',$pageButton);
        $this->display();
    }

    /**
     * 添加经销商方法
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function add()
    {
        if(IS_POST){

            $user = D('vendors');
            $info = $user->create();
            // dump($info);die;

            if($info){

                $res = $user->add();
                if ($res) {
                    $this->success('添加经销商成功啦！！！',U('Vendors/index'));
                } else {
                    $this->error('添加经销商失败啦！');
                }
            
            } else {
                // getError是在数据创建验证时调用，提示的是验证失败的错误信息
                $this->error($user->getError());
            }
        }else{
            $this->display();
        }
    }

    /**
     * 编辑经销商方法
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function edit()
    {
        if(IS_POST){
            
            if ($_POST['password'] == $_POST['repassword']) {
                $mod = M('vendors');
                $mod->password = md5($_POST['password']);

                $res = $mod->where("id=".$_POST['id'])->save();

                if ($res) {
                    $this->success('修改成功啦！','index');
                }else{
                    $this->error('修改失败！');
                }
            } else {
                $this->error('两次密码不一样，请重新输入！');
            }

        } else {
            $info = D('vendors')->find($id);
            $this->assign('info',$info);
            $this->display();
        }
    }
    
    /**
     * 删除经销商方法
     * 需保证其没有下级，没有设备与之挂钩
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function del($id)
    {
        $userinfo = M('vendors')->where("id=".$id)->select();

        if ($userinfo[0]['leavel'] == 0 ) {
            $this->error('不能删除超级管理员！');
        }else{
            // 查
            $res = D('vendors')->delete($id);
            if($res){
                $this->success('删除成功',U('index'));
            }else{
                $this->error('删除失败');
            }

        }
    }

    /**
     * 设备绑定经销商方法
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function devices_add()
    {
        if (IS_POST) {

            if ($_POST['did']) {
                $arr = array(
                    'vid' => I('vid'),
                    'did' => I('did'),
                    'operator' => $_SESSION['adminuser']['name'],
                    'addtime' => time(),
                );
                $binding = M('binding');
                // 添加
                if ($binding->add($arr)) {
                    $this->success('添加成功',U('bindinglist'));
                }else{
                    $this->error('添加失败啦');
                }

            }else{
                $this->error('设备不存在！请在设备管理中添加设备后尝试！正在为您跳转至设备管理',U('Devices/devicesList'));
            }                    
        }else{
            // 获取经销商信息
            $user = D('vendors')->getAll();
            // 获取设备信息
            $devices = M('devices')->select();

            $this->assign('user',$user);
            $this->assign('devices',$devices);
            $this->display();
        }

    }

    /**
     * 设备绑定经销商列表
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function bindinglist()
    {
       // 根据用户昵称进行搜索
        if(!empty($_GET['name'])) $map['name'] = array('like',"%{$_GET['name']}%");

        $binding = M('binding');
        
        $total =$binding->where($map)
                   ->join('pub_vendors ON pub_binding.vid = pub_vendors.id')
                   ->join('pub_devices ON pub_binding.did = pub_devices.id')
                   ->field('pub_binding.*,pub_vendors.name,pub_vendors.phone,pub_devices.device_code')
                   ->count();
        $page  = new \Think\Page($total,8);
        $pageButton =$page->show();

        $bindinglist = $binding->where($map)
                                ->limit($page->firstRow.','.$page->listRows)
                                ->join('pub_vendors ON pub_binding.vid = pub_vendors.id')
                                ->join('pub_devices ON pub_binding.did = pub_devices.id')
                                ->field('pub_binding.*,pub_vendors.name,pub_vendors.phone,pub_devices.device_code')
                                ->select();

        $this->assign('list',$bindinglist);
        $this->assign('button',$pageButton);
        $this->display(); 
    }

    /**
     * 解除绑定方法
     * 
     * @author 潘宏钢 <619328391@qq.com>
     */
    public function bindingdel($id)
    {
        
        if ($_SESSION['adminuser']['leavel'] == 0) {
            // echo 1;die;
            $res = D('binding')->delete($id);
            if($res){
                $this->success('删除成功',U('bindinglist'));
            }else{
                $this->error('删除失败');
            }

        }else{
           $this->error('对不起，您没有权限解除绑定！',U('bindinglist'));
        }
    }

}