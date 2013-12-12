<?php
namespace modules\user\controllers;

use core\Registry;
use core\View;
use \Exception;
use modules\user\model\UserModel;

class UserController
{
    public function registrationAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'registration.php');
        $v->assign('title', 'New user');
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /*public function profileAction()
    {
        $User = new model\User();
        $User->profile($_SESSION['user_id']);
        $module = Registry::getValue('module');
        $v = new View($module, 'profile.php');
        foreach ($User as $property => $value) {
            $v->assign($property, $value);
        }
        try {
            $v -> addIntoTemplate();
            $v -> display();
        } catch (Exception $e) {
            echo $e -> getMessage();
        }
    }*/
    public function loginAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'login.php');
        $v->assign('title', 'Log In');
        $user=UserModel::login();
        if ($user!=null){
            $_SESSION['userID']=$user['id'];
        } else {
            //header("Location:".HTTP_URL_PUB."user/user/registration");
        }
        //$v->assign('userLogIn',UserModel::login());
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
