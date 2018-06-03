<?php
/**
 * Created by PhpStorm.
 * User: Mohamed
 * Date: 04/01/2018
 * Time: 04:20 م
 */

namespace MVC\Models;


class AdminModel extends AbstractModel
{

    public $id;
    public $name;
    public $email;
    public $password;
    public $mobile;
    public $type;

    protected static $tableName = 'users';


    protected static $tableSchema = array(
        'id'                => self::DATA_TYPE_INT,
        'name'              => self::DATA_TYPE_STR,
        'password'          => self::DATA_TYPE_STR,
        'email'             => self::DATA_TYPE_STR,
        'mobile'             => self::DATA_TYPE_STR,
        'type'               => self::DATA_TYPE_STR,
    );
    protected static $primaryKey = 'id';

    public function cryptPassword($password)
    {
        $this->Password = crypt($password, APP_SALT);
    }

    public static function authenticate ($email, $password, $session)
    {
        $password = crypt($password, APP_SALT) ;
        $sql = 'SELECT * FROM ' . self::$tableName . ' WHERE email = "' . $email . '" AND password = "' .  $password . '"';
        $foundUser = self::get($sql);
        if(false !== $foundUser) {
            $session = $foundUser;
            $_SESSION['user'] = $session;
            return 1;
        }
        return false;
    }

    public static function registerFunction($name,$email,$password,$mobile,$type,$session){
        global  $connection;
        $password = crypt($password, APP_SALT) ;
        $sql = "INSERT INTO users SET name = '$name', email = '$email', password = '$password', mobile = '$mobile', type = '$type'";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $lastId = $connection->lastInsertId();
        ///// get user to set session
        $sqlUser = "SELECT * FROM users WHERE id = '$lastId'";
        $foundUser = self::get($sqlUser);
        if(false !== $foundUser) {
            $session = $foundUser;
            $_SESSION['user'] = $session;
            return 1;
        }
        return false;
    }


    public static function getMenNumber(){
        global $connection;
        $sql = "SELECT count(*) FROM " . self::$tableName . " WHERE type = '1'";
        $stmt = $connection->prepare($sql);

        if ($stmt->execute() === true) {
            return $stmt->fetchColumn();
        }
        return false;
    }

    public static function getWomenNumber(){
        global $connection;
        $sql = "SELECT count(*) FROM " . self::$tableName . " WHERE type = '0'";
        $stmt = $connection->prepare($sql);

        if ($stmt->execute() === true) {
            return $stmt->fetchColumn();
        }
        return false;
    }


}