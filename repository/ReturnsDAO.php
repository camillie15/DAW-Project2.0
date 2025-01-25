<?php
// autor: Erick Alejandro Cordova Viteri

require_once __DIR__ . '/../conf/Connection.php';
class ReturnsDAO
{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /*----------CREATE----------*/
    public function insertReturnRequest($return)
    {
        try {
            $script = "INSERT INTO returns ( requestDate, purchaseDate ,invoiceCode, productStatus, productCode, description, requestStatus, status, userId) 
            VALUES (:requestDate ,:purchaseDate ,:invoiceCode ,:productStatus ,:productCode ,:description ,:requestStatus ,:status ,:userId)";

            $stmt = $this->connection->prepare($script);

            $stmt->bindValue(':requestDate', $return->getRequestDate(), PDO::PARAM_STR);
            $stmt->bindValue(':purchaseDate', $return->getPurchaseDate(), PDO::PARAM_STR);
            $stmt->bindValue(':invoiceCode', $return->getInvoiceCode(), PDO::PARAM_STR);
            $stmt->bindValue(':productStatus', $return->getProductStatus(), PDO::PARAM_STR);
            $stmt->bindValue(':productCode', $return->getProductCode(), PDO::PARAM_STR);
            $stmt->bindValue(':description', $return->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(':requestStatus', $return->getRequestStatus(), PDO::PARAM_INT);
            $stmt->bindValue(':status', $return->getStatus(), PDO::PARAM_INT);
            $stmt->bindValue(':userId', $return->getUserId(), PDO::PARAM_INT); 

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Fail insertReturnRequest: " . $e->getMessage(), 0);
            return false;
        }
    }

    /*----------READ----------*/
    public function listReturnsRequests()
    {
        try {
            $script = "SELECT * FROM returns WHERE status = 1 ORDER BY requestDate ASC";
            $stmt = $this->connection->prepare($script);
            $stmt->execute();
            $returns = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $return = new Returns();
                $return->setReturnId($row['returnId']);
                $return->setRequestDate($row['requestDate']);
                $return->setPurchaseDate($row['purchaseDate']);
                $return->setProductStatus($row['productStatus']);
                $return->setProductCode($row['productCode']);
                $return->setInvoiceCode($row['invoiceCode']);
                $return->setDescription($row['description']);
                $return->setRequestStatus($row['requestStatus']);
                $returns[] = $return;
            }
            return $returns;
        } catch (PDOException $e) {
            error_log("Fail searchReturnRequestById: " . $e->getMessage());
            return [];
        }
    }

    public function searchReturnsRequestById($userId)
    {
        try {
            /* $script = "SELECT * FROM returns WHERE returnId = :userId"; */
            $script = "SELECT * FROM returns WHERE status = 1 AND userId = :userId ORDER BY requestDate DESC";
            $stmt = $this->connection->prepare($script);
            $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
            $stmt->execute();
            $returns = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $return = new Returns();
                $return->setReturnId($row['returnId']);
                $return->setRequestDate($row['requestDate']);
                $return->setPurchaseDate($row['purchaseDate']);
                $return->setProductStatus($row['productStatus']);
                $return->setProductCode($row['productCode']);
                $return->setInvoiceCode($row['invoiceCode']);
                $return->setDescription($row['description']);
                $return->setRequestStatus($row['requestStatus']);
                $returns[] = $return;
            }
            return $returns;
        } catch (PDOException $e) {
            error_log("Fail searchReturnRequestById: " . $e->getMessage());
            return [];
        }
    }

    public function searchReturnRequestById($returnId)
    {
        try {
            $script = "SELECT * FROM returns WHERE returnId = :returnId";
            $return = new Returns();
            $stmt = $this->connection->prepare($script);
            $stmt->bindParam(":returnId", $returnId, PDO::PARAM_INT);
            $stmt->execute();

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $return->setReturnId($row['returnId']);
                $return->setUserId($row['userId']);
                $return->setRequestDate($row['requestDate']);
                $return->setPurchaseDate($row['purchaseDate']);
                $return->setProductStatus($row['productStatus']);
                $return->setProductCode($row['productCode']);
                $return->setInvoiceCode($row['invoiceCode']);
                $return->setDescription($row['description']);
                $return->setRequestStatus($row['requestStatus']);
            }
            return $return;
        } catch (PDOException $e) {
            error_log("Fail searchReturnRequestById: " . $e->getMessage());
            return null;
        }
    }

    /*----------UPDATE----------*/
    public function updateReturnRequest($returnId, $return)
    {
        try {
            $script = "UPDATE returns SET purchaseDate = :purchaseDate, productStatus = :productStatus, productCode = :productCode, invoiceCode = :invoiceCode, description = :description WHERE returnId = :returnId";
            $stmt = $this->connection->prepare($script);
            $stmt->bindValue(":purchaseDate", $return->getPurchaseDate(), PDO::PARAM_STR);
            $stmt->bindValue(":productStatus", $return->getProductStatus(), PDO::PARAM_STR);
            $stmt->bindValue(":productCode", $return->getProductCode(), PDO::PARAM_STR);
            $stmt->bindValue(":invoiceCode", $return->getInvoiceCode(), PDO::PARAM_STR);
            $stmt->bindValue(":description", $return->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(":returnId", $returnId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log(("Fail update request" . $e));
            return false;
        }
    }

    public function updateRequestStatus($returnId, $requestStatus)
    {
        try {
            $script = "UPDATE returns SET requestStatus = :requestStatus WHERE returnId = :returnId";
            $stmt = $this->connection->prepare($script);
            $stmt->bindParam(":requestStatus", $requestStatus, PDO::PARAM_INT);
            $stmt->bindParam(":returnId", $returnId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    /*----------DELETE----------*/
    public function deleteReturnRequest($returnId)
    {
        try {
            $script = "UPDATE returns SET status = 0 WHERE returnId = :returnId";
            $stmt = $this->connection->prepare($script);
            $stmt->bindParam(":returnId", $returnId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException) {
            return false;
        }
    }
}
