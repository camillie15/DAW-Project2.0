<?php

require_once 'conf/Connection.php';

class GuaranteeDAO{

    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function insert($guarantee){
        try{
            $sql = "insert into guarantees (userId, requestDate, purchaseDate, warrantyReasonId, productCode, invoiceCode, description, requestStatus, status)
            VALUES(:userId, :requestDate, :purchaseDate, :warrantyReasonId, :productCode, :invoiceCode, :description, :requestStatus, :status)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":userId", $guarantee->getUserId(), PDO::PARAM_INT);
            $requestDate = $guarantee->getRequestDate()->format('Y-m-d H:i:s');
            $stmt->bindValue(":requestDate", $requestDate, PDO::PARAM_STR);
            $stmt->bindValue(":purchaseDate", $guarantee->getPurchaseDate(), PDO::PARAM_STR);
            $stmt->bindValue(":warrantyReasonId", $guarantee->getWarrantyReasonId(), PDO::PARAM_INT);
            $stmt->bindValue(":productCode", $guarantee->getProductCode(), PDO::PARAM_STR);
            $stmt->bindValue(":invoiceCode", $guarantee->getInvoiceCode(), PDO::PARAM_STR);
            $stmt->bindValue(":description", $guarantee->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(":requestStatus", $guarantee->getRequestStatus(), PDO::PARAM_INT);
            $stmt->bindValue(":status", $guarantee->getStatus(), PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }

    }
    
    public function getGuarantees(){
        try{
            $sql = "select * from guarantees";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $results;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
        }
    }

    
}