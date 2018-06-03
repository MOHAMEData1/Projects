<?php

/**
 * Created by PhpStorm.
 * User: developermohamed
 * Date: 03/12/17
 * Time: 10:09 م
 */
namespace MVC\Models;

class AbstractModel
{

    const   DATA_TYPE_BOOL = \PDO::PARAM_BOOL;
    const   DATA_TYPE_STR = \PDO::PARAM_STR;
    const   DATA_TYPE_INT = \PDO::PARAM_INT;
    const   DATA_TYPE_DECIMAL = 4;
    private static $db;
    //public static $primaryKey = 'id';

    protected function prepareValues(\PDOStatement &$stmt)
    {
        foreach (static::$tableSchema as $columnName => $type) {
            if ($type == 4) {
                $sanitizedValue = filter_var($this->$columnName, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $stmt->bindValue(":{$columnName}", $sanitizedValue);
            } else {
                $stmt->bindValue(":{$columnName}", $this->$columnName, $type);
            }

        }
    }

    private static function buildNamesParamSQL()
    {
        $namedParam = '';
        foreach (static::$tableSchema as $columnName => $type) {
            $namedParam .= $columnName . '= :' . $columnName . ',';
        }
        //echo trim($namedParam,',');
        return trim($namedParam, ',');
    }


    // create function
    private function create()
    {
        global $connection;
        $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::buildNamesParamSQL();
        $stmt = $connection->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
        //echo  $sql;
    }

    private function update()
    {
        global $connection;
        $sql = 'UPDATE ' . static::$tableName . ' SET ' . $this->buildNamesParamSQL() . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = $connection->prepare($sql);
        $this->prepareValues($stmt);
        return $stmt->execute();
    }

    public function delete()
    {
        global $connection;
        $sql =  "DELETE FROM " .static::$tableName . ' WHERE ' . static::$primaryKey . ' = ' . $this->{static::$primaryKey};
        $stmt = $connection->prepare($sql);
        return $stmt->execute();
    }

    public static function getAll()
    {
        global $connection;
        $sql = 'SELECT * FROM ' . static::$tableName;
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        $result =  $stmt->fetchAll(\PDO::FETCH_CLASS  ,get_called_class());

        return (is_array($result) && !empty($result)) ? $result : false;
    }

    public static function getAllByPK($pk)
    {
        global $connection;
        $sql = 'SELECT * FROM ' . static::$tableName  .' WHERE ' . static::$primaryKey . ' = ' . $pk;
        $stmt = $connection->prepare($sql);
        if ($stmt->execute() === true) {
            $obj = $stmt->fetchAll(\PDO::FETCH_CLASS, get_called_class());
            $obj = array_shift($obj);
            return $obj;
        }

        return false;

    }
    public  static  function getNumberRow(){
        global $connection;
        $sql = "SELECT count(*) FROM " . static::$tableName;
        $stmt = $connection->prepare($sql);

        if ($stmt->execute() === true) {
            return $stmt->fetchColumn();
        }
        return false;
    }

    public function save(){

        global $connection;

        return ($this->{static::$primaryKey} === null) ? $this->create() :$this->update();
    }


    public static function get($sql,$options = array()){
        global $connection;

        $stmt = $connection->prepare($sql);
        if(!empty($options)){
            foreach ($options as $columnName => $type){
                if($type[0] === 4 ){
                    $sanitizedValue = filter_var($type[1],FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $stmt->bindValue(":{$columnName}",$sanitizedValue);
                }else{
                    $stmt->bindValue(":{$columnName}",$type[1],$type[0]);
                }
            }
        }

        $stmt->execute();
        $result =  $stmt->fetchAll(\PDO::FETCH_CLASS ,get_called_class());

        return (is_array($result) && !empty($result)) ? $result : false;

    }


}