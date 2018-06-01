<?php
namespace app\home\controller;

use system\model\Student;
use core\view\View;

class Entry{

    public function index(){
//        获得所有学生数据
        $student = Student::get()->toArray();
//        p($student);
//        分配数据
        return View::make()->with('student',$student);
    }


    public function show(){
//        找到对应ID的学生数据
        $student = Student::find($_GET['id'])->toArray();
//        加载查看模板，并分配数据
        return View::make()->with('student',$student);


    }







}









?>
