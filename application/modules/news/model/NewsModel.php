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
use core\classTables\Subscription;
use core\classTables\Users;
use modules\user\model\User;

class NewsModel
{
    static private $memesOnPage;

    public static function getMemes($startFrom)
    {
        $selectMemes = new Memes();
        $selObj = $selectMemes->selectPrepare();
        $result = $selObj
        ->selectColumns(['user_id', 'username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
        ->from(['users'])->where(['memes.`user_id`=' => 'users.`id`'])->order('memes.`date_create`', 'DESC')
        ->limit($startFrom, 5)->fetchAll(null);
        return $result;
    }

    public static function getMemesByRating($startFrom)
    {
        $selectMemes = new Memes();
        $selObj = $selectMemes->selectPrepare();
        $result = $selObj
            ->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
            ->from(['users'])->where(['memes.user_id=' => 'users.`id`'])->order('likes', 'DESC')
            ->limit($startFrom, 5)->fetchAll(null);
        return $result;
    }

    public static function userRating()
    {
        $ratings = new Ratings();
        if (!empty($_SESSION['id'])) {
            $userID = $_SESSION['id'];
            $selObj = $ratings->selectPrepare();
            $getRating = $selObj->selectColumns(['memes_id'])->where(['user_id=' => '?'])
                ->fetchAll([$userID]);
            return $getRating;
        } else {
            return;
        }
        /*$selObj=$ratings->selectPrepare();
        $getRating=$selObj->selectColumns(['memes_id'])->where(['user_id='=>'?'])
            ->fetchAll([$userID]);
        return $getRating;*/
    }
    public static function userSubs($startFrom)
    {
        $selectSubs = new Subscription();
        $selObj = $selectSubs->selectPrepare();
        $result = $selObj
        ->selectColumns(['username', 'name', 'path', 'likes', 'dislikes', 'memes.date_create', 'memes.id'])
        ->join('inner', 'memes', 'target_id', 'user_id')->join('inner', 'users', 'users.`id`', 'memes.`user_id`')
        ->where(['subscription.`user_id`=' => $_SESSION['id']])->order('memes.`date_create`', 'DESC')
        ->limit($startFrom, 5)
        ->fetchAll(null);
                    //->limit($startFrom, 5)
        return $result;
    }
    public static function topUsers()
    {
        $selUsers = new Users();
        $selObj1 = $selUsers->selectPrepare();
        $users = $selObj1->selectColumns(['username', 'avatar','MAX(likes)'])->join('inner', 'memes', 'id', 'user_id')
            ->where(['year(memes.`date_create`)=' => 'year(now()) and',
                'week(memes.`date_create`)=' => '(week(now(),7)-1)'])
        ->group('username')->order('MAX(likes)', 'desc')->fetchAll(null);
        return $users;
    }
}
