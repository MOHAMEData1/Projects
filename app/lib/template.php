<?php

namespace MVC\LIB;


class Template
{

    public $_templateParts;
    public $_action_view;
    private $_data;
    private $_messenger;
    public function __construct($templateParts)
    {
        $this->_templateParts = $templateParts;
    }
    public function setActionViewFile($actionViewPath){
        $this->_action_view = $actionViewPath;
    }
    public function setAppData($data){
        $this->_data = $data;
    }
    public function swapTemplate($template){
        $this->_templateParts = $template;
    }
    public function setMessenger($messenger){
        $this->_messenger = $messenger;
    }

    private function renderTemplateHeadStart(){
        extract($this->_data);
        if(isset($_SESSION['admin'])){
            require_once TEMPLATE_PATH .'admin' .DS. 'adminstarthead.php';
        }else{
            require_once TEMPLATE_PATH .'templateheadstart.php';
        }
    }

    private function renderTemplateHeadEnd(){
        require_once TEMPLATE_PATH .'templateheadend.php';
    }

    private function renderWrapperEndForAdmin(){
        require_once TEMPLATE_PATH .'templatefotter.php';
    }
    private function renderTemplateFooter(){
        require_once TEMPLATE_PATH .'templatefotter.php';
    }

    /*
     * it responsible for render ex nav , header , footer content , etc
     * */
    private function templatesBlockFiles()
    {
        extract($this->_data);
        if(array_key_exists('template',$this->_templateParts)){
            $parts = $this->_templateParts['template'];
            if(!empty($parts)){
                foreach ($parts as $partKey => $file){
                    if($partKey == ':view'){
                        require_once $this->_action_view;
                    }else{
                        require_once $file;
                    }
                }
            }

        }else{
            //trigger_error("sorry",E_USER_ERROR);
        }

    }

    /*
     * render header resources , css files
     * **/

    private function renderHeadResources(){
        $output = '';

        if(array_key_exists('head_resource',$this->_templateParts)){
            $resources = $this->_templateParts['head_resource'];
            $css = $resources['css'];
            if(!empty($css)){
                foreach ($css as $cssKey => $path){
                    $output .= '<link type = "text/css" rel = "stylesheet" href = "'.$path. '" >';
                }
            }

        }else{
            //trigger_error("sorry error in css files",E_USER_ERROR);
        }

        echo $output;
    }

    private function renderFooterResources(){
        $output = '';
        if(array_key_exists('footer_resource',$this->_templateParts)){
            $resources = $this->_templateParts['footer_resource'];
            $js = $resources['js'];
            if(!empty($js)){
                foreach ($js as $jsKey => $path){
                    $output .= '<script src="'.$path.'"></script>';
                }
            }
        }else{
            //trigger_error("sorry error in css files",E_USER_ERROR);
        }

        echo $output;
    }

    public function showValue($filedName,$object=null){
        return isset($_POST[$filedName])? $_POST[$filedName] : (is_null($object)? '' : $object->$filedName);
    }

    /*
     *
     * */
    public function renderApp(){
        extract($this->_data);
        $this->renderTemplateHeadStart();
        /*
         * css files
         * */
        $this->renderHeadResources();
        $this->renderTemplateHeadEnd();
        if(isset($_SESSION['admin'])){

            extract($this->_data);
            require_once TEMPLATE_PATH . 'admin' .DS. 'wripperstart.php';
        }

        /**
         * fully page
        */
         $this->templatesBlockFiles();

        if(isset($_SESSION['admin'])){
            require_once TEMPLATE_PATH . 'admin' .DS. 'wripperend.php';
        }

        /*
        * js files
        */
        $this->renderFooterResources();
        // it is footer
        $this->renderTemplateFooter();
    }

}