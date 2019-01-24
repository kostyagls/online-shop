<?php

class Db {
    public static function getConnection() {
        $paramWay = ROOT.'/config/db_param.php';
        $param = include($paramWay);
        
        $db = new PDO("mysql:host={$param['host']};dbname={$param['dbname']};charset=utf8", $param['user'], $param['password']);
        return $db;
        
    }
}