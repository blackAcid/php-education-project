<?php
class View
{
    public function display($content, $data = array())
    {
        $module = Registry::getValue('module');
        include DIR."/template.php";
    }
}
