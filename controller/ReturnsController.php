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
                /* $return->userId = $_SESSION['userLogged']->userId; */
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
}
