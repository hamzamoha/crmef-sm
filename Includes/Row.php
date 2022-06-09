<?php

class Row {
    public function __construct(object $row = null) {
        $array = get_object_vars($row);
        foreach ($array as $key => $value) {
            $this->$key = $value;
        }
    }
}