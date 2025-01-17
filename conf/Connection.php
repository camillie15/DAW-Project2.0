<?php
class Connection {
    public static function getConnection() {
        $dsn = 'mysql:host=localhost;port=3306;dbname=' . DBNAME;
        $connection = null;
        try {
            $connection = new PDO($dsn, DBUSER, DBPASSWORD);
             $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo $e;
            die("Error " . $e->getMessage());
        }      
        return $connection;
    }
}
