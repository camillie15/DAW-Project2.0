<?php
// autor: Cesar Alexander Tipan Anton

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Guarantee.php';
require_once __DIR__ . '/../repository/GuaranteeDAO.php';
require_once __DIR__ . '/../repository/GuaranteeReasonsDAO.php';
require_once __DIR__ . '/../repository/UserDAO.php';

class GuaranteeController
{
    private $guaranteeDAO;
    private $guaranteeReasonDAO;

    private $userDAO;

    const ROLE_CLIENT = 1;
    const ROLE_EMPLOYEE = 2;

    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        
        $this->guaranteeDAO = new GuaranteeDAO();
        $this->guaranteeReasonDAO = new GuaranteeReasonsDAO();
        $this->userDAO = new UserDAO();
    }

    private function checkRole($rol)
    {
        if (!isset($_SESSION['userLogged']) || $_SESSION['userLogged']->getUserRole() != $rol) {
            Header("Location: index.php");
            exit();
        }
    }

    public function index()
    {
        require_once __DIR__ . "/../view/statics/guarantee.static.php";
    }

    public function insertForm()
    {
        $this->checkRole(self::ROLE_CLIENT);
        $guaranteeReasons = $this->guaranteeReasonDAO->getGuaranteeReason();

        $error = isset($_SESSION['error']) ? $_SESSION['error'] : [];
        $formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
        unset($_SESSION['error']);
        unset($_SESSION['form_data']);

        require_once VGUARANTEE . 'new.php';
    }

    public function insert()
    {
        $this->checkRole(self::ROLE_CLIENT);
        $guarantee = $this->setData();
        $this->guaranteeDAO->insert($guarantee);
        header("Location: index.php?c=guarantee&f=listGuarantees");
    }

    public function listGuarantees()
    {
        $rol = $_SESSION['userLogged']->getUserRole();

        if ($rol == self::ROLE_CLIENT) {
            $this->checkRole(self::ROLE_CLIENT);
            $userId = $_SESSION['userLogged']->getIdUser();
            $guarantees = $this->guaranteeDAO->getGuaranteesByUserId($userId);
        } else if ($rol == self::ROLE_EMPLOYEE) {
            $this->checkRole(self::ROLE_EMPLOYEE);
            $guarantees = $this->guaranteeDAO->getGuarantees();

            foreach ($guarantees as $index => $guarantee) {
                $user = $this->userDAO->getUserById($guarantee['userId']);
                $guarantees[$index]['userName'] = $user['userName'];
            }
        } else {
            Header("Location: index.php");
            exit();
        }

        foreach ($guarantees as $index => $guarantee) {
            $guarantees[$index]['warrantyReasonName'] = $this->getWarrantyReasonName($guarantee['warrantyReasonId']);
            $guarantees[$index]['requestStatusName'] = $this->getRequestStatusName($guarantee['requestStatus']);
        }

        require_once __DIR__ . '/../view/guarantee/guarantee.list.php';
    }

    public function editForm()
    {
        $this->checkRole(self::ROLE_CLIENT);
        $guaranteeId = $_GET['id'];
        $guarantee = $this->guaranteeDAO->getGuaranteeById($guaranteeId);
        $guaranteeReasons = $this->guaranteeReasonDAO->getGuaranteeReason();
        $error = isset($_SESSION['error']) ? $_SESSION['error'] : [];
        $formData = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];
        unset($_SESSION['error']);
        unset($_SESSION['form_data']);

        if ($guarantee) {
            require_once VGUARANTEE . 'edit.php';
        } else {
            $errorMessage = "No se encontró la garantía.";
            require_once __DIR__ . '/../view/statics/error.php';
        }
    }


    public function delete()
    {
        $this->checkRole(self::ROLE_CLIENT);
        $guaranteeId = $_GET['id'];
        $this->guaranteeDAO->delete($guaranteeId);
        header("Location: index.php?c=guarantee&f=listGuarantees");
    }

    public function update()
    {
        $this->checkRole(self::ROLE_CLIENT);
        $guaranteeId = $_POST['guaranteeId'];
        $guaranteeData = $this->guaranteeDAO->getGuaranteeById($guaranteeId);

        if ($guaranteeData) {
            $error = [];
            unset($_SESSION['error']);
            unset($_SESSION['form_data']);

            $formData = [
                'productCode' => trim($_POST['productCode']),
                'invoiceCode' => trim($_POST['invoiceCode']),
                'description' => trim($_POST['description']),
                'purchaseDate' => trim($_POST['purchaseDate']),
                'warrantyReasonId' => trim($_POST['warrantyReasonId']),
            ];

            if (empty($formData['productCode'])) {
                $error[] = "El código del producto es requerido.";
            }
            if (empty($formData['invoiceCode'])) {
                $error[] = "El código de factura es requerido.";
            }
            if (empty($formData['description'])) {
                $error[] = "La descripción es requerida.";
            }

            $_SESSION['form_data'] = $formData;
            if (count($error) > 0) {
                $_SESSION['error'] = $error;
                header("Location: index.php?c=guarantee&f=editForm&id=$guaranteeId");
                exit();
            }

            $guarantee = new Guarantee();
            $guarantee->setGuaranteeId($guaranteeData['guaranteeId']);
            $guarantee->setUserId($guaranteeData['userId']);
            $guarantee->setRequestDate(new DateTime($guaranteeData['requestDate']));
            $guarantee->setPurchaseDate(htmlentities($formData['purchaseDate']));
            $guarantee->setWarrantyReasonId(htmlentities($formData['warrantyReasonId']));
            $guarantee->setProductCode(htmlentities($formData['productCode']));
            $guarantee->setInvoiceCode(htmlentities($formData['invoiceCode']));
            $guarantee->setDescription(htmlentities($formData['description']));
            $guarantee->setRequestStatus($guaranteeData['requestStatus']);

            $this->guaranteeDAO->update($guarantee);

            header("Location: index.php?c=guarantee&f=listGuarantees");
        } else {
            $errorMessage = "No se encontró la garantía.";
            require_once __DIR__ . '/../view/statics/error.php';
        }
    }

    public function updateStatus()
    {
        $this->checkRole(self::ROLE_EMPLOYEE);

        $guaranteeId = $_GET['id'];
        $newStatus = $_POST['status'];

        $this->guaranteeDAO->updateStatus($guaranteeId, $newStatus);

        header("Location: index.php?c=guarantee&f=listGuarantees");
    }

    private function getRequestStatusName($statusId)
    {
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

    private function getWarrantyReasonName($warrantyReasonId)
    {
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
        $guarantee->setUserId($_SESSION['userLogged']->getIdUser());
        $guarantee->setRequestDate(new DateTime('now'));
        $this->setGuaranteeProperties($guarantee, $_POST);
        $guarantee->setStatus(1);
        return $guarantee;
    }

    private function setGuaranteeProperties($guarantee, $data)
    {
        $error = [];
        unset($_SESSION['error']);
        unset($_SESSION['form_data']);

        $formData = [
            'productCode' => trim($data['productCode']),
            'invoiceCode' => trim($data['invoiceCode']),
            'description' => trim($data['description']),
            'purchaseDate' => trim($data['purchaseDate']),
            'warrantyReasonId' => trim($data['warrantyReasonId']),
        ];

        if (empty($formData['productCode'])) {
            $error[] = "El código del producto es requerido.";
        }
        if (empty($formData['invoiceCode'])) {
            $error[] = "El código de factura es requerido.";
        }
        if (empty($formData['description'])) {
            $error[] = "La descripción es requerida.";
        }

        $_SESSION['form_data'] = $formData;
        if (count($error) > 0) {
            $_SESSION['error'] = $error;
            header("Location: index.php?c=guarantee&f=insertForm");
            exit();
        }

        $guarantee->setPurchaseDate(htmlentities($formData['purchaseDate']));
        $guarantee->setWarrantyReasonId(htmlentities($formData['warrantyReasonId']));
        $guarantee->setProductCode(htmlentities($formData['productCode']));
        $guarantee->setInvoiceCode(htmlentities($formData['invoiceCode']));
        $guarantee->setDescription(htmlentities($formData['description']));
    }
}
?>