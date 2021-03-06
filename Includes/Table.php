<?php

require_once(__DIR__ . "/Database.php");

abstract class Table
{
    private static $table;

    public static function insert(array $dataArray): false|Row
    {
        $columnsArray = array_keys($dataArray);
        $columns = implode(", ", $columnsArray);

        $valuesArray = array_values($dataArray);
        foreach ($valuesArray as $key => $value) {
            $value = addslashes($value);
            $valuesArray[$key] = "'$value'";
        }
        $values = implode(", ", $valuesArray);
        $id = Database::insert(get_called_class()::$table, $columns, $values);
        if ($id) return get_called_class()::get($id);
        else return false;
    }

    public static function select(string $condition = "TRUE", string $orderby = "1", string $sort = "DESC"): array|false
    {
        return Database::select(get_called_class()::$table, $condition, $orderby, $sort);
    }

    public static function get(int $id): Row|false
    {
        return Database::select_by_id(get_called_class()::$table, $id);
    }

    public static function update(int $id, array $dataArray): bool|Throwable
    {
        return Database::update(get_called_class()::$table, $dataArray, "id='$id'");
    }

    public static function count(string $condition = "TRUE"): int|false
    {
        return Database::count(get_called_class()::$table, $condition);
    }

    public static function truncate(): bool
    {
        return Database::truncate(get_called_class()::$table);
    }

    public static function delete(string $condition = "FALSE")
    {
        return Database::delete(get_called_class()::$table, $condition);
    }

    public static function paginate(int $page = 1, int $perpage = 20, string $condition = "TRUE", string $orderby = "1", string $sort = "DESC")
    {
        return Database::paginate(get_called_class()::$table, $condition, $orderby, $sort, $perpage, $page);
    }
}
