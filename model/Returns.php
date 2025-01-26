<?php
// autor: Cordova Viteri Erick Alejandro 

class Returns
{
    private $returnId, $userId, $requestDate, $purchaseDate, $productStatus, $productCode, $invoiceCode, $description, $requestStatus, $status;

    function __construct()
    {
        $this->returnId = null;
        $this->userId = null;
        $this->requestDate = null;
        $this->purchaseDate = null;
        $this->productStatus = null;
        $this->productCode = null;
        $this->invoiceCode = null;
        $this->description = null;
        $this->requestStatus = null;
        $this->status = null;
    }


    public function getReturnId()
    {
        return $this->returnId;
    }

    public function setReturnId($returnId)
    {
        $this->returnId = $returnId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function getRequestDate()
    {
        return $this->requestDate;
    }

    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;
    }

    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;
    }

    public function getProductStatus()
    {
        return $this->productStatus;
    }

    public function setProductStatus($productStatus)
    {
        $this->productStatus = $productStatus;
    }

    public function getProductCode()
    {
        return $this->productCode;
    }

    public function setProductCode($productCode)
    {
        $this->productCode = $productCode;
    }

    public function getInvoiceCode()
    {
        return $this->invoiceCode;
    }

    public function setInvoiceCode($invoiceCode)
    {
        $this->invoiceCode = $invoiceCode;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getRequestStatus()
    {
        return $this->requestStatus;
    }

    public function setRequestStatus($requestStatus)
    {
        $this->requestStatus = $requestStatus;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function __get($var)
    {
        return $this->$var;
    }

    // Métodos setter si deseas establecer valores
    public function __set($var, $value)
    {
        $this->$var = $value;
    }
}
