<?php
// autor: Erick Alejandro Cordova Viteri

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Returns.php';
require_once __DIR__ . '/../repository/ReturnsDAO.php';
class ReturnsController
{

    private $returnRepository;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->returnRepository = new ReturnsDAO();
    }

    /**
     * Static page of returns
     */
    //Client
    public function index()
    {
        $this->returnToHome(1);
        require_once __DIR__ . '/../view/statics/return.static.php';
    }


    /**
     * Method to insert a new return, page and logic insert
     */
    //Client
    public function insert_view()
    {
        $this->returnToHome(1);
        require_once __DIR__ . '/../view/return/return.insert.php';
    }

    //Client
    public function insert_new_return()
    {
        $this->returnToHome(1);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                //InsertId of user Logged
                $userId = $_SESSION['userLogged']->getIdUser();

                $currentDate = new DateTime('NOW');

                $return = new Returns();
                $return = $this->createReturnObject($currentDate, null, $userId);

                //$result = $this->returnRepository->insertReturnRequest($return);

                $result =  $return != null ? $this->returnRepository->insertReturnRequest($return) : false;

                if ($result) {
                    $this->redirectWithMessage(true, "Solicitud enviada con exito", "index.php?c=returns&f=index");
                } else {
                    $this->redirectWithMessage(false, "Ha ocurrido un error al intentar enviar tu solicitud ", "index.php?c=returns&f=insert_view");
                }
            } catch (Exception $e) {
                $this->redirectWithMessage(false, "Ha ocurrido un error al intentar enviar tu solicitud", "index.php?c=returns&f=insert_view");
            }
        }
    }

    /**
     * Method to view list of reuest returns clients, page and logic view list
     */
    //Client
    public function list_client_view()
    {
        $this->returnToHome(1);
        $userId = $_SESSION['userLogged']->getIdUser();
        $title = "Historial de peticiones de devolucion";
        $returns = [];
        $returns = $this->returnRepository->searchReturnsRequestById($userId);
        require_once __DIR__ . '/../view/return/return.list.php';
    }

    /**
     * Method to view all list of request, page and logic view list
     */
    //Employee 1
    public function list_view()
    {
        $this->returnToHome(2);
        $title = "Gestion peticiones de devolucion";
        $returns = $this->returnRepository->listReturnsRequests();
        require_once __DIR__ . '/../view/return/return.list.php';
    }

    /**
     * Method to update a return, page and logic update
     */
    //Client
    public function update_view()
    {
        $this->returnToHome(1);
        $returnId = $_GET['id'];
        $return = $this->returnRepository->searchReturnRequestById($returnId);
        require_once __DIR__ . '/../view/return/return.update.php';
    }

    //Client
    public function update_return()
    {
        $this->returnToHome(1);
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $id = $_GET['id'];
                $return = new Returns();

                $return = $this->createReturnObject(null, $id, null);
                $result = $return != null ?  $this->returnRepository->updateReturnRequest($id, $return) : false;
                if ($result) {
                    $this->redirectWithMessage(true, "Solicitud actualizada con exito", "index.php?c=returns&f=list_client_view");
                } else {
                    $this->redirectWithMessage(false, "Ha ocurrido un error al intentar actualizar tu solicitud ", "index.php?c=returns&f=update_view&id=" . $_GET['id']);
                }
            } catch (Exception $e) {
                $this->redirectWithMessage(false, "Ha ocurrido un error al intentar actualizar tu solicitud", "index.php?c=returns&f=update_view&id=" . $_GET['id']);
            }
        }
    }

    /**
     * Method to delete a return request
     */

    //Client
    public function delete_return()
    {
        $this->returnToHome(1);
        $returnId = $_GET['id'];
        $result = $this->returnRepository->deleteReturnRequest($returnId);
        if ($result) {
            $this->redirectWithMessage(true, "Solicitud eliminada con exito", "index.php?c=returns&f=list_client_view");
        } else {
            $this->redirectWithMessage(false, "Ha ocurrido un error al intentar eliminar tu solicitud", "index.php?c=returns&f=list_client_view");
        }
    }

    /**
     * Method to accept o deny return request client
     */
    //Employee 1
    public function reply_request()
    {
        $this->returnToHome(2);
        if (isset($_GET['id']) && isset($_GET['r'])) {
            $returnId = $_GET['id'];
            $reply = $_GET['r'];
            $result = $this->returnRepository->updateRequestStatus($returnId, $reply);
        } else {
            $result = false;
        }

        if ($result) {
            $this->redirectWithMessage(true, "Solicitud actualizada con exito", "index.php?c=returns&f=list_view");
        } else {
            $this->redirectWithMessage(false, "Ha ocurrido un error al intentar actualizar tu solicitud", "index.php?c=returns&f=list_view");
        }
    }

    /*------------------ Special Methods -----------------------*/
    /**
     * Method to compare, rol of users and redirect
     * $rol = 1 -> rol of client
     * $rol = 1 -> rol of manage employee of petitions 
     */
    private function returnToHome($rol)
    {
        if (!isset($_SESSION['userLogged'])) {
            header("location: index.php?c=user&f=login");
            exit();
        }
        $rolUser = $_SESSION['userLogged']->getUserRole(); //Here will go userRol of session created
        if ($rol !== $rolUser) {
            header("location: index.php");
            exit();
        }
    }

    /**
     * Method to redirect a page with a message
     */
    private function redirectWithMessage($flag, $message, $path)
    {
        $flag ? header("location: $path&message=$message") : header("location: $path&message=$message");
    }

    /**
     * Method to create a new object of return, clean code
     */
    private function createReturnObject($currentDate, $returnId, $userId)
    {
        $return = new Returns();
        $return->setReturnId($returnId);
        $return->setUserId($userId);
        $return->setRequestDate($currentDate != null ? $currentDate->format('Y-m-d H:i:s') : null);
        $return->setRequestStatus(0);
        $return->setStatus(1);
        if (!$this->checkEntryNull()) {
            $return->setPurchaseDate(htmlentities($_POST['purchase_date']));
            $return->setProductStatus(htmlentities($_POST['product_status']));
            $return->setProductCode(htmlentities($_POST['product_code']));
            $return->setInvoiceCode(htmlentities($_POST['invoice_code']));
            $return->setDescription(htmlentities($_POST['description']));
        } else {
            $return = null;
        }
        return $return;
    }

    private function checkEntryNull(){
        $compare = [$_POST['purchase_date'], $_POST['product_status'], $_POST['product_code'], $_POST['invoice_code'], $_POST['description']];
        $flag = false;
        foreach ($compare as $value) {
            if(trim($value) == null){
                $flag = true;
                break;
            }
        }
        return $flag;
    }
}
