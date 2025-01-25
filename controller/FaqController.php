<?php
// autor: Jimmy Josue Paez Velasco

require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../repository/FAQDAO.php';
require_once __DIR__ . '/../model/FAQ.php';

class FAQController
{
    private $faqDAO;

    public function __construct()
    {   
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }        
        $this->faqDAO = new FAQDAO();
    }

    /* Vista para clientes */
    public function list_client_view()
    {
        // Verifica el rol (1 para cliente)
        $this->PointRol(1); // Si no es el rol 1, redirige a la página principal
        // Captura los parámetros de búsqueda
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;
        $categoryId = isset($_GET['categoryId']) && is_numeric($_GET['categoryId']) ? (int)$_GET['categoryId'] : null;

        // Realiza la búsqueda de FAQs
        $faqs = $this->faqDAO->searchFAQs($keyword, $categoryId);

        require_once VFAQ . 'viewCliente.php';
    }

    /* Vista para el empleado encargado de administrar las FAQs */
    public function list_admin_view()
    {
        // Verifica el rol (3 para administrador de FAQ)
        $this->PointRol(3); // Si no es el rol 3, redirige a la página principal

        // Captura los parámetros de búsqueda
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : null;
        $categoryId = isset($_GET['categoryId']) && is_numeric($_GET['categoryId']) ? (int)$_GET['categoryId'] : null;

        // Realiza la búsqueda de FAQs
        $faqs = $this->faqDAO->searchFAQs($keyword, $categoryId);

        require_once VFAQ . 'viewAdmin.php';
    }
    public function editFaq()
    {
        // Verificar si el usuario tiene el rol adecuado (rol 3 para administrador de FAQ)
        $this->PointRol(3);

        if (isset($_GET['id'])) {
            $faqId = $_GET['id'];
            $faq = $this->faqDAO->getFAQById($faqId); // Obtener la FAQ por ID

            // Si la FAQ existe, mostrar la vista de edición
            if ($faq) {
                require_once VFAQ . 'editFaq.php';
            } else {
                header('Location: index.php?c=faq&f=list_admin_view&message=FAQ no encontrada.');
            }
        } else {
            header('Location: index.php?c=faq&f=list_admin_view&message=ID de FAQ no proporcionado.');
        }
    }

    /* Insertar una nueva FAQ (Solo rol 3) */
    public function insert_faq()
    {
        $this->PointRol(3); // Verifica el rol (3 para administrador de FAQ)

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $formData = $_POST; // Guardar los datos del formulario para reutilizarlos en caso de error

            // Validar los campos
            if (empty(trim($_POST['question']))) {
                $errors['question'] = "La pregunta es obligatoria.";
            }
            if (empty(trim($_POST['answer']))) {
                $errors['answer'] = "La respuesta es obligatoria.";
            }
            if (empty(trim($_POST['author']))) {
                $errors['author'] = "El autor es obligatorio.";
            }
            if (empty($_POST['categoryId']) || !is_numeric($_POST['categoryId'])) {
                $errors['categoryId'] = "Debe seleccionar una categoría válida.";
            }
            if (empty($_POST['priority'])) {
                $errors['priority'] = "Debe seleccionar una prioridad.";
            }

            // Si hay errores, almacenar en la sesión y redirigir
            if (!empty($errors)) {
                session_start();
                $_SESSION['errors'] = $errors;
                $_SESSION['formData'] = $formData;
                header('Location: index.php?c=faq&f=list_admin_view');
                exit();
            }

            // Si no hay errores, proceder a insertar la FAQ
            $faq = new FAQ();
            $faq->setQuestion($_POST['question']);
            $faq->setAnswer($_POST['answer']);
            $faq->setAuthor($_POST['author']);
            $faq->setCategoryId($_POST['categoryId']);
            $faq->setPriority($_POST['priority']);
            $faq->setCreationDate(date('Y-m-d H:i:s'));
            $faq->setStatus(1);

            if ($this->faqDAO->insertFAQ($faq)) {
                header('Location: index.php?c=faq&f=list_admin_view&message=FAQ agregada con éxito.');
            } else {
                session_start();
                $_SESSION['errors'] = ['general' => 'Error al agregar la FAQ. Inténtelo nuevamente.'];
                $_SESSION['formData'] = $formData;
                header('Location: index.php?c=faq&f=list_admin_view');
            }
        }
    }


    public function update_faq()
    {
        $this->PointRol(3); // Verificar el rol (3 = administrador)
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $formData = $_POST; // Guardar los datos del formulario para reutilizarlos en caso de error
    
            // Validar los campos
            if (empty(trim($_POST['question']))) {
                $errors['question'] = "La pregunta es obligatoria.";
            }
            if (empty(trim($_POST['answer']))) {
                $errors['answer'] = "La respuesta es obligatoria.";
            }
            if (empty(trim($_POST['author']))) {
                $errors['author'] = "El autor es obligatorio.";
            }
            if (empty($_POST['categoryId']) || !is_numeric($_POST['categoryId'])) {
                $errors['categoryId'] = "Debe seleccionar una categoría válida.";
            }
            if (empty($_POST['priority'])) {
                $errors['priority'] = "Debe seleccionar una prioridad.";
            }
    
            // Si hay errores, almacenar en la sesión y redirigir
            if (!empty($errors)) {
                session_start();
                $_SESSION['errors'] = $errors;
                $_SESSION['formData'] = $formData;
                header('Location: index.php?c=faq&f=editFaq&id=' . $_POST['frequentQuestionId']);
                exit();
            }
    
            // Si no hay errores, proceder a actualizar la FAQ
            $faq = new FAQ();
            $faq->setFaqId($_POST['frequentQuestionId']);
            $faq->setQuestion($_POST['question']);
            $faq->setAnswer($_POST['answer']);
            $faq->setAuthor($_POST['author']);
            $faq->setCategoryId($_POST['categoryId']);
            $faq->setPriority($_POST['priority']);
            $faq->setStatus($_POST['status']);
    
            if ($this->faqDAO->updateFAQ($faq)) {
                header('Location: index.php?c=faq&f=list_admin_view&message=FAQ actualizada con éxito.');
            } else {
                session_start();
                $_SESSION['errors'] = ['general' => 'Error al actualizar la FAQ. Inténtelo nuevamente.'];
                $_SESSION['formData'] = $formData;
                header('Location: index.php?c=faq&f=editFaq&id=' . $_POST['frequentQuestionId']);
            }
        }
    }
    

    public function delete_faq()
    {
        // Verifica si el usuario tiene el rol adecuado (rol 3 para administrador de FAQ)
        $this->PointRol(3);

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $faqId = (int)$_GET['id'];

            if ($this->faqDAO->deleteFAQ($faqId)) {
                header('Location: index.php?c=faq&f=list_admin_view&message=FAQ eliminada con éxito.');
            } else {
                header('Location: index.php?c=faq&f=list_admin_view&message=Error al eliminar la FAQ.');
            }
        } else {
            header('Location: index.php?c=faq&f=list_admin_view&message=ID inválido.');
        }
    }


    private function PointRol($rol)
    {
        // Este método redirige a la página de inicio si el rol no es 3 ni 1
        if ($rol !== 3 && $rol !== 1) {
            header("location: index.php"); // Redirige a la página principal si el rol no es 3 ni 1
            exit();
        }
    }
}