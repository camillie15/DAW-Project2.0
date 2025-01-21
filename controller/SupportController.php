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
            Header("Location: index.php");
            exit();
        }
        
    }

    public function show_requests(){
        $_SESSION['rol'] = 1;
        if($_SESSION['rol'] == 1){
            $supportRequests = $this->supportRequestDAO->getSupportRequests($_SESSION['rol']);
        }else if($_SESSION['rol'] == 3){
            $supportRequests = $this->supportResponseDAO->getSupportRequests();
        }else{
            Header("Location: index.php");
            exit();
        }
        require_once VSUPPORT . 'list.php';
    }

    //REQUESTS

    public function form_create_request(){
        $this->checkRole(1);
        require_once VSUPPORT . 'newRequest.php';
    }

    public function create_request(){
        $this->checkRole(1);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $supportRequest = $this->setDataRequest();
            $this->supportRequestDAO->insertSupportRequest($supportRequest);
            header("Location: index.php?c=support&f=show_requests");
        }
    }

    public function form_update_request(){
        $this->checkRole(1);
        $requestId = htmlentities($_GET['requestId']);
        $supportRequest = $this->supportRequestDAO->getSupportRequestById($requestId);
        require_once VSUPPORT . 'editRequest.php';
    }

    public function update_request(){
        $this->checkRole(1);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $supportRequest = $this->setDataRequest();
            $supportRequest->requestId = htmlentities($_POST['requestId']);
            $this->supportRequestDAO->updateSupportRequest($supportRequest);
            header("Location: index.php?c=support&f=show_requests");
        }
    }

    public function delete_request(){
        $this->checkRole(1);
        $requestId = htmlentities($_GET['requestId']);
        $this->supportRequestDAO->logicDeleteSupportRequest($requestId);
        header("Location: index.php?c=support&f=show_requests");
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
                    <label><strong>Fecha de Respuesta:</strong></label>
                    <p>{$responseDate}</p>
                    <label><strong>Respuesta:</strong></label>
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
        //$supportRequest->userId = $_SESSION['user'];
        $supportRequest->userId = 1;
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

    public function form_response(){
        $this->checkRole(3);
        $requestId = htmlentities($_GET['requestId']);
        $supportRequest = $this->supportRequestDAO->getSupportRequestById($requestId);
        $supportResponse = $this->supportResponseDAO->getResponseByRequestId($requestId);
        if(!empty($supportResponse)){
            require_once VSUPPORT . "editResponse.php";
        }else{
            require_once VSUPPORT . 'newResponse.php';
        }
    }

    public function create_response(){
        $this->checkRole(3);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $supportResponse = $this->setDataResponse();
            $this->supportResponseDAO->insertSupportResponse($supportResponse);
            $this->supportRequestDAO->updateRequestStatus($supportResponse->requestId);
            header("Location: index.php?c=support&f=show_requests");
        }
    }

    public function update_response(){
        $this->checkRole(3);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $supportResponse = $this->setDataResponse();
            $supportResponse->responseId = htmlentities($_POST['responseId']);
            $this->supportResponseDAO->updateSupportResponse($supportResponse);
            header("Location: index.php?c=support&f=show_requests");
        }
    }

    public function setDataResponse() {
        $supportResponse = new SupportResponse();
        $supportResponse->requestId = htmlentities($_POST['requestId']);
        //$supportResponse->userId = $_SESSION['user'];
        $supportResponse->userId = 1;
        $supportResponse->responseDate = (new DateTime('NOW'))->format('Y-m-d H:i:s');
        $supportResponse->response = htmlentities($_POST['response']);
        return $supportResponse;
    }

}
?>