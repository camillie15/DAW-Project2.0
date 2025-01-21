<?php
session_start();

require_once 'model/Guarantee.php';
require_once 'repository/GuaranteeDAO.php';
require_once 'repository/GuaranteeReasonsDAO.php';

class GuaranteeController
{
    private $guaranteeDAO;
    private $guaranteeReasonDAO;

    public function __construct()
    {
        $this->guaranteeDAO = new GuaranteeDAO();
        $this->guaranteeReasonDAO = new GuaranteeReasonsDAO();
    }

    public function index()
    {
        require_once "view/statics/guarantee.static.php";
    }

    public function insertForm()
    {
        $guaranteeReasons = $this->guaranteeReasonDAO->getGuaranteeReason();
        require_once VGUARANTEE . 'new.php';
    }

    public function insert()
    {
        $guarantee = $this->setData();
        $this->guaranteeDAO->insert($guarantee);
        header("Location: index.php?c=guarantee&f=listGuarantees");
    }

    public function listGuarantees() {
        $guarantees = $this->guaranteeDAO->getGuarantees();
        
        foreach ($guarantees as $index => $guarantee) {
            $guarantees[$index]['warrantyReasonName'] = $this->getWarrantyReasonName($guarantee['warrantyReasonId']);
        }

        foreach ($guarantees as $index => $guarantee) {
            $guarantees[$index]['requestStatusName'] = $this->getRequestStatusName($guarantee['requestStatus']);
        }
        require_once 'view/guarantee/guarantee.list.php';
    }
      

    public function editForm()
    {
        $guaranteeId = $_GET['id'];
        $guarantee = $this->guaranteeDAO->getGuaranteeById($guaranteeId);
        if ($guarantee) {
            require_once VGUARANTEE . 'edit.php';
        } else {
            $errorMessage = "No se encontró la garantía.";
            require_once 'view/statics/error.php';
        }
    }

    public function delete()
    {
        $guaranteeId = $_GET['id'];
        $this->guaranteeDAO->delete($guaranteeId);
        header("Location: index.php?c=guarantee&f=listGuarantees");
    }

    public function update()
    {
        $guaranteeId = $_POST['guaranteeId'];
        $guaranteeData = $this->guaranteeDAO->getGuaranteeById($guaranteeId);

        if ($guaranteeData) {
            $guarantee = new Guarantee();
            $guarantee->setGuaranteeId($guaranteeData['guaranteeId']);
            $guarantee->setUserId($guaranteeData['userId']);
            $guarantee->setRequestDate(new DateTime($guaranteeData['requestDate']));
            $guarantee->setPurchaseDate($guaranteeData['purchaseDate']);
            $guarantee->setWarrantyReasonId($guaranteeData['warrantyReasonId']);
            $guarantee->setProductCode($guaranteeData['productCode']);
            $guarantee->setInvoiceCode($guaranteeData['invoiceCode']);
            $guarantee->setDescription($guaranteeData['description']);
            $guarantee->setRequestStatus($guaranteeData['requestStatus']);

            $guarantee->setWarrantyReasonId(htmlentities($_POST['warrantyReasonId']));
            $guarantee->setProductCode(htmlentities($_POST['productCode']));
            $guarantee->setInvoiceCode(htmlentities($_POST['invoiceCode']));
            $guarantee->setDescription(htmlentities($_POST['description']));
            $guarantee->setPurchaseDate(htmlentities($_POST['purchaseDate']));
            $guarantee->setRequestStatus(htmlentities($_POST['requestStatus']));
            $this->guaranteeDAO->update($guarantee);

            header("Location: index.php?c=guarantee&f=listGuarantees");
        } else {
            $errorMessage = "No se encontró la garantía.";
            require_once 'view/statics/error.php';
        }
    }

    private function getRequestStatusName($statusId) {
        switch ($statusId) {
            case 0:
                return 'Pendiente';
            case 1:
                return 'Aprobada';
            case 2:
                return 'Rechazada';
            default:
                return 'Desconocido';
        }
    }

    private function getWarrantyReasonName($warrantyReasonId) {
        switch ($warrantyReasonId) {
            case 1:
                return 'Defectos de fabricación';
            case 2:
                return 'Problemas de funcionamiento';
            case 3:
                return 'Averías mecánicas, eléctricas o electrónicas';
            case 4:
                return 'Desgaste irregular de piezas';
            case 5:
                return 'Error de ensamblaje';
            default:
                return 'Razón desconocida';
        }
    }    

    private function setData()
    {
        $guarantee = new Guarantee();
        $guarantee->setUserId(1);
        $guarantee->setRequestDate(new DateTime('now'));
        $this->setGuaranteeProperties($guarantee, $_POST);
        $guarantee->setStatus(1);
        return $guarantee;
    }

    private function setGuaranteeProperties($guarantee, $data)
    {
        $guarantee->setPurchaseDate(htmlentities($data['purchaseDate']));
        $guarantee->setWarrantyReasonId(htmlentities($data['warrantyReasonId']));
        $guarantee->setProductCode(htmlentities($data['productCode']));
        $guarantee->setInvoiceCode(htmlentities($data['invoiceCode']));
        $guarantee->setDescription(htmlentities($data['description']));
        $guarantee->setRequestStatus(htmlentities($data['requestStatus']));
    }
}
?>