<?php

define('DIR', realpath(__DIR__));
define('DIR_CORE','../application/core/');
define('DIR_MOD', '../application/modules/');
function __autoload($file) {
     $file=DIR_CORE.$file.'.php';
     require_once ($file);
}
