<?php
// autor: Aguilar Villafuerte Daniel Mateo

class User {
    private $idUser;
    private $firstName;
    private $lastName;
    private $userName;
    private $email;
    private $password;  // Cambiado de contrasena a password
    private $userRole;
    private $status;

    // Constructor completo
    public function __construct($idUser, $firstName = null, $lastName = null, $userName = null, $email = null, $password = null, $userRole = null, $status = null) {
        $this->idUser = $idUser;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
        $this->userRole = $userRole;
        $this->status = $status;
    }

    // Constructor solo con idUser y userRole para la sesión
   // public function __construct($idUser, $userRole) {
        //$this->idUser = $idUser;
       // $this->userRole = $userRole;
    //}

    // Getters y Setters para todos los atributos
    public function getIdUser() {
        return $this->idUser;
    }

    public function setIdUser($idUser) {
        $this->idUser = $idUser;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function setUserName($userName) {
        $this->userName = $userName;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;  
    }

    public function setPassword($password) {
        $this->password = $password; 
    }

    public function getUserRole() {
        return $this->userRole;
    }

    public function setUserRole($userRole) {
        $this->userRole = $userRole;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
?>
