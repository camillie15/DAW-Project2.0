<?php 
require_once __DIR__ . '/ConfigDB.php';

class Connection
{
    public static function getConnection()
    {
        $dsn = "mysql:host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME;
        $connection = null;
        try {
            $connection = new PDO($dsn, DBUSER, DBPASSWORD);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            error_log($e->getMessage());
            die("Error: " . $e->getMessage());
        }
        return $connection;
    }
}