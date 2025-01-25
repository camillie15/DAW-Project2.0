<?php
// autor: Camillie Thais Ayovi Villafuerte

require_once __DIR__ . '/../conf/Connection.php';

class SupportResponseDAO{

    private $connection;

    public function __construct(){
        $this->connection = Connection::getConnection();
    }

    public function insertSupportResponse($supportResponse) {
        try {
            $sqlCheckRequest = "select count(*) FROM supportRequests WHERE requestId = :requestId";
            $stmtCheckRequest = $this->connection->prepare($sqlCheckRequest);
            $stmtCheckRequest->bindValue(":requestId", $supportResponse->requestId, PDO::PARAM_INT);
            $stmtCheckRequest->execute();
            if ($stmtCheckRequest->fetchColumn() == 0) {
                throw new PDOException("El requestId no existe en supportRequests.");
            }
    
            $sql = "INSERT INTO supportResponses (requestId, responseDate, userId, response) 
                    VALUES (:requestId, :responseDate, :userId, :response)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":requestId", $supportResponse->requestId, PDO::PARAM_INT);
            $stmt->bindValue(":responseDate", $supportResponse->responseDate, PDO::PARAM_STR);
            $stmt->bindValue(":userId", $supportResponse->userId, PDO::PARAM_INT);
            $stmt->bindValue(":response", $supportResponse->response, PDO::PARAM_STR);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function updateSupportResponse($supportResponse){
        try {
            $sqlCheckRequest = "select count(*) FROM supportRequests WHERE requestId = :requestId";
            $stmtCheckRequest = $this->connection->prepare($sqlCheckRequest);
            $stmtCheckRequest->bindValue(":requestId", $supportResponse->requestId, PDO::PARAM_INT);
            $stmtCheckRequest->execute();
            if ($stmtCheckRequest->fetchColumn() == 0) {
                throw new PDOException("El requestId no existe en supportRequests.");
            }
    
            $sql = "update supportResponses set response = :response WHERE responseId = :responseId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":responseId", $supportResponse->responseId, PDO::PARAM_INT);
            $stmt->bindValue(":response", $supportResponse->response, PDO::PARAM_STR);
            
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return false;
        }
    }

    public function getSupportRequests(){
        try{
            $sql = "select * FROM supportRequests WHERE status = 1";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $results;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return [];
        }
    }

    public function getResponseByRequestId($requestId){
        try{
            $sql = "select * FROM supportResponses WHERE requestId = :requestId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindParam(":requestId", $requestId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);            
            return $result;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
            return [];
        }
    }
}