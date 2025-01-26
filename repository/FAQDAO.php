<?php
// autor: Paez Velasco Jimmy Josue

require_once __DIR__ . '/../conf/Connection.php';

class FAQDAO
{
    private $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    /*----------CREATE----------*/
    public function insertFAQ($faq)
    {
        try {
            // Consulta SQL para insertar FAQ
            $script = "INSERT INTO frequentQuestions (question, answer, author, categoryId, priority, creationDate, status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
    
            // Preparar la sentencia
            $stmt = $this->connection->prepare($script);
    
            // Vincular los parámetros a la consulta
            $stmt->bindParam(1, $faq->getQuestion(), PDO::PARAM_STR);
            $stmt->bindParam(2, $faq->getAnswer(), PDO::PARAM_STR);
            $stmt->bindParam(3, $faq->getAuthor(), PDO::PARAM_STR);
            $stmt->bindParam(4, $faq->getCategoryId(), PDO::PARAM_INT);
            $stmt->bindParam(5, $faq->getPriority(), PDO::PARAM_STR);
            $stmt->bindParam(6, $faq->getCreationDate(), PDO::PARAM_STR);
            $stmt->bindParam(7, $faq->getStatus(), PDO::PARAM_INT);
    
            // Ejecutar la consulta
            $result = $stmt->execute();
    
            // Verificar si la inserción fue exitosa
            if ($result) {
                return true;
            } else {
                throw new Exception("Error al insertar la FAQ.");
            }
    
        } catch (PDOException $e) {
            // Registrar el error en el log
            error_log("Error de base de datos en insertFAQ: " . $e->getMessage(), 0);
            return false;
        } catch (Exception $e) {
            // Registrar otros errores
            error_log("Error general en insertFAQ: " . $e->getMessage(), 0);
            return false;
        }
    }
    

    /*----------READ ALL FAQs----------*/
    public function listAllFAQs()
    {
        try {
            $script = "SELECT * FROM frequentQuestions WHERE status = 1 ORDER BY creationDate DESC";
            $stmt = $this->connection->prepare($script);
            $stmt->execute();

            $faqs = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $faq = new FAQ();
                $faq->setFaqId($row['frequentQuestionId']);
                $faq->setQuestion($row['question']);
                $faq->setAnswer($row['answer']);
                $faq->setAuthor($row['author']);
                $faq->setCategoryId($row['categoryId']);
                $faq->setPriority($row['priority']);
                $faq->setCreationDate($row['creationDate']);
                $faq->setStatus($row['status']);
                $faqs[] = $faq;
            }
            return $faqs;
        } catch (PDOException $e) {
            error_log("Fail listAllFAQs: " . $e->getMessage(), 0);
            return [];
        }
    }

    /*----------SEARCH BY CATEGORY OR QUESTION----------*/
    public function searchFAQs($keyword = null, $categoryId = null)
    {
        try {
            $script = "SELECT * FROM frequentQuestions WHERE status = 1";
            
            // Filtrar por palabra clave o categoría si se proporcionan
            if (!empty($keyword)) {
                $script .= " AND question LIKE :keyword";
            }
            if (!empty($categoryId)) {
                $script .= " AND categoryId = :categoryId";
            }
            
            $script .= " ORDER BY creationDate DESC";
            $stmt = $this->connection->prepare($script);

            // Pasar parámetros dinámicos
            if (!empty($keyword)) {
                $stmt->bindValue(':keyword', '%' . $keyword . '%', PDO::PARAM_STR);
            }
            if (!empty($categoryId)) {
                $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            
            $faqs = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $faq = new FAQ();
                $faq->setFaqId($row['frequentQuestionId']);
                $faq->setQuestion($row['question']);
                $faq->setAnswer($row['answer']);
                $faq->setAuthor($row['author']);
                $faq->setCategoryId($row['categoryId']);
                $faq->setPriority($row['priority']);
                $faq->setCreationDate($row['creationDate']);
                $faq->setStatus($row['status']);
                $faqs[] = $faq;
            }
            return $faqs;
        } catch (PDOException $e) {
            error_log("Fail searchFAQs: " . $e->getMessage(), 0);
            return [];
        }
    }
    /*----------GET FAQ BY ID----------*/
    public function getFAQById($faqId)
    {
        try {
            $script = "SELECT * FROM frequentQuestions WHERE frequentQuestionId = :faqId";
            $stmt = $this->connection->prepare($script);
            $stmt->bindParam(":faqId", $faqId, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                $faq = new FAQ();
                $faq->setFaqId($row['frequentQuestionId']);
                $faq->setQuestion($row['question']);
                $faq->setAnswer($row['answer']);
                $faq->setAuthor($row['author']);
                $faq->setCategoryId($row['categoryId']);
                $faq->setPriority($row['priority']);
                $faq->setCreationDate($row['creationDate']);
                $faq->setStatus($row['status']);
                return $faq;
            }
            return null;
        } catch (PDOException $e) {
            error_log("Fail getFAQById: " . $e->getMessage(), 0);
            return null;
        }
    }

    /*----------UPDATE----------*/
    public function updateFAQ($faq) {
        try {
            $query = "UPDATE frequentQuestions 
                      SET question = :question, 
                          answer = :answer, 
                          author = :author, 
                          categoryId = :categoryId, 
                          priority = :priority, 
                          status = :status
                      WHERE frequentQuestionId = :faqId";
    
            $stmt = $this->connection->prepare($query);
    
            // Asignar los parámetros
            $stmt->bindParam(':question', $faq->getQuestion());
            $stmt->bindParam(':answer', $faq->getAnswer());
            $stmt->bindParam(':author', $faq->getAuthor());
            $stmt->bindParam(':categoryId', $faq->getCategoryId());
            $stmt->bindParam(':priority', $faq->getPriority());
            $stmt->bindParam(':status', $faq->getStatus());
            $stmt->bindParam(':faqId', $faq->getFaqId(), PDO::PARAM_INT);
    
            // Ejecutar la consulta
            $stmt->execute();
    
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    /*----------DELETE----------*/
    public function deleteFAQ($faqId)
    {
        try {
            $script = "UPDATE frequentQuestions SET status = 0 WHERE frequentQuestionId = :faqId";
            $stmt = $this->connection->prepare($script);
            $stmt->bindParam(":faqId", $faqId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Fail deleteFAQ: " . $e->getMessage(), 0);
            return false;
        }
    }
}
?>
