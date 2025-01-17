<?php
class Returns
{
    private $returnId, $userId, $requestDate, $purchaseDate, $productStatus, $productCode, $invoiceCode, $description, $requestStatus, $status;

    function __construct()
    {
        $this->returnId = 0;
    }

    public function __get($var)
    {
        return $this->$var;
    }

    public function __set ($var, $value)
    {
        $this->$var = $value;
    }

}
