<?php
//定义命名空间
namespace core;

class Boot{

    public function run(){
//          开启session
        session_start();
//        判断$_GET数据是否提交过来了
        if(isset($_GET['s'])){
//            切割提交数据
            $info = explode('/',$_GET['s']);
//            p($info);
//            定义默认模块变量
            $m = $info[0];
//            定义默认控制器变量
            $c = ucfirst($info[1]);
//            定义默认方法变量
            $a = $info[2];
        }else{
//            定义默认模块变量
            $m = 'home';
//            定义默认控制器变量
            $c = 'Entry';
//            定义默认方法变量
            $a = 'index';
        }

//        定义常量全局调用
//        定义模块常量
        define('MODULE',$m);
//        定义控制器常量
        define('CONTROLLER',$c);
//        定义方法常量
        define('ACTION',$a);

//        组合需要调用的控制器的类名
        $class = '\app\\'.$m.'\\controller\\' . $c;
//        p($class);die;

//        使用回调函数调用$class类的$a方法
        echo call_user_func_array([new $class,$a],[]);
    }




}


?>
