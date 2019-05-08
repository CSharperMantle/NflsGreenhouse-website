<?php
    /*
     * Copyright (c) 2018 Ningbo Foreign Language School
     * This part of program should be delivered with the whole project.
     * Partly use is not allowed.
     * Licensed under GPL-v3 Agreement
     */

    $host = getenv('DB_HOST'); // localhost
    $port = 3306;
    $dbname = getenv('DB_SCHEMA_NAME'); // plant_data
    $passwd = getenv('DB_PASSWD'); // plant_client
    $username = getenv('DB_USERNAME'); // plant_client
    $dbdsn = "mysql:host=" . host . ";port=" . port . ";dbname=" . dbname;

    function run_query(PDO $connection, string $sql, array $args = array()) {
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
    }

    function run_query_fetch(PDO $connection, string $sql, array $args = array(), int $fetch_style = PDO::FETCH_ASSOC) {
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
        $result = $stmt->fetch($fetch_style);
        return $result;
    }

    function run_query_fetch_multi(PDO $connection, string $sql, array $args = array(), int $fetch_style = PDO::FETCH_ASSOC) {
        $stmt = $connection->prepare($sql);
        $stmt->execute($args);
        $result = $stmt->fetchAll($fetch_style);
        return $result;
    }

    class DBConnectionSingleton {
        private static $_pdo_instance;
        
        public static function getInstance() {
            if (!(DBConnectionSingleton::$_pdo_instance instanceof PDO)) {
                DBConnectionSingleton::$_pdo_instance = new PDO($dbdsn, $username, $passwd);
            }
            return DBConnectionSingleton::$_pdo_instance;
        }

        private function __constructor() {
        }

        private function __clone() {
            throw new Exception('DBConnectionSingleton cannot be cloned');
        }
    }
?>