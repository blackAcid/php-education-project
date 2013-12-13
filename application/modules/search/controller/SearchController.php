<?php
namespace modules\search\controller;

use core\Registry;
use core\View;
use \Exception;
use modules\search\model\SearchModel;

class SearchController
{
    public function resultAction()
    {
        try {
            $module = Registry::getValue('module');
            $v = new View($module, 'search.php');
            //todo: Проверка строки запроса
            $model = new SearchModel($_GET['query']);
            $v->assign('title', 'Search');
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
} 