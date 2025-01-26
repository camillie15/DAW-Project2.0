<?php
// autor: Ayovi Villafuerte Camillie Thais

class SupportResponse{

    private $responseId, $requestId, $responseDate, $userId, $response;

    function __construct(){
    }

    public function __get($property){
        return $this->$property;
    }

    public function __set($property, $value){
        $this->$property = $value;
    }
}