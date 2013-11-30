<?php
require_once 'bootstart.php';
try
{
    $req=new Request();
    FrontController::dispatch($req);
    /******
     * example
     ****/
    $roles=new roles();
    $sel=$roles->selectPrepare();
    $result=$sel->select(['*'])->fetchAll(null);
    echo "<br><pre>";
    var_dump($result);
}
catch (Exception $e)
{
    die($e->getMessage());
}