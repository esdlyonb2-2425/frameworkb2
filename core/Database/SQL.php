<?php

namespace Core\Database;

use Core\Environment\DotEnv;
use PDO;

class SQL
{
    public static function getPdo(){

        $dotEnv = new DotEnv();


        $dbHost = $dotEnv->getVariable("DBHOST");
        $dbName = $dotEnv->getVariable("DBNAME");
        $dbType = $dotEnv->getVariable("DBTYPE");
        $dbPort = $dotEnv->getVariable("DBPORT");


        $username = $dotEnv->getVariable("DBUSER");
        $password = $dotEnv->getVariable("DBPASSWORD");



        $pdo = new PDO(
            "$dbType:host=$dbHost;dbname=$dbName",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_OBJ
            ]
        );
        return $pdo;
    }
}