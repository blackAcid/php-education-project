<?php
class View
{
    private $path;
    private $page;
    private $include_file;
    private $variables=array();
    private $template='/template.php';
    private $module;

    private $params = array(
        'xss_protection' => true
    );


    public function __construct($module,$page)
    {
        $this->path=DIR_MOD.$module."/views/";
        $this->page=$page;
        $this->module=$module;
    }
    public function addIntoTemplate()
    {
        $this->include_file=$this->path.$this->page;
        if(!file_exists($this->include_file)){
            throw new Exception('Include file '.$this->include_file.' not exist');
        }
        return true;
    }
    public function addCssFile(){
        $links=array();
        $path_to_css="application/modules/".$this->module."/views/css/";
        if(is_dir($path_to_css)){
            $files = scandir($path_to_css);
            for($i=2;$i<count($files);$i++)
            {
                $temp='<link rel="stylesheet" type="text/css" media="screen" href="'.'http://'.$_SERVER['SERVER_NAME'].'/'.$path_to_css.$files[$i].'" />';
                $links[$i-2]=$temp;
            }
        }
        return $links;
    }

    public function addJsFile(){
        $links=array();
        $path_to_js="application/modules/".$this->module."/views/js/";
        if(is_dir($path_to_js)){
            $files = scandir($path_to_js);
            for($i=2;$i<count($files);$i++)
            {
                $temp='<script type="text/javascript" src="'.'http://'.$_SERVER['SERVER_NAME'].'/'.$path_to_js.$files[$i].'"></script>';
                $links[$i-2]=$temp;
            }
        }
        return $links;
    }

    public function assign($name,$value)
    {
        $this->variables[$name]=$value;
    }

    public function __get($name)
    {
        if (isset($this->variables[$name])) {
            $variable = $this->variables[$name];

            if ($this->params['xss_protection'])
                $variable = $this->xssProtection($variable);
            return $variable;
        }

        return NULL;
    }

    private function xssProtection($variable)
    {
        if (is_array($variable)) {
            $protected = array();
            foreach ($variable as $key=>$value)
                $protected[$key] = $this->xssProtection($value);
            return $protected;
        }
        return htmlspecialchars($variable);
    }

    public function display()
    {
        require_once (DIR .$this->template);
    }
}