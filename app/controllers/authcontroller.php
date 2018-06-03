<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 04/01/2018
 * Time: 04:18 م
 */

namespace MVC\Controllers;


use MVC\LIB\Helper;
use MVC\LIB\Messenger;
use MVC\LIB\Validate;
use MVC\Models\AdminModel;

class AuthController extends AbstractController
{

    use Helper;
    use Validate;
    public function loginAction(){

       $this->_template->swapTemplate([
           "template" => [
               ':view' => ':action_view'
           ],
           "head_resource" => [
               'css' => [
                    'bootstrap'=>CSS.'bootstrap.rtl.css',
                   'login'=> CSS . 'login.css'
               ]

           ],
           'footer_resource' => [
               'js' => [
                   'jquery'=> JS .'jquery-1.9.1.js',
                   'bootstrap'=>JS.'bootstrap.min.rtl.js',
                    'login' => JS.'login.js'
               ]
           ]

       ]);

        if(isset($_POST['login'])){

            $loginAdim = AdminModel::authenticate($_POST['email'],$_POST['password'],$_SESSION);

            if($loginAdim){
                $this->redirect("/");
            }else{
               $this->_messenger->add('من فضلك ادخل البيانات صحيحه',Messenger::APP_MESSAGE_ERROR);
            }

        }
        return $this->_view();
    }
    public function registerAction(){

        $this->_template->swapTemplate([
            "template" => [
                ':view' => ':action_view'
            ],
            "head_resource" => [
                'css' => [
                    'bootstrap'=>CSS.'bootstrap.rtl.css',
                    'login'=> CSS . 'login.css'
                ]

            ],
            'footer_resource' => [
                'js' => [
                    'jquery'=> JS .'jquery-1.9.1.js',
                    'bootstrap'=>JS.'bootstrap.min.rtl.js',
                    'login' => JS.'login.js'
                ]
            ]

        ]);

        if(isset($_POST['register'])){

            /// variables in $_post
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $mobile = $_POST['mobile'];
            $type = $_POST['type'];
            $count = 0;
            if(!($this->req($name)&& (!$this->num($name)))){
                $count++;
                $this->_messenger->add('من فضلك اكتب الاسم صحيح',Messenger::APP_MESSAGE_ERROR);
            }
            if(!($this->req($email) && $this->email($email))){
                $count++;
                $this->_messenger->add('من فضلك اكتب الاميل صحيح',Messenger::APP_MESSAGE_ERROR);
            }

            if(!($this->eq($password,$confirm_password) && $this->req($password) && $this->req($confirm_password))){
                $count++;
                $this->_messenger->add('من فضلك اكتب كلمه المرور متشابهه',Messenger::APP_MESSAGE_ERROR);
            }

            if(!($this->req($mobile))){
                $count++;
                $this->_messenger->add('من فضلك اكتب رقم الموبايل  صحيح',Messenger::APP_MESSAGE_ERROR);
            }


            if($count==0){
                $user  = AdminModel::registerFunction($_POST['name'],$_POST['email'],$_POST['password'],$_POST['mobile'],$_POST['type'],$_SESSION);
                if($user){
                    $this->redirect('/');
                }
            }

        };
        $this->_view();
    }
    public function updateAction(){
        $this->isAdmin();
        //$id = $this->$this->_params[0];
        $ad = (json_decode(json_encode($_SESSION['admin']), true));
        //echo $ad[0]['id'];
        $id = $ad[0]['id']; 

        $admin = AdminModel::getAllByPK($id);

        if(!$admin){
            $this->_messenger->add("من فضلك لا تتلاعب في ال url واضغط من لوحه التحكم فقط ");
        }

        $this->_data['admin'] = $admin;


        if(isset($_POST['submit'])){
            $count = 0;
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];




            if(!($this->req($name) && $this->alpha($name))){
                $count++;
                $this->_messenger->add("من فضلك ادخل الاسم صحيح مكون من حروف فقط",Messenger::APP_MESSAGE_ERROR);
            }

            if(!($this->req($email) && $this->email($email))){
                $count++;
                $this->_messenger->add("من فضلك ادخل الاميل صحيح ",Messenger::APP_MESSAGE_ERROR);
            }

            if($count == 0){
                if($this->alpha($password) != ""){

                    AdminModel::updateAdminUsingPassword($name,$email,$password,$id);
                    $this->_messenger->add("تم تعديل بنجاح");
                }else {

                    AdminModel::updateAdmin($name, $email, $id);
                    $this->_messenger->add("تم تعديل بنجاح");
                }
            }


        }
        $this->_view();


    }
    public function logoutAction(){

        session_unset();
        session_destroy();
        $this->redirect('/auth/login');
    }

}