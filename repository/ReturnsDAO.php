<?php

require_once 'conf/Connection.php';
class ReturnsDAO
{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function insertReturnRequest($return)
    {
        try {
/*             $script = "INSERT INTO returns (requestDate, purchaseDate ,invoiceCode, productSatus, description ,productCode, requestStatus, status) 
            VALUES (?,?,?,?,?,?,?)"; */
            $script = "INSERT INTO returns (requestDate, purchaseDate ,invoiceCode, productStatus, productCode, description, requestStatus, status) 
            VALUES (?,?,?,?,?,?,?,?)";

            $stmt = $this->connection->prepare($script);

            $stmt->bindParam(1, $return->getRequestDate(), PDO::PARAM_STR);
            $stmt->bindParam(2, $return->getPurchaseDate(), PDO::PARAM_STR);
            $stmt->bindParam(3, $return->getInvoiceCode(), PDO::PARAM_STR);
            $stmt->bindParam(4, $return->getProductStatus(), PDO::PARAM_STR);
            $stmt->bindParam(5, $return->getProductCode(), PDO::PARAM_STR);
            $stmt->bindParam(6, $return->getDescription(), PDO::PARAM_STR);
            $stmt->bindParam(7, $return->getRequestStatus(), PDO::PARAM_INT);
            $stmt->bindParam(8, $return->getStatus(), PDO::PARAM_INT); 
            /*             
            $stmt->bindParam(':userId', $return->getUserId(), PDO::PARAM_INT); 
            */
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Fail insertReturnRequest: " . $e->getMessage(), 0);
            return false;
        }
    }

    public function updateReturnRequest($returnId) {}

    public function deleteReturnRequest($returnId) {}

    public function listReturnsRequests() {}

    public function searchReturnRequestById($returnId) {}
}
