<?php
// autor: Aguilar Villafuerte Daniel Mateo

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../repository/UserDAO.php';

class UserController
{

    // Método para mostrar el formulario de login
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
    }

    public function index()
    {
        $this->verifyLogin();
        require_once __DIR__ . '/../view/loginView.php';
    }

    public function perfil()
    {
        // Aquí debes verificar si los datos han sido actualizados o no
        require_once __DIR__ . '/../view/user/user.perfil.php';
    }

    // Método para redirigir al formulario de actualización
    public function updateProfile()
    {

        // Cargar la vista de actualización con los datos del usuario
        require_once __DIR__ . '/../view/user/user.update.php';
    }

    // Método para procesar la actualización de datos
    public function processUpdate()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST['firstName'], $_POST['lastName'], $_POST['userName'], $_POST['email'], $_POST['password'])) {
                $firstName = trim($_POST['firstName']);
                $lastName = trim($_POST['lastName']);
                $userName = trim($_POST['userName']);
                $email = trim($_POST['email']);
                $password = trim($_POST['password']);

                // Crear un nuevo objeto usuario con los nuevos datos
                $user = new User($_SESSION['userLogged']->getIdUser(), $firstName, $lastName, $userName, $email, $password);
                $user->setUserRole($_SESSION['userLogged']->getUserRole());
                /*     $user->setStatus($_SESSION['userLogged']->getStatus()); */

                // Actualizar en la base de datos
                $userDAO = new UserDAO();
                if ($userDAO->update($user)) {
                    // Actualizar la sesión con los nuevos datos
                    $_SESSION['userLogged'] = $user;
                    // Redirigir a la página de perfil para evitar el reenvío del formulario
                    header('Location: index.php?c=user&f=perfil');
                    exit(); // Asegúrate de detener el script después de la redirección
                } else {
                    echo "Error al actualizar los datos.";
                }
            }
        } else {
            header('Location: index.php?c=index&f=index');
            exit();
        }
    }


    // Método para eliminar la cuenta (cambiar estado a 0)
    public function deleteAccount()
    {
        $userId = $_SESSION['userLogged']->getIdUser();
        $userDAO = new UserDAO();

        // Cambiar el status a 0 (eliminación lógica)
        if ($userDAO->delete($userId)) {
            session_unset();
            session_destroy();
            header('Location: index.php?c=user&f=login');
        } else {
            echo "Error al eliminar la cuenta.";
        }
    }



    //Funcion para poder verigficar si existe la session del usuario, y poder redirigir al homeView
    private function verifyLogin()
    {
        if (isset($_SESSION['userLogged'])) {
            header('Location: index.php?c=index&f=index');
            exit();
        }
    }

    public function login()
    {
        $this->verifyLogin();
        require_once __DIR__ . '/../view/user/user.login.php';
    }

    // Método para procesar el login
    public function processLogin()
    {
        $this->verifyLogin();

        // Obtener los valores del formulario
        $userName = $_POST['userName'];
        $password = $_POST['password'];

        // Instancia del DAO y verificación del login
        $userDAO = new UserDAO();
        $user = $userDAO->login($userName, $password);

        if ($user !== null) {
            // Guardar la información del usuario en la sesión
            $_SESSION['userLogged'] = $user;
            header("location:index.php");
            exit();
        } else {
            // Enviar el mensaje de error a la vista sin redireccionar
            $_SESSION['login_error'] = "Ingrese con datos correctos.";
        header("location:index.php?c=user&f=login");
        }
    }


    // Método para mostrar el formulario de registro
    public function register()
    {
        require_once __DIR__ . '/../view/user/user.register.php';
    }

    // Método para procesar el registro
    public function processRegister()
    {
        if (
            isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['userName']) &&
            isset($_POST['email']) && isset($_POST['password'])
        ) {

            $firstName = trim($_POST['firstName']);
            $lastName = trim($_POST['lastName']);
            $userName = trim($_POST['userName']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);  // Cambiado de contrasena a password

            $user = new User(null, $firstName, $lastName, $userName, $email, $password);

            // Asignamos el rol 1 por defecto (Cliente)
            $user->setUserRole(1);  // Asignamos rol por defecto
            $user->setStatus(1);  // Establecemos el estado como activo (1)

            // Registrar el usuario en la base de datos
            $userDAO = new UserDAO();
            if ($userDAO->register($user)) {
                // Redirigir a la página de login
                header('Location: index.php?c=user&f=login');
                exit();
            } else {
                echo "Error al registrar el usuario.";
            }
        }
    }
    public function logout()
    {        
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        session_unset();
        session_destroy();
        header('location: index.php?c=user&f=login');
        exit();
    }
}
