<?php

class SupportRequest{

    private $requestId, $userId, $requestDate, $language, $subject, $description, $priority, $requestStatus, $status;

    function __construct(){
    }

    function getRequestId() {
        return $this->requestId;
    }

    function setRequestId($requestId) {
        $this->requestId = $requestId;
    }

    function getUserId() {
        return $this->userId;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function getRequestDate() {
        return $this->requestDate;
    }

    function setRequestDate($requestDate) {
        $this->requestDate = $requestDate;
    }

    function getLanguage() {
        return $this->language;
    }

    function setLanguage($language) {
        $this->language = $language;
    }

    function getSubject() {
        return $this->subject;
    }

    function setSubject($subject) {
        $this->subject = $subject;
    }

    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function getPriority() {
        return $this->priority;
    }

    function setPriority($priority) {
        $this->priority = $priority;
    }
    
    function getRequestStatus() {
        return $this->requestStatus;
    }

    function setRequestStatus($requestStatus) {
        $this->requestStatus = $requestStatus;
    }

    function getStatus() {
        return $this->status;
    }

    function setStatus($status) {
        $this->status = $status;
    }

}