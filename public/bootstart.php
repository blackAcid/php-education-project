<?php

define('DIR', realpath(__DIR__));
define('DIR_CORE', DIR.'/application/core/');
define('DIR_MOD', DIR.'/application/modules/');
define('DIR_TABLES',DIR_CORE.'classTables/');
function __autoload($file) {
     $file=DIR_CORE.$file.'.php';
     require_once ($file);
}

