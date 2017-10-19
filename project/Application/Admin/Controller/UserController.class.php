<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller {
    public function index(){
        $this->display('index');
    }

    public function login()
    {
        $this->display('login');
    }
}
