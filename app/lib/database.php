<?php
/**
 * Created by PhpStorm.
 * User: developermohamed
 * Date: 09/12/17
 * Time: 10:02 م
 */

namespace MVC\LIB;


class Database extends \PDO
{
    private $engine;
    private $host;
    private $database;
    private $user;
    private $pass;

    public function __construct()
    {
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'konfiza';
        $this->user = 'root';
        $this->pass = '';
        $dns = $this->engine.':dbname='.$this->database.";host=".$this->host;
        $connection = parent::__construct($dns,$this->user,$this->pass,array(
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
        ));
        
        return $connection;
    }
}