<?php
// autor: Tipan Anton Cesar Alexander

require_once __DIR__ . '/../conf/Connection.php';

class GuaranteeDAO
{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function insert($guarantee)
    {
        try {
            $sql = "INSERT INTO guarantees (userId, requestDate, purchaseDate, warrantyReasonId, productCode, invoiceCode, description, requestStatus, status)
            VALUES (:userId, :requestDate, :purchaseDate, :warrantyReasonId, :productCode, :invoiceCode, :description, :requestStatus, :status)";
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

    public function getGuarantees()
    {
        try {
            $sql = "SELECT * FROM guarantees";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
        }
    }

    public function getGuaranteeById($guaranteeId)
    {
        try {
            $sql = "SELECT * FROM guarantees WHERE guaranteeId = :guaranteeId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":guaranteeId", $guaranteeId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
        }
    }

    public function getGuaranteesByUserId($userId)
    {
        try {
            $sql = "SELECT * FROM guarantees WHERE userId = :userId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
        }
    }


    public function delete($guaranteeId)
    {
        try {
            $sql = "DELETE FROM guarantees WHERE guaranteeId = :guaranteeId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":guaranteeId", $guaranteeId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function update($guarantee)
    {
        try {
            $sql = "UPDATE guarantees 
                    SET purchaseDate = :purchaseDate, 
                        warrantyReasonId = :warrantyReasonId, 
                        productCode = :productCode, 
                        invoiceCode = :invoiceCode, 
                        description = :description, 
                        requestStatus = :requestStatus 
                    WHERE guaranteeId = :guaranteeId";

            $stmt = $this->connection->prepare($sql);

            $stmt->bindValue(":guaranteeId", $guarantee->getGuaranteeId(), PDO::PARAM_INT);
            $stmt->bindValue(":purchaseDate", $guarantee->getPurchaseDate(), PDO::PARAM_STR);
            $stmt->bindValue(":warrantyReasonId", $guarantee->getWarrantyReasonId(), PDO::PARAM_INT);
            $stmt->bindValue(":productCode", $guarantee->getProductCode(), PDO::PARAM_STR);
            $stmt->bindValue(":invoiceCode", $guarantee->getInvoiceCode(), PDO::PARAM_STR);
            $stmt->bindValue(":description", $guarantee->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(":requestStatus", $guarantee->getRequestStatus(), PDO::PARAM_INT);

            $stmt->execute();

            return true;
        } catch (PDOException $e) {
            error_log("Error al actualizar la garantía: " . $e->getMessage());
            return false;
        }
    }

    public function updateStatus($guaranteeId, $newStatus)
    {
        try {
            $sql = "UPDATE guarantees SET requestStatus = :status WHERE guaranteeId = :guaranteeId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":status", $newStatus, PDO::PARAM_INT);
            $stmt->bindValue(":guaranteeId", $guaranteeId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en la actualización del estado: " . $e->getMessage());
        }
    }
}
?>