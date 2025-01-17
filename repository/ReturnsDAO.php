<?php
class ReturnsDAO
{

    private $connection;

    public function __construct()
    {
        //$this->connection = Connection::getConnection();
    }

    public function insertReturnRequest($return)
    {
        try {
            $userId = $_SESSION['userLogged']->userId;
            $script = "INSERT INTO returns (userId, requestDate, purchaseDate, productStatus, productCode, invoiceCode, description, requestStatus, status) VALUES (:userId,?,?,?,?,?,?,?,?)";

            $stmt = $this->connection->prepare($script);

            $stmt->bindParam(1, $userId);
            $stmt->bindParam(2, $return->requestDate);
            $stmt->bindParam(3, $return->purchaseDate);
            $stmt->bindParam(4, $return->productStatus);
            $stmt->bindParam(5, $return->productCode);
            $stmt->bindParam(6, $return->invoiceCode);
            $stmt->bindParam(7, $return->description);
            $stmt->bindParam(8, $return->requestStatus);
            $stmt->bindParam(9, $return->status);
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
