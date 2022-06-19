<?php

require_once(__DIR__ . "/Row.php");

const DATABASE_HOST = "127.0.0.1";
const DATABASE_USERNAME = "root";
const DATABASE_PASSWORD = "";
const DATABASE_NAME = "class_db";

class Database
{
    private static function connect(): mysqli
    {
        return new mysqli(DATABASE_HOST, DATABASE_USERNAME, DATABASE_PASSWORD, DATABASE_NAME);
    }

    public static function select(string $table, string $condition = "TRUE", string $orderby = "1", string $sort = "DESC"): array|false
    {
        // Build Query
        $query = "SELECT * FROM $table WHERE $condition ORDER BY $orderby $sort";

        // MySQL Connect
        $db = get_called_class()::connect();

        // Get Result
        if (!($res = $db->query($query)))
            return false;

        // Close MySQL Connection
        $db->close();

        // Initialize Data Array
        $data = array();

        while ($row = $res->fetch_object()) {
            $row = new Row($row, $table);
            array_push($data, $row);
        }

        return $data;
    }

    public static function insert(string $table, string $columns, string $data): bool|int
    {
        // Build Query
        $query = "INSERT INTO $table($columns) VALUES ($data)";

        // MySQL Connect
        $db = get_called_class()::connect();

        // Get Result
        if (!($res = $db->query($query)))
            return false;

        // Get Last Inserted Id
        $id = $db->insert_id;

        // Close MySQL Connection
        $db->close();

        return $id;
    }

    public static function select_by_id(string $table, int $id): Row|false
    {
        // Build Query
        $query = "SELECT * FROM $table WHERE id=$id";

        // MySQL Connect
        $db = get_called_class()::connect();

        // Get Result
        if (!($res = $db->query($query)))
            return false;

        // Close MySQL Connection
        $db->close();

        // Check If Exist
        if ($res->num_rows == 0) return false;

        // Get The Object
        $row = $res->fetch_object();
        $row = new Row($row, $table);

        return $row;
    }

    public static function delete(string $table, string $condition = "FALSE"): bool
    {
        // Build Query
        $query = "DELETE FROM $table WHERE $condition";

        // MySQL Connect
        $db = get_called_class()::connect();

        // Get Result
        if (!($res = $db->query($query)))
            return false;

        // Close MySQL Connection
        $db->close();

        return true;
    }

    public static function delete_by_id(string $table, int $id): bool
    {
        return get_called_class()::delete($table, "id=$id");
    }

    public static function update(string $table, array $dataArray, string $condition = "FALSE"): bool|Throwable
    {
        try {
            // Build the SET
            $str = "";
            foreach ($dataArray as $column => $value) {
                $value = addslashes($value);
                $str .= "$column='$value',";
            }
            $str = rtrim($str, ",");
            // Build Query
            $query = "UPDATE $table SET $str WHERE $condition";

            // MySQL Connect
            $db = get_called_class()::connect();

            // Get Result
            if (!($res = $db->query($query)))
                return false;

            // Close MySQL Connection
            $db->close();

            return true;
        } catch (Throwable $th) {
            return $th;
        }
    }

    public static function truncate(string $table): bool
    {
        // Build Query
        $query = "TRUNCATE $table";

        // MySQL Connect
        $db = get_called_class()::connect();

        // Get Result
        if (!($res = $db->query($query)))
            return false;

        // Close MySQL Connection
        $db->close();

        return true;
    }

    public static function paginate($table, $condition = "TRUE", $orderby = "1", $sort = "DESC", int $perpage = 20, int $page = 1): array|false
    {
        // Build Query
        if ($page <= 0) $page = 1;
        if ($perpage < 0) $perpage = 20;
        $start = ($page - 1) * $perpage;
        $query = "SELECT * FROM $table WHERE $condition ORDER BY $orderby $sort LIMIT $start,$perpage";

        // MySQL Connect
        $db = get_called_class()::connect();

        // Get Result
        if (!($res = $db->query($query)))
            return false;

        // Close MySQL Connection
        $db->close();

        // Initialize Data Array
        $data = array();

        while ($row = $res->fetch_object()) {
            $row = new Row($row, $table);
            array_push($data, $row);
        }

        return $data;
    }

    public static function count(string $table, $condition = "TRUE"): array|false
    {
        // Build Query
        $query = "SELECT COUNT(*) AS count FROM $table";

        // MySQL Connect
        $db = get_called_class()::connect();

        // Get Result
        if (!($res = $db->query($query)))
            return false;

        // Close MySQL Connection
        $db->close();

        // Return Result
        $row = $res->fetch_object();
        return array(
            "table" => $table,
            "count" => $row->count
        );
    }
}
