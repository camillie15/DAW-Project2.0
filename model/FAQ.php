<?php
// autor: Paez Velasco Jimmy Josue

class FAQ {
    private $faqId;
    private $question;
    private $answer;
    private $author;
    private $categoryId;
    private $priority;
    private $creationDate;
    private $status;

    public function __construct() {
        $this->faqId = null;
        $this->question = null;
        $this->answer = null;
        $this->author = null;
        $this->categoryId = null;
        $this->priority = null;
        $this->creationDate = null;
        $this->status = null;
    }

    public function getFaqId() {
        return $this->faqId;
    }

    public function setFaqId($faqId) {
        $this->faqId = $faqId;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function getAnswer() {
        return $this->answer;
    }

    public function setAnswer($answer) {
        $this->answer = $answer;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getCategoryId() {
        return $this->categoryId;
    }

    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;
    }

    public function getPriority() {
        return $this->priority;
    }

    public function setPriority($priority) {
        $this->priority = $priority;
    }

    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function __get($property) {
        return $this->$property;
    }

    public function __set($property, $value) {
        $this->$property = $value;
    }
}
?>
