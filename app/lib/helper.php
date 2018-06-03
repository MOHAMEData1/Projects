<?php
/**
 * Created by PhpStorm.
 * User: developermohamed
 * Date: 10/12/17
 * Time: 12:39 ص
 */

namespace MVC\LIB;


trait Helper
{


    public function redirect($page){

        session_write_close();
        header('Location: '.$page);
        exit;
    }
    public function isAdmin(){
        if(!isset($_SESSION['admin'])){
            return $this->redirect('/');
        }
    }


}