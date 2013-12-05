<?php
class IndexController
{
    public function indexAction()
    {
        $v = new View();
        $v -> display('home.php');
        //DefaultModel::printDb();
        //DefaultModel::insertUsers();
        //DefaultModel::deleteUsers();
        //DefaultModel::updateUsers();
        //DefaultModel::selectUsers();
        //DefaultModel::selectRoles();
    }
}
