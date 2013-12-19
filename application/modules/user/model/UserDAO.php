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
        $sql = 'SELECT username FROM users WHERE username = :username AND password = :password';
        $sth = $this->dbConnect->prepare($sql, array(PDO::FETCH_ASSOC));
        $sth->execute(array(':username' => $user->login, ':password' => $user->password));
        $result = $sth->fetchAll();
        return $result;
    }
}