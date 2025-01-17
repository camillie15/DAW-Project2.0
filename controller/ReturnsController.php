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

    public function index()
    {
        require_once 'view/statics/return.php';
    }

    public function insert_view()
    {
        require_once 'view/return/return.insert.php';
    }

    public function insertNewReturn(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $currentDate = new DateTime();
            $return = new Returns();
            $return->userId = $_SESSION['userLogged']->userId;
            $return->__set('requestDate', $currentDate->format('Y-m-d H:i:s'));
            $return->__set('purchaseDate' , $_POST['purchaseDate']);
            $return->__set('productStatus' , $_POST['productStatus']);
            $return->__set('productCode' , $_POST['productCode']);
            $return->__set('invoiceCode' , $_POST['invoiceCode']);
            $return->__set('description' , $_POST['description']);
            $return->__set('requestStatus' ,0);
            $return->__set('status' , 1);
            $result = $this->model->insertReturnRequest($return);
            $this->insert_view();
        }
    }
}
