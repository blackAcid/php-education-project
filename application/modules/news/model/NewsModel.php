<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 05.12.13
 * Time: 19:08
 */
namespace modules\news\model;

use core\classTables\Ratings;
use core\classTables\Roles;
use core\classTables\Memes;
use core\classTables\Users;
use modules\user\model\User;

class NewsModel
{
    static private $memesOnPage;
    public static function displayMemes()
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        /*$column=count($selObj->selectColumns(['name','path','likes','date_create','dislikes'])
            ->fetchAll(null));*/
        $result=$selObj->selectColumns(['name', 'path', 'likes', 'date_create', 'dislikes'])
            ->fetchAll(null);
        $rows=count($result);
        //var_dump($result);
        /*$result=array();
        for ($i=0;$i<$column;$i++){
            $result[$i]=$selObj->selectColumns(['path'])->fetch(null);
        }*/
        return $result;
    }
    public static function getMemes($startFrom)
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        //$result=$selObj->selectColumns(['*'])->fetchAll(null);
        $result=$selObj->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
            ->from(['users'])->where(['memes.user_id='=>'users.id'])->order('memes.date_create', 'DESC')
            ->limit($startFrom,2)->fetchAll(null);
        return $result;
    }
    public static function getMemesByRating($startFrom)
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        //$result=$selObj->selectColumns(['*'])->fetchAll(null);
        $result=$selObj->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
            ->from(['users'])->where(['memes.user_id='=>'users.id'])->order('likes', 'DESC')
            ->limit($startFrom,2)->fetchAll(null);
        return $result;
    }
    public static function updateLike($meme_id)
    {
        $insertMemes=new Memes();
        $ratings=new Ratings();
        $userID=$_SESSION['userID'];
        $selObj=$ratings->selectPrepare();
        $getRating=$selObj->selectColumns(['rating'])->where(['user_id='=>'? and ','memes_id='=>'?'])->fetch([$userID,$meme_id]);
        if ($getRating==null) {
            $ratings->insert(['memes_id'=>"$meme_id",'user_id'=>"$userID",'rating'=>'1']);
            $insertMemes->update(['likes'=>'likes+1'], 'id=?', ["$meme_id"]);
        }
        else {
        }

    }
    public static function updateDislike($meme_id)
    {
        $ratings=new Ratings();
        $insertMemes=new Memes();
        $userID=$_SESSION['userID'];
        $selObj=$ratings->selectPrepare();
        $getRating=$selObj->selectColumns(['rating'])->where(['user_id='=>'? and ','memes_id='=>'?'])->fetch([$userID,$meme_id]);
        if ($getRating==null && $getRating!='1') {
            $ratings->insert(['memes_id'=>"$meme_id",'user_id'=>"$userID",'rating'=>'0']);
            $insertMemes->update(['dislikes'=>'dislikes+1'], 'id=?', ["$meme_id"]);
        }
        else {

        }
        $selObj2=$insertMemes->selectPrepare();
        $dislikes=$selObj2->selectColumns(['dislikes'])->where(['memes_id='=>'?'])->fetch([$meme_id]);
        return $dislikes['dislikes'];
    }
    public static function getLikesDislikes($meme_id)
    {
        $insertMemes=new Memes();
        $selObj2=$insertMemes->selectPrepare();
        $likes=$selObj2->selectColumns(['likes','dislikes'])->where(['memes_id='=>'?'])->fetchAll([$meme_id]);
        return $likes;
    }
    public static function getCountPages()
    {
        $selectMemes=new Memes();
        $selObj=$selectMemes->selectPrepare();
        //$result=$selObj->selectColumns(['*'])->fetchAll(null);
        $countPages=
            $selObj->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
            ->from(['users'])->where(['memes.user_id='=>'users.id'])
            ->order('memes.date_create', 'DESC')->fetchAll(null);
        if ($countPages!=null){
            $countPages=ceil(count($countPages)/self::$memesOnPage);
        }
        return $countPages;
    }
    public static function limitPages($page)
    {
        $memesOnPage=3;
        $end=$memesOnPage*$page;
        $begin=$end-$memesOnPage+1;
        echo "begin=".$begin."<br>end=".$end;
        /*self::$page=$begin.",".$end;
        return self::$page;*/
    }
}
