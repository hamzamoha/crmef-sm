<?php

require_once(__DIR__ . "/Database.php");

abstract class Table
{
    private static $table;

    public function insert(array $dataArray)
    {
        $columnsArray = array_values($dataArray);
        $columns = implode(", ", $columnsArray);

        $valuesArray = array_values($dataArray);
        foreach($valuesArray as $key=>$value){
            $value = addslashes($value);
            $valuesArray[$key] = "'$value'";
        }
        $values = implode(", ", $valuesArray);
        return Database::insert($this->table, $columns, $values);
    }

    public function select($condition, $orderby)
    {
        return Database::select($this->table, $condition, $orderby);
    }

    public static function get($id)
    {
        return Database::select_by_id(get_called_class()::$table, $id);
    }
}
