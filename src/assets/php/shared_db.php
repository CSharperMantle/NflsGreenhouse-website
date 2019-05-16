<?php
    /*
     * Copyright (c) 2018 Ningbo Foreign Language School
     * This part of program should be delivered with the whole project.
     * Partly use is not allowed.
     * Licensed under GPL-v3 Agreement
     */

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
            if (!(self::$_pdo_instance instanceof PDO)) {
                $dbdsn = "mysql:host=" . getenv('DB_HOST') . ";port=3306;dbname=" . getenv('DB_SCHEMA_NAME');
                $username = getenv('DB_USERNAME');
                $passwd = getenv('DB_PASSWD');
                try {
                    self::$_pdo_instance = new PDO($dbdsn, $username, $passwd);
                    self::$_pdo_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                } catch (PDOException $e) {
                    error_log($e);
                }
            }
            return self::$_pdo_instance;
        }

        private function __construct() {
        }

        private function __clone() {
            throw new Exception('DBConnectionSingleton cannot be cloned');
        }

        private function __wakeup() {
            throw new Exception('DBConnectionSingleton cannot be deserialized');
        }
    }
?>