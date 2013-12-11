<?php
namespace modules\user\model;

use core\classTables\Users;
use core\classTables\Memes;

class User
{
    public $id;
    public $username;
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
        $this->username = $select_User_Object->where(['id='=>"$this->id"])->selectColumns(['username'])->fetch();
        $this->email = $select_User_Object->where(['id=' => "$this->id"]) -> selectColumns(['email'])->fetch();
        $this->date_of_birth = $select_User_Object->where(['id=' => "$this->id"]) -> selectColumns(['date_of_birth'])->fetch();
        $this->role = $select_User_Object->where(['id=' => "$this->id"]) -> selectColumns(['role'])->fetch();
        $this->avatar = $select_User_Object->where(['id=' => "$this->id"]) -> selectColumns(['avatar'])->fetch();
        $selectMemes = new Memes();
        $select_Memes_Object = $selectMemes->selectPrepare();
        $this->paths_to_my_memes = $select_Memes_Object->where(['user_id='=>"$this->id"])->selectColumns(['path'])->fetchAll();
    }

    public function changeProfile($ChangeData, $UserId)
    {
        if(!empty($ChangeData['name']))
        {
            $UpdateUser = new Users();
            $UpdateUser->update(['username'=>$ChangeData['name']],'id='.$UserId);
        }
        if(!empty($ChangeData['email']))
        {
            $UpdateUser = new Users();
            $UpdateUser->update(['email'=>$ChangeData['email']],'id='.$UserId);
        }
        if(!empty($_FILES['userfile']['size']))
        {
            $UploadDir = DIR_PUBLIC.'images/user_avatars/';
            $UploadFile = $UploadDir . basename($_FILES['userfile']['name']);
            move_uploaded_file($_FILES['userfile']['tmp_name'], $UploadFile);
            rename($UploadFile, $UploadDir.$UserId.'_user.jpg');
            $this->avatar = $UploadDir.$UserId.'_user.jpg';
        }
    }
}