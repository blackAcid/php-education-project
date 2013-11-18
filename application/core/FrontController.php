<?php
class FrontController
{
    /**
     * @var FrontController
     */
    static protected $instance;
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getControllerPath($controller, $module)
    {
        $file=DIR_MOD.$module.'/controllers/'.$controller.'.php';
        if (!file_exists($file)) {
            throw new Exception("File not found");
        }
        return $file;
    }
    public function getControllerClass($controller, $controller_file)
    {
        require_once $controller_file;
        $class=$controller.'Controller';
        if (!class_exists($class)) {
            throw new Exception("Class not found");
        }
        return new $class;
    }
    public function getControllerMethod($controller_class, $action, $controller_file)
    {
        require_once $controller_file;
        if (!method_exists($controller_class, $action)) {
            throw new Exception("Method not found");
        }
        return $controller_class->$action();
    }

    public static function dispatch(Request $request)
    {
        $module=$request->getModule();
        Registry::setValue($module, 'module');
        $controller= ucfirst($request->getController());
        $action=$request->getAction().'Action';
        $controller_file=self::getInstance()->getControllerPath($controller, $module);
        $controller_class=self::getInstance()->getControllerClass($controller, $controller_file);
        self::getInstance()->getControllerMethod($controller_class, $action, $controller_file);
    }
}
