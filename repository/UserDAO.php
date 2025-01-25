<?php
// repository/UserDAO.php

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../conf/Connection.php';

class UserDAO
{

    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    // Método para registrar un nuevo usuario
    public function register($user)
    {
        try {
            $script = "INSERT INTO users (firstName, lastName, userName, email, password, userRole, status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($script);

            $stmt->bindParam(1, $user->getFirstName(), PDO::PARAM_STR);
            $stmt->bindParam(2, $user->getLastName(), PDO::PARAM_STR);
            $stmt->bindParam(3, $user->getUserName(), PDO::PARAM_STR);
            $stmt->bindParam(4, $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindParam(5, $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindParam(6, $user->getUserRole(), PDO::PARAM_INT);
            $stmt->bindParam(7, $user->getStatus(), PDO::PARAM_INT);

            $result = $stmt->execute();
            return $result;
        } catch (PDOException $e) {
            error_log("Fail register user: " . $e->getMessage(), 0);
            return false;
        }
    }

    // Método para iniciar sesión
    public function login($userName, $password)
    {
        try {
            $script = "SELECT * FROM users WHERE userName = :userName AND password = :password AND status = 1";
            $stmt = $this->connection->prepare($script);
            $stmt->bindParam(":userName", $userName, PDO::PARAM_STR);
            $stmt->bindParam(":password", $password, PDO::PARAM_STR);
            $stmt->execute();

            if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Devolvemos un usuario con todos los datos
                $user = new User($row['userId'], $row['firstName'], $row['lastName'], $row['userName'], $row['email'], $row['password'], $row['userRole'], $row['status']);
                //$user = new User($row['userId'] );
                // $user->setUserRole($row['userRole']);
                return $user;
            }
        } catch (PDOException $e) {
            error_log("Error en login: " . $e->getMessage());
            return null;
        }
    }

    // Método para actualizar los datos del usuario
    public function update($user)
    {
        try {
            $script = "UPDATE users 
                   SET firstName = ?, lastName = ?, userName = ?, email = ?, password = ? 
                   WHERE userId = ?";
            $stmt = $this->connection->prepare($script);

            $stmt->bindParam(1, $user->getFirstName(), PDO::PARAM_STR);
            $stmt->bindParam(2, $user->getLastName(), PDO::PARAM_STR);
            $stmt->bindParam(3, $user->getUserName(), PDO::PARAM_STR);
            $stmt->bindParam(4, $user->getEmail(), PDO::PARAM_STR);
            $stmt->bindParam(5, $user->getPassword(), PDO::PARAM_STR);
            $stmt->bindParam(6, $user->getIdUser(), PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en actualización de usuario: " . $e->getMessage());
            return false;
        }
    }

    // Método para eliminar la cuenta (marcar como eliminada)
    public function delete($userId)
    {
        try {
            $script = "UPDATE users SET status = 0 WHERE userId = ?";
            $stmt = $this->connection->prepare($script);
            $stmt->bindParam(1, $userId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en eliminación de cuenta: " . $e->getMessage());
            return false;
        }
    }


    public function createDefaultUsers()
    {
        // Verificar si el usuario "Garantia" ya existe
        if (!$this->userExists("Garantia")) {
            $userGarantia = new User(null, null, null, "Garantia", null, "1234", 2, 1); // Rol 2: Garantia
            $this->register($userGarantia); // Registrar "Garantia"
        }

        // Verificar si el usuario "Soporte" ya existe
        if (!$this->userExists("Soporte")) {
            $userSoporte = new User(null, null, null, "Soporte", null, "1234", 3, 1); // Rol 3: Soporte
            $this->register($userSoporte); // Registrar "Soporte"
        }
    }

    // Función auxiliar para verificar si un usuario ya existe en la base de datos
    private function userExists($userName)
    {
        $script = "SELECT COUNT(*) FROM users WHERE userName = :userName";
        $stmt = $this->connection->prepare($script);
        $stmt->bindParam(":userName", $userName, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['COUNT(*)'] > 0;
    }

    public function getUserById($userId)
    {
        try {
            $sql = "SELECT * FROM users WHERE userId = :userId";
            $stmt = $this->connection->prepare($sql);
            $stmt->bindValue(":userId", $userId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            error_log("Error en la consulta: " . $e->getMessage());
        }
    }
}
