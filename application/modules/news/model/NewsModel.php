<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 05.12.13
 * Time: 19:08
 */
namespace modules\news\model;

use core\classTables\Roles;
use core\classTables\Memes;

class NewsModel
{
    static public function displayMemes()
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        /*$column=count($selObj->selectColumns(['name','path','likes','date_create','dislikes'])
            ->fetchAll(null));*/
        $result=$selObj->selectColumns(['name','path','likes','date_create','dislikes'])
            ->fetchAll(null);
        $rows=count($result);
        //var_dump($result);
        /*$result=array();
        for ($i=0;$i<$column;$i++){
            $result[$i]=$selObj->selectColumns(['path'])->fetch(null);
        }*/
        return $result;
    }
    static public function getPath()
    {
        $selectPath=new Memes();
        $selObj=$selectPath->selectPrepare();
        $result=$selObj->selectColumns(['path'])->fetchAll(null);
        $arr=array();
        for ($i=0;$i<count($result);$i++) {
            $arr[$i]=$result[$i]["path"];
        }
        return $arr;
    }
    static public function getName()
    {
        $selectPath=new Memes();
        $selObj=$selectPath->selectPrepare();
        $result=$selObj->selectColumns(['name'])->fetchAll(null);
        $arr=array();
        for ($i=0;$i<count($result);$i++) {
            $arr[$i]=$result[$i]["name"];
        }
        return $arr;
    }
    static public function getMemes()
    {
        $selectPath=new Memes();
        $selObj=$selectPath->selectPrepare();
        $result=$selObj->selectColumns(['*'])->fetchAll(null);
        return $result;
    }
} 