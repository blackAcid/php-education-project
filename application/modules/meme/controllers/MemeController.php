<?php
namespace modules\meme\controllers;

use core\Registry;
use core\View;
use \Exception;

class MemeController
{
    public function createAction()
    {
        $module = Registry::getValue('module');
        $v = new View($module, 'create.php');
        $v->assign('title', 'Create new meme');

        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}