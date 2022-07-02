<?php

class Tester
{
    public function __construct($tester)
    {
        $this->tester = $tester;
    }

    public function tester_start_testing(string $file = null, string $fuction)
    {
        if(!$file || !file_exists($file)) return false;
        require_once($file);
        if(!function_exists($fuction)) return false;
        require_once($this->tester);
        return tester();
    }
}
