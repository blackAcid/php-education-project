<?php
namespace modules\user\model;

use core\classTables\Users;
use core\classTables\Memes;

class User
{
    public $id;
    public $login;
    public $email;
    public $date_of_birth;
    public $role;
    public $avatar;
    public $paths_to_my_memes;

    public function profile($user_id)
    {
        $this->id = $user_id;
        $selectUser = new Users();
        $select_User_Object = $selectUser->selectPrepare();
        $this->login = $select_User_Object->where(['id='=>"$this->id"])->selectColumns(['login'])->fetch();
        $this->email = $select_User_Object->where(['id=' => "$this->id"]) -> selectColumns(['email'])->fetch();
        $this->date_of_birth = $select_User_Object->where(['id=' => "$this->id"]) -> selectColumns(['date_of_birth'])->fetch();
        $this->role = $select_User_Object->where(['id=' => "$this->id"]) -> selectColumns(['role'])->fetch();
        $this->avatar = $select_User_Object->where(['id=' => "$this->id"]) -> selectColumns(['avatar'])->fetch();
        $selectMemes = new Memes();
        $select_Memes_Object = $selectMemes->selectPrepare();
        $this->paths_to_my_memes = $select_Memes_Object->where(['user_id='=>"$this->id"])->selectColumns(['path'])->fetchAll();
    }

    public function changeProfile($user_id)
    {

    }
}