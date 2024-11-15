<?php

namespace Core\Database;

class PDOMysql
{

    public static function getPdo(){

        $dbName = "test";
        $dbHost = "localhost";
        $dbUser = "mey";
        $dbPassword = "Ul140XgKzTUQ8";
        $dsn = "mysql:dbname=$dbName;host=$dbHost";
        $pdo = new \PDO(
            $dsn,
            $dbUser,
            $dbPassword,
            [
                \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_OBJ
            ]

        );
        $delimiter = strpos($dsn, ':');
        $language = substr($dsn, 0, $delimiter);



        return [
            "pdo"=>$pdo,
            "bdd"=>$language
        ];

    }

}