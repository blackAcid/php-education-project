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
use modules\news\model\NewsModel;

class IndexController
{
    public function indexAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'memes.php');
        $v->assign('title', 'News');
       // echo "post=".$_POST['startFrom'];
        if (isset($_POST['startFrom'])){
           $startFrom=$_POST['startFrom'];
        } else {
            $startFrom=0;
        }
        $v->assign('memes', NewsModel::getMemes($startFrom));
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function memesAction()
    {
        if (isset($_POST['startFrom'])){
            $startFrom=$_POST['startFrom'];

        }
        else {
            $startFrom=0;
        }
        $memes=NewsModel::getMemes($startFrom);
    for ($i=0; $i<count($memes); $i++) {
    echo "<div class=\"container\" id='container'>"
        ."<header>".$memes[$i]['name']."</header>"
        ."<img alt=\"memes\" src=".DIR_USERS.$memes[$i]['path']."\" class=\"img-thumbnail\"/>"
        ."<div class=\"likes_dislikes\">"
        ."<form id='likes' action=\"".HTTP_URL_PUB."news/index/like\" method=post></form>"
        ."<form id='dislikes' action=\"".HTTP_URL_PUB."news/index/dislike\" method=post></form>"
        ."<button type='submit' form='likes' name='like' value=\"".$memes[$i]['id']."\">
        <img alt=\"like\" src=\"".HTTP_URL_PUB."css/news/like1.jpg\" height=\"20\"/></button>"
        ."<button type='submit' form='dislikes' name='dislike' value=\"".$memes[$i]['id']."\">
        <img alt=\"dislike\" src=\"".HTTP_URL_PUB."css/news/dislike1.jpg\" height=\"20\"/></button>";
        $date=strtotime($memes[$i]['date_create']);
         print "</div><div class=\"row-fluid\"><div class=\"date\">Опубликовано ".date('j.m.y', $date)." в "
        .date('H:i')." by ".$memes[$i]['username']."</div><div class=\"rating\"><span class=\"dislikes\">-"
        .$memes[$i]['dislikes']."</span>
        <span class=\"likes\">+".$memes[$i]['likes']."</span></div></div>"
        ."</div>";
}
        echo "<div id='nextMeme'><div>";
    }
    public function ratingAction()
    {
        $module=Registry::getValue('module');
        $v = new View($module, 'memes.php');
        $v->assign('title', 'News');
        if (!empty($_GET)) {
            $page=(int)$_GET['page'];
        } else {
            $page=1;
        }
        $v->assign('memes', NewsModel::getMemesByRating());
        //$v->assign('countPages', NewsModel::getCountPages());
        try {
            $v->addIntoTemplate();
            $v->display();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function likeAction()
    {
        if (!empty($_POST)) {
            $id_meme=$_POST['like'];
            NewsModel::updateLike($id_meme);
            header("Location:".HTTP_URL_PUB."news/index/index");
        }
    }
    public function dislikeAction()
    {
        if (!empty($_POST)) {
            $id_meme=$_POST['dislike'];
            NewsModel::updateDislike($id_meme);
            header("Location:".HTTP_URL_PUB."news/index/index");
        }
    }
    public function paginationAction()
    {
        if (!empty($_GET)) {
            $pagesNumber=(int)$_GET['page'];
            var_dump($pagesNumber);
        }
    }
}
