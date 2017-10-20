<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display('index');
    }

    public function welcome()
    {
        $this->show('<h1>欢迎回来！</h1>');
    }
}