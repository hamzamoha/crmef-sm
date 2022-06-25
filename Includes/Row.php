<?php
class Row
{
    private string $table;
    public function __construct(object $row = null, string $table)
    {
        $array = get_object_vars($row);
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
        $this->table = $table;
    }
    public function update(array $dataArray): bool
    {
        $bool = Database::update($this->table(), $dataArray, "id = " . $this->id);
        $temp = Database::select_by_id($this->table(), $this->id);
        if ($temp) {
            foreach ($temp as $key => $value) $this->$key = $value;
        }
        return $bool;
    }
    public function table(): string
    {
        return $this->table;
    }
    public function delete(): bool
    {
        return Database::delete_by_id($this->table(), $this->id);
    }
}
