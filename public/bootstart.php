<?php
use core\Registry as Registry;
define('ROOT', str_replace('\\','/',dirname(__DIR__)));
define('DIR_PUBLIC',ROOT.'/public/');
define('DIR_CORE', ROOT.'/application/core/');
define('DIR_APP', ROOT.'/application/');
define('DIR_MOD', ROOT.'/application/modules/');
define('DIR_TABLES',DIR_CORE.'classTables/');

function __autoload($file){
    $file = str_replace('\\', '/', $file);
    $file = DIR_APP . $file . '.php';
        require_once($file);
}

/**
 * Проверить настроен ли в VirtualHost DOCUMENT_ROOT
 */
function isConfiguredDocRoot()
{
    $arr=explode('/', ROOT);
    if(is_array($arr) && $arr!==null)
    {

        Registry::setValue(array_pop($arr).'/public/','rootDirName');
    }
    $match=strstr(Registry::getValue('rootDirName'),$_SERVER['DOCUMENT_ROOT']);
    if($match)
    {
        return true;
    }
    else
    {
        return false;
    }
}
