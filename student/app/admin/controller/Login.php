<?php
namespace app\admin\controller;



use app\admin\controller\Common;
use core\Controller;
use core\view\View;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use system\model\User;

class Login extends Controller {



//    加载登录模板方法
    public function loginForm(){
//        首先判断$_POST是否提交
        if ($_POST){
//            定义变量接收数据
            $post = $_POST;
//            p($post);
//            判断验证码是否输入正确
        if ($post['code'] != $_SESSION['code']){
//            如果错误反馈提示
           return $this->redirect()->message('验证码错误!');
        }
//        在数据库中寻找是否有跟$post提交的数据相匹配的账号密码，如果有就登录成功，如果没有就代表登录信息错误
        $userInfo = User::where('username = "'.$post['username'].'" and password = "' . md5($post['password']) . '"')->get()->toArray();
//        p(md5($post['password']));
//        判断账号密码是否为空
            if (empty($userInfo)){
                return $this->redirect()->message('账号密码错误！');
            }
//            判断是否勾选了记住我，如果勾选了就在cookie里面存一个周期为7天的有效值
//            如果没有就继续走下面的代码
            if (isset($_POST['autologin'])){
                setcookie(session_name(),session_id(),time()+7*24*3600,'/');
            }
//            把正确的账号密码存进session
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['uid'] = $userInfo[0]['id'];
//            p($userInfo);die;
//            p($_SESSION['uid']);
            return $this->redirect('index.php?s=admin/entry/index')->message('登陆成功！');

        }
        return View::make();

    }

//        退出当前账号
    public function logout(){
//            清理session内容
        session_unset();
        session_destroy();
//            退出完成，跳转去后台登录
        return $this->redirect('index.php?s=admin/login/loginForm')->message('退出成功!');
    }


//    生成验证码方法
    public function code(){
        $phraseBuilder = new PhraseBuilder(4,'1234567890');

// Pass it as first argument of CaptchaBuilder, passing it the phrase
// builder
        $builder = new CaptchaBuilder(null, $phraseBuilder);
        $builder->build();
        header('Content-type: image/jpeg');
        $builder->output();
        //将生成的验证码存入session
        $_SESSION['code'] = $builder->getPhrase();
    }



}




?>
