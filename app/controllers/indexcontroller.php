<?php
/**
 * Created by PhpStorm.
 * User: developermohamed
 * Date: 09/12/17
 * Time: 05:32 م
 */

namespace MVC\Controllers;


use MVC\LIB\Helper;
use MVC\LIB\Validate;
use MVC\Models\AdminModel;
use MVC\Models\DepartmentsModel;
use MVC\Models\MessagesModel;
use MVC\Models\Private_Afak_GallaryModel;
use MVC\Models\ProjectsModel;
use MVC\Models\SettingsModel;
use MVC\Models\TypesModel;
use MVC\Models\WorkersModel;

class IndexController extends AbstractController
{
    use Validate;
    use Helper;

    public function defaultAction(){
        $this->_data['men'] = AdminModel::getMenNumber();
        $this->_data['women'] = AdminModel::getMenNumber();
        if(isset($_SESSION['user'])){
            $ad = (json_decode(json_encode($_SESSION['user']), true));
            $this->_data['userName']=$ad[0]['name'];
        }


        return $this->_view();
    }


}