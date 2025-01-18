<?php
require_once 'model/SupportRequest.php';
require_once 'repository/SupportRequestDAO.php';

class SupportController{
    private $supportRequestDAO;

    public function __construct(){
        $this->supportRequestDAO = new SupportRequestDAO();
    }

    public function newRequest(){
        require_once VSUPPORT . 'new.php';
    }

    public function createRequest(){
        $supportRequest = new SupportRequest();
        //$supportRequest->setUserId($_SESSION['userId']);
        $supportRequest->setUserId(1);
        $supportRequest->setLanguage(htmlentities($_POST['language']));
        $supportRequest->setSubject(htmlentities($_POST['subject']));
        $supportRequest->setDescription(htmlentities($_POST['description']));
        $supportRequest->setPriority(htmlentities($_POST['priority']));
        $date = new DateTime('NOW');
        $supportRequest->setRequestDate($date->format('Y-m-d H:i:s'));
        $supportRequest->setRequestStatus(0);
        $supportRequest->setStatus(1);
        $this->supportRequestDAO->insertSupportRequest($supportRequest);
        header("Location: index.php?c=support&f=showRequests");
    }

    public function showRequests(){
        //$supportRequests = $this->supportRequestDAO->getSupportRequests($_SESSION['userId']);
        $supportRequests = $this->supportRequestDAO->getSupportRequests(1);
        require_once VSUPPORT . 'list.php';
    }
}
?>