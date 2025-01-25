<?php
// autor: Camillie Thais Ayovi Villafuerte

require_once __DIR__ . '/../conf/Connection.php';

class SupportRequestDAO{

    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function insertSupportRequest($supportRequest) {
        try {
            $sql = "insert into supportRequests (userId, requestDate, subject, description, priority, requestStatus, status, language) 
                    VALUES (:userId, :requestDate, :subject, :description, :priority, :requestStatus, :status, :language)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":userId", $supportRequest->userId, PDO::PARAM_INT);
            $stmt->bindValue(":requestDate", $supportRequest->requestDate, PDO::PARAM_STR);
            $stmt->bindValue(":subject", $supportRequest->subject, PDO::PARAM_STR);
            $stmt->bindValue(":description", $supportRequest->description, PDO::PARAM_STR);
            $stmt->bindValue(":priority", $supportRequest->priority, PDO::PARAM_STR);
            $stmt->bindValue(":requestStatus", $supportRequest->requestStatus, PDO::PARAM_INT);
            $stmt->bindValue(":status", $supportRequest->status, PDO::PARAM_INT);
            $stmt->bindValue(":language", $supportRequest->language, PDO::PARAM_STR);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function getSupportRequests($userId){
        try{
            $sql = "select * FROM supportRequests WHERE userId = :userId and status = 1";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $results;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return [];
        }
    }

    public function getSupportRequestById($requestId){
        try{
            $sql = "select * FROM supportRequests WHERE requestId = :requestId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":requestId", $requestId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return null;
        }
    }

    public function updateSupportRequest($supportRequest){
        try{
            $sql = "update supportRequests set subject = :subject, description = :description, 
            priority = :priority, language = :language WHERE requestId = :requestId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":subject", $supportRequest->subject, PDO::PARAM_STR);
            $stmt->bindValue(":description", $supportRequest->description, PDO::PARAM_STR);
            $stmt->bindValue(":priority", $supportRequest->priority, PDO::PARAM_STR);
            $stmt->bindValue(":language", $supportRequest->language, PDO::PARAM_STR);
            $stmt->bindValue(":requestId", $supportRequest->requestId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function updateRequestStatus($requestId){
        try{
            $sql = "update supportRequests set requestStatus = 1 WHERE requestId = :requestId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":requestId", $requestId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function logicDeleteSupportRequest($requestId){
        try{
            $sql = "update supportRequests set status = 0 WHERE requestId = :requestId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":requestId", $requestId, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

}
?>