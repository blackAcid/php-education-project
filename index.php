<?php
//ini_set('display_errors',1);
require_once 'bootstart.php';
try
{
    $req=new Request();
    FrontController::dispatch($req);
}
catch (Exception $e)
{
    die($e->getMessage());
}