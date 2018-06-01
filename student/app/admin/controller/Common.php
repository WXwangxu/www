<?php
namespace app\admin\controller;


use core\Controller;

class Common extends Controller{

    public function __construct()
    {
//        该方法判断用户是否登录，如果没登录就阻止他使用地址跳转
//        并且提示登录，跳转到登录界面
        if (!isset($_SESSION['username'])){
            die($this->redirect('index.php?s=admin/login/loginForm')->message('请先登录!'));
        }
    }


}
















?>
