<?php
// autor: Camillie Thais Ayovi Villafuerte

require_once __DIR__ . '/../model/User.php';

date_default_timezone_set('America/Guayaquil');
require_once __DIR__ . '/../model/SupportRequest.php';
require_once __DIR__ . '/../model/SupportResponse.php';
require_once __DIR__ . '/../repository/SupportRequestDAO.php';
require_once __DIR__ . '/../repository/SupportResponseDAO.php';
require_once __DIR__ . '/../repository/UserDAO.php';

class SupportController{
    private $supportRequestDAO;
    private $supportResponseDAO;
    private $userDao;

    public function __construct(){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->supportRequestDAO = new SupportRequestDAO();
        $this->supportResponseDAO = new SupportResponseDAO();
        $this->userDao = new UserDAO();
    }

    private function checkRole($rol) {
        if (!isset($_SESSION['userLogged']) || $_SESSION['userLogged']->getUserRole() != $rol) {
            header("Location: index.php");
            exit();
        }
    }

    public function show_requests(){
        $userRol = $_SESSION['userLogged']->getUserRole(); 
        error_log($userRol);
        if($userRol == 1){
            $supportRequests = $this->supportRequestDAO->getSupportRequests($_SESSION['userLogged']->getIdUser());
        }else if($userRol == 3){
            $supportRequests = $this->supportResponseDAO->getSupportRequests();
            foreach ($supportRequests as &$request) {
                $user = $this->userDao->getUserById($request['userId']);
                
                if ($user) {
                    $request['userName'] = $user['userName'];                }
            }
        }else{
            header("Location: index.php");
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
            if($supportRequest != null){
                if($this->supportRequestDAO->insertSupportRequest($supportRequest)) {
                    $_SESSION['message'] = "Solicitud creada exitosamente";    
                }
            } 
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
            if($supportRequest != null){
                $supportRequest->requestId = htmlentities($_POST['requestId']);
                $this->supportRequestDAO->updateSupportRequest($supportRequest);
                $_SESSION['message'] = "Solicitud actualizada exitosamente";
            }
            header("Location: index.php?c=support&f=show_requests");
        }
    }

    public function delete_request(){
        $this->checkRole(1);
        $requestId = htmlentities($_GET['requestId']);
        $this->supportRequestDAO->logicDeleteSupportRequest($requestId);
        $_SESSION['message'] = "Solicitud eliminada exitosamente";
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
        $supportRequest->userId = $_SESSION['userLogged']->getIdUser();
        $supportRequest->language = htmlentities($_POST['language']);
        $supportRequest->subject = htmlentities(trim($_POST['subject']));
        $supportRequest->description = htmlentities(trim($_POST['description']));
        $supportRequest->priority = htmlentities($_POST['priority']);
        $supportRequest->requestDate = (new DateTime('NOW'))->format('Y-m-d H:i:s');
        $supportRequest->requestStatus = 0;
        $supportRequest->status = 1;
        if(empty(trim($_POST['subject'])) || empty(trim($_POST['description']))){
            $_SESSION['message'] = "Datos incompletos para la solicitud";
            return null;
        }
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
            if($supportResponse != null){
                $this->supportResponseDAO->insertSupportResponse($supportResponse);
                $this->supportRequestDAO->updateRequestStatus($supportResponse->requestId);
                $_SESSION['message'] = "Respuesta creada exitosamente";
            }
            header("Location: index.php?c=support&f=show_requests");
        }
    }

    public function update_response(){
        $this->checkRole(3);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $supportResponse = $this->setDataResponse();
            if($supportResponse != null){
                $supportResponse->responseId = htmlentities($_POST['responseId']);
                $this->supportResponseDAO->updateSupportResponse($supportResponse);
                $_SESSION['message'] = "Respuesta actualizada exitosamente";
            }
            header("Location: index.php?c=support&f=show_requests");
        }
    }

    public function setDataResponse() {
        $supportResponse = new SupportResponse();
        $supportResponse->requestId = htmlentities($_POST['requestId']);
        $supportResponse->userId = $_SESSION['userLogged']->getIdUser();
        $supportResponse->responseDate = (new DateTime('NOW'))->format('Y-m-d H:i:s');
        $supportResponse->response = htmlentities(trim($_POST['response']));
        if(empty(htmlentities(trim($_POST['response'])))){
            $_SESSION['message'] = "Datos incompletos para la respuesta";
            return null;
        }
        return $supportResponse;
    }

}
?>