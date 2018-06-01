<?php
namespace core;

class Controller{

//    定义默认跳转方法(调转到上一页）
    protected $url = 'location.href = window.history.back()';

//    操作失败或成功的跳转方法
    public function redirect($url = ''){
//    判断是否用该方法传递了跳转地址的参数，如果有就跳转到指定的地址
//    如果没有传递就返回上一页，如果传递了参数，就将url赋值给类属性
        if($url != ''){
            $this->url = "location.href = '" . $url . "'";
        }
//        p($this->url);
        return $this;
    }

    public function message($msg){
//        加载页面实现跳转，需要用的时候直接调用方法
        include 'public/view/message.php';
    }


}

?>
