<?php
require_once 'bootstart.php';
use Core;
try
{
    $req=new Request();
    FrontController::dispatch($req);
}
catch (Exception $e)
{
    die($e->getMessage());
}