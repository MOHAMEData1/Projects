<?php

namespace MVC;
use MVC\LIB\Database;
use MVC\LIB\Messenger;
use MVC\LIB\Route;
use MVC\LIB\Template;
use MVC\LIB\SessionManager;

if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}
require_once '..' . DS . 'app' . DS . 'config'. DS. 'config.php';

$template_parts = require_once  '..' . DS . 'app' . DS . 'config'. DS. 'templateconfig.php';

require_once  APP_PATH . DS . 'lib'.DS.'autoload.php';




$connection = new Database();

$session = new SessionManager();
$messenger = Messenger::getInstance($session);
$template = new Template($template_parts);


$front = new Route($template,$messenger);
$front->dispatch();
?>

