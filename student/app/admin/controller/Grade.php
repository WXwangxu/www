<?php
namespace app\admin\controller;

use core\view\View;
use system\model\Grade as g;
class Grade extends Common{


//    班级列表
    public function index(){
//        获取班级中的所有数据
//        组合sql语句找到所有学生的班级数据
        $sql = "select grade.*,count(student.name) as c from student right join grade on student.gid = grade.id group by grade.id";
//        p($sql);
        $data = g::query($sql)->toArray();
//        加载班级模板
//        p($data);
        return View::make()->with('grade',$data);

    }


//    加载班级模板
    public function create(){
//        加载班级模板
        return View::make();
    }

//        添加方法
     public function add(){
//        获取POST数据
        $post = $_POST;
//        p($post);
//        将提交的$post插入grade表中
        $result = g::add($post);
//        判断返回结果是成功，分别返回不同消息
        if ($result){
            return $this->redirect('index.php?s=admin/grade/index')->message('添加成功！');
        }else{
            return $this->redirect()->message('添加失败！');
        }
     }


//     跳转到删除方法
    public function delete(){
        //获取需要删除班级的id
        $id = $_GET['id'];
        $result = g::delete($id);
        //判断返回结果是否为真,提示不同消息并跳转或返回
        if ($result){
            return $this->redirect('index.php?s=admin/grade/index')->message('删除成功!');
        }else{
            return $this->redirect()->message('删除失败!');
        }

    }


    public function ajaxDelete(){
        //获取get参数中的需要删除的班级id
        $id = $_GET['id'];
        //将对应$id的班级数据删除
        $result = g::delete($id);
        //判断$result返回结果是否为真,来返回给前台不同的处理结果
        if ($result){
            //如果为真,代表删除成功
            return json_encode(['valid' => 1,'message' => '删除成功!']);
        }else{
            //为假,代表删除失败
            return json_encode(['valid' => 0,'message' => '删除失败!']);
        }
    }


//        编辑方法
     public function edit(){

//        p($_GET['id']);
//        获取班级数据并分配
        $stu = g::find($_GET['id'])->toArray();
//         p($stu);
         if ($_POST){
             //获取post数据
             $post = $_POST;
//             调用框架修改方法
             $result = g::edit($post);
             if ($result !== false){
                 return $this->redirect('index.php?s=admin/grade/index')->message('修改成功');
             }else{
                 return $this->redirect()->message('修改失败');
             }
         }

        return View::make()->with('stu',$stu);

     }





















}







?>