<?php
session_start();

require_once 'model/Guarantee.php';
require_once 'repository/GuaranteeDAO.php';
require_once 'repository/GuaranteeReasonsDAO.php';

class GuaranteeController{
    private $guaranteeDAO;
    private $guaranteeReasonDAO;

    public function __construct(){
        $this->guaranteeDAO = new GuaranteeDAO();
        $this->guaranteeReasonDAO = new GuaranteeReasonsDAO();
    }

    public function index(){
        require_once "view/statics/guarantee.static.php";
    }
    
    public function insertForm(){
        $guaranteeReasons = $this->guaranteeReasonDAO->getGuaranteeReason();//razones quemadas en la db
        var_dump($guaranteeReasons);
        require_once VGUARANTEE . 'new.php';
    }

    public function insert(){
        $guarantee = $this->setData();
        $guaranteeDAO = new GuaranteeDAO();
        $guaranteeDAO->insert($guarantee);
        header("Location: index.php?c=guarantee&f=listGuarantees");
    }

    private function setData(){
        $guarantee = new Guarantee();
        //falta agarrar lo que Mateo pase en la sesion
        //$guarantee->setUserId($_SESSION[]);
        $guarantee->setUserId(1);
        $date = new DateTime('now');
        $guarantee->setRequestDate($date);
        $guarantee->setPurchaseDate(htmlentities($_POST['purchaseDate']));
        $guarantee->setWarrantyReasonId(htmlentities($_POST['warrantyReasonId']));
        $guarantee->setProductCode(htmlentities($_POST['productCode']));
        $guarantee->setInvoiceCode(htmlentities($_POST['invoiceCode']));
        $guarantee->setDescription(htmlentities($_POST['description']));
        $guarantee->setRequestStatus(0);
        $guarantee->setStatus(1);
        return $guarantee;
    }

    public function listGuarantees(){
        $guarantees = $this->guaranteeDAO->getGuarantees();
        require_once 'view/guarantee/guarantee.list.php';
    }
}