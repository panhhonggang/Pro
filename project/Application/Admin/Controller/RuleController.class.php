<?php
namespace Admin\Controller;

use Think\Controller;

class RuleController extends Controller
{
    /****************   权限组 *********************************/
    // 权限列表
    public function auth_rule()
    {
        $this->display('auth_rule');
    }

    // 添加权限
    public function add_rule()
    {
        $this->display('add_rule');
    }

    // 修改权限
    public function update_rule()
    {
        $this->display('update_rule');
    }

    // 删除权限
    public function delete_rule()
    {
        $this->display('delete_rule');
    }

    /****************  用户组 *********************************/
    // 用户组列表
    public function auth_group()
    {
        $this->display('auth_group');
    }

    // 添加用户组
    public function add_group()
    {
        $this->display('add_group');
    }

    // 修改用户组
    public function update_group()
    {
        $this->display('update_group');
    }

    // 删除用户组
    public function delete_group()
    {
        $this->display('delete_group');
    }

    // 分配用户组权限
    public function rule_group()
    {
        $this->display('rule_group');
    }

    /****************   用户 - 用户组 *********************************/
    // 添加用户到用户组
    public function add_user_to_group()
    {
        $this->display('add_user_to_group');
    }

    // 移除用户组用户
    public function delete_user_to_group()
    {
        $this->display('delete_user_to_group');
    }

    /****************   管理组 *********************************/
    //
    public function auth_group_access()
    {
        $this->display('auth_group_access');
    }
}
