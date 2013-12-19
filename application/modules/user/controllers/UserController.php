<?php

namespace modules\user\controllers;

use core\Registry;
use core\View;
use \Exception;
use modules\user\model;

class UserController
{
    public function registrationAction()
    {
        $module = Registry::getValue('module');
        $v = new View($module, 'registration.php');
        $v->assign('title', 'New user');

        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function profileAction()
    {
        $User = new model\User();
        if(isset($_GET['id']) && $_GET['id'] != $_SESSION['user_id'])
        {
            $User->profile($_GET['id']);
            $module = Registry::getValue('module');
            $ViewUser = new View($module, 'profileGuest.php');
            if($User->isSubscribed($_GET['id']))
            {
                $ViewUser->assign('buttonClass', 'unsub');
                $ViewUser->assign('buttonValue', 'Отписаться');
            } else
            {
                $ViewUser->assign('buttonClass', 'sub');
                $ViewUser->assign('buttonValue', 'Подписаться');
            }
        } else
        {
            $User->profile($_SESSION['user_id']);
            $module = Registry::getValue('module');
            $ViewUser = new View($module, 'profile.php');
        }
        $MemesNumber = count($User->paths_to_my_memes);
        $ViewUser->assign('MemesNumber', $MemesNumber);
        foreach ($User as $property => $value) {
            $ViewUser->assign($property, $value);
        }
        try {
            $ViewUser -> addIntoTemplate();
            $ViewUser -> display();
        } catch (Exception $e) {
            echo $e -> getMessage();
        }
    }

    public function changeAction()
    {
        $User = new model\User();
        if (isset($_POST['user'])) {
            $User->changeProfile($_POST, $_SESSION['user_id']);
            $User->profile($_SESSION['user_id']);
            $module = Registry::getValue('module');
            $ViewUser = new View($module, 'change.php');
            foreach ($User as $property => $value) {
                $ViewUser->assign($property, $value);
            }
            try {
                $ViewUser -> addIntoTemplate();
                $ViewUser -> display();
            } catch (Exception $e) {
                echo $e -> getMessage();
            }

        } else {
            $User->profile($_SESSION['user_id']);
            $module = Registry::getValue('module');
            $ViewUser = new View($module, 'change.php');
            foreach ($User as $property => $value) {
                $ViewUser->assign($property, $value);
            }
            try {
                $ViewUser -> addIntoTemplate();
                $ViewUser -> display();
            } catch (Exception $e) {
                echo $e -> getMessage();
            }
        }
    }
}
