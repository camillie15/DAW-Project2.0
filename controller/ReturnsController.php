<?php
session_start();
require_once 'model/Returns.php';
require_once 'repository/ReturnsDAO.php';
class ReturnsController
{

    private $model;

    public function __construct()
    {
        $this->model = new ReturnsDAO();
    }

    /**
     * Static page of returns
     */
    public function index()
    {
        require_once 'view/statics/return.static.php';
    }

    /**
     * Method to redirect a page with a message
     */
    public function redirectWithMessage($flag, $message, $path)
    {
        $flag ? header("location: $path&message=$message") : header("location: $path&message=$message");
    }

    /**
     * Method to insert a new return, page and logic insert
     */
    public function insert_view()
    {
        require_once 'view/return/return.insert.php';
    }

    public function insert_new_return()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $currentDate = new DateTime('NOW');
                $return = new Returns();
                //InsertId of user Logged
                /* $return->userId = $_SESSION['userLogged']->userId; */

                /* TestIdUser */
                $return->setUserId(10);
                $return->setRequestDate($currentDate->format('Y-m-d H:i:s'));
                $return->setPurchaseDate(htmlentities($_POST['purchase_date']));
                $return->setProductStatus(htmlentities($_POST['product_status']));
                $return->setProductCode(htmlentities($_POST['product_code']));
                $return->setInvoiceCode(htmlentities($_POST['invoice_code']));
                $return->setDescription(htmlentities($_POST['description']));
                $return->setRequestStatus(0);
                $return->setStatus(1);
                $result = $this->model->insertReturnRequest($return);

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
    public function list_client_view()
    {
        $title = "Historial de peticiones de devolucion";
        $returns = [];
        $returns = $this->model->searchReturnsRequestById(0);
        require_once 'view/return/return.list.php';
    }

    /**
     * Method to view all list of request, page and logic view list
     */
    public function list_view()
    {
        $title = "Gestion peticiones de devolucion";
        $returns = $this->model->listReturnsRequests();
        require_once 'view/return/return.list.php';
    }

    /**
     * Method to update a return, page and logic update
     */

    public function update_view()
    {
        $returnId = $_GET['id'];
        $return = $this->model->searchReturnRequestById($returnId);
        require_once 'view/return/return.update.php';
    }

    public function update_return()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $id = $_GET['id'];
                $return = new Returns();
                $return->setReturnId($_GET['id']);
                $return->setPurchaseDate(htmlentities($_POST['purchase_date']));
                $return->setProductStatus(htmlentities($_POST['product_status']));
                $return->setProductCode(htmlentities($_POST['product_code']));
                $return->setInvoiceCode(htmlentities($_POST['invoice_code']));
                $return->setDescription(htmlentities($_POST['description']));
                $result = $this->model->updateReturnRequest($id, $return);
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

    public function delete_return()
    {
        $returnId = $_GET['id'];
        $result = $this->model->deleteReturnRequest($returnId);
        if ($result) {
            $this->redirectWithMessage(true, "Solicitud eliminada con exito", "index.php?c=returns&f=list_client_view");
        } else {
            $this->redirectWithMessage(false, "Ha ocurrido un error al intentar eliminar tu solicitud", "index.php?c=returns&f=list_client_view");
        }
    }

    /**
     * Method to accept o deny return request client
     */

    public function reply_request()
    {
        $returnId = $_GET['id'];
        $reply = $_GET['r'];
        $result = $this->model->updateRequestStatus($returnId, $reply);
        if ($result) {
            $this->redirectWithMessage(true, "Solicitud actualizada con exito", "index.php?c=returns&f=list_view");
        } else {
            $this->redirectWithMessage(false, "Ha ocurrido un error al intentar actualizar tu solicitud", "index.php?c=returns&f=list_view");
        }
    }
}
