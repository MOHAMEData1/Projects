<?php
/**
 * Created by PhpStorm.
 * User: developermohamed
 * Date: 09/12/17
 * Time: 06:14 م
 */

namespace MVC\Controllers;


use MVC\LIB\Route;

class AbstractController
{
    public $_controller;
    public $_action;
    public $_params;
    protected $_template;
    protected $_messenger;

    protected $_data = [];
    public function notFoundAction(){
       return $this->_view();
    }

    public function setController($controller){
        $this->_controller = $controller;
    }

    public function setActionName($actionName){
        $this->_action = $actionName;
    }

    public function setParams($params){
        $this->_params = $params;
    }

    public function setTemplate($template){
        $this->_template = $template;
    }
    public function setMessenger($messenger){
        $this->_messenger = $messenger;
    }





    protected function _view(){

        if($this->_action == Route::NOT_FOUND_ACTION){
            require_once VIEW_PATH.'notfound'.DS.'notfound.view.php';
        }
        else
        {
            $view = VIEW_PATH . $this->_controller . DS . $this->_action . '.view.php';
            if(file_exists($view)){
                $this->_data = array_merge($this->_data);
                $this->_template->setActionViewFile($view);
                $this->_template->setAppData($this->_data);
                $this->_template->setMessenger($this->_messenger);
                $this->_template->renderApp();

            }else{

                require_once VIEW_PATH.'notfound'.DS.'notexsits.view.php';

            }
        }
    }
}