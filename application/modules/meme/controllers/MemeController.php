<?php
namespace modules\meme\controllers;

use core\Registry;
use core\View;
use \Exception;
use modules\meme\models;

class MemeController
{
    public function createAction()
    {
        $pictures = new models\MemeModel();
        $pictures->getBasePictures();
        $picOutput = $pictures->pictures;
        $inpOutput = $pictures->inputs;


        $module = Registry::getValue('module');
        $v = new View($module, 'create.php');
        $v->assign('title', 'Create new meme');
        $v->assign('images', $picOutput);
        $v->assign('inputs', $inpOutput);

        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function generateAction()
    {
        $meme = new models\MemeModel();
        $meme->createMeme($_POST['path'], $_POST['text']);
    }

    public function viewAction()
    {
        $module = Registry::getValue('module');
        $v = new View($module, 'view.php');
        $v->assign('title', 'View');

        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}