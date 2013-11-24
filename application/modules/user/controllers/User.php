<?php

class UserController
{
    public function registrationAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module,'registration.php');
        $v->assign('title','New user');

        try{
            $v->addIntoTemplate();
            $v->display();
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }
}