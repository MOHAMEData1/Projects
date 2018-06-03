<?php
/**
 * Created by PhpStorm.
 * User: developermohamed
 * Date: 09/12/17
 * Time: 02:18 م
 */

namespace MVC\LIBS;

class Autoload
{
    /*
     * remove main name space 'MVC'
     * get the file
     * return file that will require
     * */
    public static function autoload($className){

        //Remove Main Namespace

        $className =    str_replace('MVC','',$className);
        $className =    str_replace('\\','/',$className);
        $className =$className.'.php';
        $className = strtolower($className);
        //echo $className;
        if(file_exists(APP_PATH.$className)){
            require_once APP_PATH.$className;

        }
    }
}

spl_autoload_register(__NAMESPACE__.'\Autoload::autoload');