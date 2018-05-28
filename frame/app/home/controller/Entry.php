<?php
namespace app\home\controller;

use core\view\View;

class Entry{

    public function index(){

        return View::make()->with('version','版本:v2.0');
    }








}









?>
