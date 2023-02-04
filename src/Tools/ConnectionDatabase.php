<?php

declare(strict_types=1);

namespace App\Tools;

use \PDO;

class ConnectionDatabase {
    public static PDO $instance;
   
    public static function getInstance(): PDO {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_SENHA, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }

        return self::$instance;
    }
}