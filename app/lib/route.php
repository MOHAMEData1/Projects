<?php
/**
 * Created by PhpStorm.
 * User: developermohamed
 * Date: 09/12/17
 * Time: 04:34 م
 *
 * this class responsible for
 */

namespace MVC\LIB;


use MVC\LIB\Messenger;

class Route
{
    const  NOT_FOUND_ACTION = 'notFoundAction';
    const NOT_FOUND_CONTROLLER = 'MVC\Controllers\\NotFoundController';
    private $_controller = 'index';
    private $_action = 'default';
    private $_params =array();
    protected $_template;
    protected $_messenger;

    public function __construct(Template $template, Messenger $messenger)
    {
        $this->_template = $template;
        $this->_messenger = $messenger;
        $this->parseURL();
    }
    private function parseURL(){
        $url =  explode('/',trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),'/'),3);
        if($url[0] != ''){
            $this->_controller = $url[0];
        }

        if(isset($url[1])  && $url[1]  !=  ''){
            $this->_action = $url[1];
        }
        if(isset($url[2]) && $url[2] != ''){
            $this->_params = explode('/',$url[2]);
        }

    }

    /*
     * check about the controller if is found
     * check if method exist in the this class
     * return run of function
     * */
    public function dispatch(){

        // get class name from controllers
        $controllerClassName =  'MVC\Controllers\\'. ucfirst($this->_controller) . 'Controller';
        $actionName = $this->_action . 'Action';
        //var_dump(new $controllerClassName());
        if(!class_exists($controllerClassName)){
            $controllerClassName = self::NOT_FOUND_CONTROLLER;
        }
        $controller = new $controllerClassName();
        if(!method_exists($controller, $actionName)){
            $this->_action = $actionName = self::NOT_FOUND_ACTION;
        }

        $controller->setController($this->_controller);
        $controller->setActionName($this->_action);
        $controller->setParams($this->_params);
        $controller->setTemplate($this->_template);
        $controller->setMessenger($this->_messenger);
        //$controller->setMessenger($this->_messenger);


        $controller->$actionName();

    }
}