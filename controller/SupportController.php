<?php
session_start();

date_default_timezone_set('America/Guayaquil');
require_once 'model/SupportRequest.php';
require_once 'model/SupportResponse.php';
require_once 'repository/SupportRequestDAO.php';
require_once 'repository/SupportResponseDAO.php';

class SupportController{
    private $supportRequestDAO;
    private $supportResponseDAO;

    public function __construct(){
        $this->supportRequestDAO = new SupportRequestDAO();
        $this->supportResponseDAO = new SupportResponseDAO();
    }

    private function checkRole($rol) {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] != $rol) {
            //Devolver al home
            exit();
        }
    }

    public function showRequests(){
        error_log($_SESSION['rol']);
        if($_SESSION['rol'] == 1){
            $supportRequests = $this->supportRequestDAO->getSupportRequests($_SESSION['user']);
        }else if($_SESSION['rol'] == 3){
            $supportRequests = $this->supportResponseDAO->getSupportRequests();
        }else{
            //Devolver al home
            exit();
        }
        require_once VSUPPORT . 'list.php';
    }

    //REQUESTS

    public function newRequest(){
        $this->checkRole(1);
        require_once VSUPPORT . 'newRequest.php';
    }

    public function createRequest(){
        $this->checkRole(1);
        $supportRequest = $this->setDataRequest();
        $this->supportRequestDAO->insertSupportRequest($supportRequest);
        header("Location: index.php?c=support&f=showRequests");
    }

    public function editRequest(){
        $this->checkRole(1);
        $requestId = htmlentities($_GET['requestId']);
        $supportRequest = $this->supportRequestDAO->getSupportRequestById($requestId);
        var_dump($supportRequest);
        require_once VSUPPORT . 'editRequest.php';
    }

    public function updateRequest(){
        $this->checkRole(1);
        $supportRequest = $this->setDataRequest();
        $supportRequest->requestId = htmlentities($_POST['requestId']);
        $this->supportRequestDAO->updateSupportRequest($supportRequest);
        header("Location: index.php?c=support&f=showRequests");
    }

    public function deleteRequest(){
        $this->checkRole(1);
        $requestId = htmlentities($_GET['requestId']);
        $this->supportRequestDAO->logicDeleteSupportRequest($requestId);
        header("Location: index.php?c=support&f=showRequests");
    }

    public function showResponseByRequestId() {
        $this->checkRole(1);
        $requestId = htmlentities($_GET['requestId']);
        $supportResponse = $this->supportResponseDAO->getResponseByRequestId($requestId);
    
        if (!empty($supportResponse)) {
            $responseDate = htmlentities($supportResponse['responseDate'], ENT_QUOTES, 'UTF-8');
            $responseText = html_entity_decode($supportResponse['response'], ENT_QUOTES, 'UTF-8');
    
            echo "
                <div>
                    <label>Fecha de Respuesta:</label>
                    <p>{$responseDate}</p>
                    <label>Respuesta:</label>
                    <p>{$responseText}</p>
                </div>
            ";
        } else {
            echo "<p>No se encontró una respuesta para esta solicitud.</p>";
        }
    
        exit();
    }
    
    public function setDataRequest() {
        $supportRequest = new SupportRequest();
        $supportRequest->userId = $_SESSION['user'];
        //$supportRequest->userId = 1;
        $supportRequest->language = htmlentities($_POST['language']);
        $supportRequest->subject = htmlentities($_POST['subject']);
        $supportRequest->description = htmlentities($_POST['description']);
        $supportRequest->priority = htmlentities($_POST['priority']);
        $supportRequest->requestDate = (new DateTime('NOW'))->format('Y-m-d H:i:s');
        $supportRequest->requestStatus = 0;
        $supportRequest->status = 1;
        return $supportRequest;
    }

    // RESPONSES

    public function newResponse(){
        $this->checkRole(3);
        $requestId = htmlentities($_GET['requestId']);
        $supportRequest
         = $this->supportRequestDAO->getSupportRequestById($requestId);
        require_once VSUPPORT . 'newResponse.php';
    }

    public function createResponse(){
        $this->checkRole(3);
        $supportResponse = $this->setDataResponse();
        $this->supportResponseDAO->insertSupportResponse($supportResponse);
        $this->supportRequestDAO->updateRequestStatus($supportResponse->requestId);
        header("Location: index.php?c=support&f=showRequests");
    }

    public function setDataResponse() {
        $supportResponse = new SupportResponse();
        $supportResponse->requestId = htmlentities($_POST['requestId']);
        $supportResponse->userId = $_SESSION['user'];
        //$supportResponse->userId = 1;
        $supportResponse->responseDate = (new DateTime('NOW'))->format('Y-m-d H:i:s');
        $supportResponse->response = htmlentities($_POST['response']);
        return $supportResponse;
    }

}
?>