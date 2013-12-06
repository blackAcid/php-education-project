<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 05.12.13
 * Time: 20:52
 */
namespace modules\news\controllers;

use core\Registry;
use core\View;
use \Exception;
use modules\news\controllers\NewsModel;

class IndexController
{
    public function indexAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'memes.php');
        $v->assign('title', 'Home page');
        //$v->assign('users', DefaultModel::selectUsers());
        try {
            $v->addIntoTemplate();
            $v->display();
            //DefaultModel::selectUsers();
            NewsModel::displayMemes();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
} 