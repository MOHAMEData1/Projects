<?php

if(!defined('DS')){
    define('DS',DIRECTORY_SEPARATOR);
}
// Real Path to directly name 'app'
define('APP_PATH' ,dirname(realpath(__FILE__)) . DS . '..');

define('VIEW_PATH' ,APP_PATH.DS.'views'.DS);
define('TEMPLATE_PATH' ,APP_PATH.DS.'template'.DS);
define('ADMIN' ,'/admin/');
define('CSS' ,'/css/');
define('JS' ,'/js/');
define('IMAGE','/image/');

// Session configuration
defined('SESSION_NAME')     ? null : define ('SESSION_NAME', '_ESTORE_SESSION');
defined('SESSION_LIFE_TIME')     ? null : define ('SESSION_LIFE_TIME', 0);
defined('SESSION_SAVE_PATH')     ? null : define ('SESSION_SAVE_PATH', APP_PATH . DS . '..' . DS . 'sessions');


defined('APP_SALT')     ? null : define ('APP_SALT', '$2a$07$yeNCSNwRpYopOhv0TrrReP$');

// for upload
defined('UPLOAD_STORAGE')     ? null : define ('UPLOAD_STORAGE', APP_PATH . DS . '..' . DS . 'public' . DS . 'uploads');
defined('IMAGES_UPLOAD_STORAGE')     ? null : define ('IMAGES_UPLOAD_STORAGE', UPLOAD_STORAGE . DS . 'images');
defined('DOCUMENTS_UPLOAD_STORAGE')     ? null : define ('DOCUMENTS_UPLOAD_STORAGE', UPLOAD_STORAGE . DS . 'documents');
defined('MAX_FILE_SIZE_ALLOWED')     ? null : define ('MAX_FILE_SIZE_ALLOWED', ini_get('upload_max_filesize'));

