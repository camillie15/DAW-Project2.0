<?php

require_once 'conf/Connection.php';

class SupportRequestDAO{

    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function insertSupportRequest($supportRequest){
        try{
            $sql = "insert into supportrequests (userId, requestDate, subject, description, priority, requestStatus, status, language) 
            values (:userId, :requestDate, :subject, :description, :priority, :requestStatus, :status, :language)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":userId", $supportRequest->getUserId(), PDO::PARAM_INT);
            $stmt->bindValue(":requestDate", $supportRequest->getRequestDate(), PDO::PARAM_STR);
            $stmt->bindValue(":subject", $supportRequest->getSubject(), PDO::PARAM_STR);
            $stmt->bindValue(":description", $supportRequest->getDescription(), PDO::PARAM_STR);
            $stmt->bindValue(":priority", $supportRequest->getPriority(), PDO::PARAM_STR);
            $stmt->bindValue(":requestStatus", $supportRequest->getRequestStatus(), PDO::PARAM_INT);
            $stmt->bindValue(":status", $supportRequest->getStatus(), PDO::PARAM_INT);
            $stmt->bindValue(":language", $supportRequest->getLanguage(), PDO::PARAM_STR);
        
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function getSupportRequests($userId){
        try{
            $sql = "select * FROM supportrequests WHERE userId = :userId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":userId", $userId, PDO::PARAM_INT);
            $stmt->execute();
            error_log("probandooooo");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $results;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return [];
        }
    }

}
?>