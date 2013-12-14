<?php
/**
 * Created by PhpStorm.
 * User: anna
 * Date: 10.12.13
 * Time: 15:12
 */

namespace modules\user\model;

use core\classTables\Users;

class UserModel
{
    public static function login()
    {
        $email='name1@mail';
        $password='12345';
        $selectUser=new Users();
        $selObj=$selectUser->selectPrepare();
        $user=$selObj->selectColumns(['id'])->where(['email='=>'? and ', 'password='=>'?'])
            ->fetch(["$email", "$password"]);
        return $user;
    }
}
