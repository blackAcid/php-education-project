<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 05.12.13
 * Time: 19:08
 */
namespace modules\news\controllers;

use core\classTables\Roles;
use core\classTables\Memes;

class NewsModel
{
    static public function displayMemes()
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        $result=$selObj->selectColumns(['name','path','likes','date_create','dislikes'])
            ->fetchAll(null);
        var_dump($result);
    }
} 