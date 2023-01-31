<?php

namespace App\DB;
use PDO;

class Connector
{
    public function __construct(){
        $ini_array = parse_ini_file(__DIR__ . "/../../config/php.ini");

        $str = 'mysql:host=' . $ini_array['host'] . ';dbname=' . $ini_array['dbname'];
        $str1 = $ini_array['login'];
        $str2 = $ini_array['password'];


        $this->dbh = new PDO($str, $str1, $str2);
    }
    public function include():PDO{
        return $this->dbh;

    }

}