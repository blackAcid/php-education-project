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
        $User->profile($_GET['id']);
        Registry::setValue($_GET['id'], 'user');
        $module = Registry::getValue('module');
        $ViewUser = new View($module, 'profile.php');
        $MemesNumber = count($User->paths_to_my_memes);
        $ViewUser->assign('MemesNumber',$MemesNumber);
        foreach ($User as $property => $value)
        {
            $ViewUser->assign($property, $value);
        }
        try
        {
            $ViewUser -> addIntoTemplate();
            $ViewUser -> display();
        } catch (Exception $e)
        {
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
            //header("Location:".BASE_URL."user/user/registration");
        }
        //$v->assign('userLogIn',UserModel::login());
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function changeAction()
    {
        $User = new model\User();
        if(isset($_POST['user']))
        {
            $User->changeProfile($_POST, '1'); //There must be session variable with user id.
            $User->profile('1'); //There must be session variable with user id.
            $module = Registry::getValue('module');
            $ViewUser = new View($module, 'change.php');
            $MemesNumber = count($User->paths_to_my_memes);
            $ViewUser->assign('MemesNumber',$MemesNumber);
            foreach ($User as $property => $value)
            {
                $ViewUser->assign($property, $value);
            }
            try
            {
                $ViewUser -> addIntoTemplate();
                $ViewUser -> display();
            } catch (Exception $e)
            {
                echo $e -> getMessage();
            }

        } else
        {
            $User->profile('1'); //There must be session variable with user id.
            $module = Registry::getValue('module');
            $ViewUser = new View($module, 'change.php');
            foreach ($User as $property => $value)
            {
                $ViewUser->assign($property, $value);
            }
            try
            {
                $ViewUser -> addIntoTemplate();
                $ViewUser -> display();
            } catch (Exception $e)
            {
                echo $e -> getMessage();
            }
        }

    }
}
