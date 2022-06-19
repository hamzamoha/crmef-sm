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
        return Database::update($this->table(), $dataArray, "id = " . $this->id);
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
