<?php
// autor: Tipan Anton Cesar Alexander

require_once __DIR__ . '/../conf/Connection.php';

class GuaranteeReasonsDAO{

    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }
    public function getGuaranteeReason() {
        try{
            $sql = "select * from warrantyReasons";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $results;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
        }
    }
}