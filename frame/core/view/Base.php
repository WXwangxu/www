<?php
namespace core\view;


class Base{
//    定义模板路径属性
    protected $file;
//    定义模板变量属性
    protected $vars = [];

    public function make(){
//        定义需要加载的模板文件路径
        $this->file = 'app/'.MODULE.'/view/'.strtolower(CONTROLLER).'/'.ACTION.'.php';
//        p($this->file);die;
        return $this;


    }


    public function with($name,$value){
//        p($value);die;
//        将调用的with方法的数据存入当前属性$value中，用$name当键值，用$value当键名
        $this->vars[$name] = $value;
//        p($this->vars);die;

        return $this;
    }

    public function __toString()
    {
//        处理模板变量
        extract($this->vars);
//        加载对应模板
        include $this->file;
//        p($this->file);die;
       return '';
    }


}
?>
