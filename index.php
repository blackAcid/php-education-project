<?php
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