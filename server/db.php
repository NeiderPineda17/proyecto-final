<?php
class DB {
    public static function connect() {
        $host = '127.0.0.1';
        $db   = 'clinica';
        $user = 'root';
        $pass = '';
        $dsn = "mysql:host=$host;dbname=$db;charset=utf8";
        try {
            $pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $pdo;
        } catch (PDOException $e) {
            throw new Exception('DB connection error: ' . $e->getMessage());
        }
    }
}
?>