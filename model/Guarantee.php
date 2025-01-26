<?php
// autor: Tipan Anton Cesar Alexander

class Guarantee {
    private $guaranteeId, $userId, $requestDate, $purchaseDate, $warrantyReasonId, $productCode, $invoiceCode, $description, $requestStatus, $status;

    function __construct(){
    }

    public function getGuaranteeId() {
        return $this->guaranteeId;
    }

    public function setGuaranteeId($guaranteeId) {
        $this->guaranteeId = $guaranteeId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getRequestDate() {
        return $this->requestDate;
    }

    public function setRequestDate($requestDate) {
        $this->requestDate = $requestDate;
    }

    public function getPurchaseDate() {
        return $this->purchaseDate;
    }

    public function setPurchaseDate($purchaseDate) {
        $this->purchaseDate = $purchaseDate;
    }

    public function getWarrantyReasonId() {
        return $this->warrantyReasonId;
    }

    public function setWarrantyReasonId($warrantyReasonId) {
        $this->warrantyReasonId = $warrantyReasonId;
    }

    public function getProductCode() {
        return $this->productCode;
    }

    public function setProductCode($productCode) {
        $this->productCode = $productCode;
    }

    public function getInvoiceCode() {
        return $this->invoiceCode;
    }

    public function setInvoiceCode($invoiceCode) {
        $this->invoiceCode = $invoiceCode;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getRequestStatus() {
        return $this->requestStatus;
    }

    public function setRequestStatus($requestStatus) {
        $this->requestStatus = $requestStatus;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
