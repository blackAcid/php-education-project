<?php
namespace modules\user\model;
use core\classTables\Roles;
use core\classTables\Users;
use core\DataBase;
use \PDO;

class UserDAO
{
    private $dbConnect;

   public function __construct(){
       $database=new DataBase();
       $this->dbConnect=$database->db;
   }



    public function isUserExists(User $user){
       /* $sql = 'SELECT username FROM users WHERE username = :username AND password = :password';
        $sth = $this->dbConnect->prepare($sql, array(PDO::FETCH_ASSOC));
        $sth->execute(array(':username' => $user->login, ':password' => $user->password));
        $result = $sth->fetchAll();
        return $result;*/
        $selectUser=new Users();
        $selObj=$selectUser->selectPrepare();
        $resultRowSet=$selObj->where(['username '=>$user->login,'and password='=>$user->password])
            ->select(['username'])->fetchAll();
        print_r($resultRowSet);
        return $resultRowSet;
    }

    public function insert(User $user){
        $insertUser=new Users();
        $insertUser->insert(['username'=>$user->login, 'email'=>$user->email, 'password'=>$user->password,
            'date_of_birth'=>$user->date_of_birth]);
    }


}