<?php
namespace app\admin\controller;

use system\model\Grade;
use core\view\View;
use system\model\Student as s;

class Student extends Common{

//    学生管理列表
    public function index(){
//        需要同时展示班级和学生信息，这里需要重组sql语句
        $sql = "select student.*,grade.username from student join grade on student.gid = grade.id";
//        p($sql);
        $student = s::query($sql)->toArray();
//        p($stu);
//      加载学生列表模板分配数据
        return View::make()->with('student',$student);
    }


//    添加学生模板方法
    public function create(){
//        获取所有班级数据
//        echo '123';
        $grade = Grade::get()->toArray();
//        加载添加学生模板分配数据
        return View::make()->with('grade',$grade);
    }


//    处理学生数据添加
    public function add(){
//        获取$_POST数据
        $post = $_POST;
//        调用框架的添加方法
        $result = s::add($post);
//        判断是否添加成功
        if ($result){
//            如果成功提示并跳转
            return $this->redirect('index.php?s=admin/student/index')->message('添加成功！');
        }else{
//            如果失败，提示错误并且刷新当前
            return $this->redirect()->message('添加失败！')  ;
        }

    }


//    编辑学生数据方法
    public function edit(){
//        获取班级所有数据并分配
        $grade = Grade::get()->toArray();

//        获取需要修改的学生ID
        $id = $_GET['id'];
//        通过$id找到对应的学生数据
        $student = s::find($id)->toArray();
//        p($student);
        if($_POST){
//        获取$post
            $post= $_POST;
//         调用框架方法修改学生数据
            $result = s::edit($post);
            if($result){
                return $this->redirect('index.php?s=admin/student/index')->message('修改成功');
            }else{
                return $this->redirect()->message('修改失败');
            }
        }
//          加载编辑学生模板,分配需要修改的学生数据
            return View::make()->with('student',$student)->with('grade',$grade);

    }




//        删除学生数据方法
    public function delete(){
//        先获取GET数据
        $id = $_GET['id'];
//        调用框架删除方法
        $result = s::delete($id);
        if($result){
            return $this->redirect('index.php?s=admin/student/index')->message('删除成功！');
        }else{
            return $this->redirect()->message('删除失败！');
        }

    }





}




















?>
