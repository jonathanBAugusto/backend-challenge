<?php

namespace models;

class Order
{
    public $id;
    //Id que veio da plataforma (se veio)
    public $customer_id;
    // public $partner_id;
    public $total;
    public $status;
    //Não existe na tabela do README.md porém se faz necessário
    public $cancel_data;
    public $created_at;

    // public function __construct($id, $customer_id, $partner_id, $total, $status, $cancel_data = null, $created_at = null)
    public function __construct($id, $customer_id, $total, $status, $cancel_data = null, $created_at = null)
    {
        $this->id = $id;
        $this->customer_id = $customer_id;
        // $this->partner_id = $partner_id;
        $this->total = $total;
        $this->status = $status;
        $this->cancel_data = $cancel_data;
        $this->created_at = $created_at;
    }

    public static function fromJson($json)
    {
        $jsonObj = json_decode($json, true);
        // return new Order($jsonObj['id'] ?? null, $jsonObj['customer_id'] ?? null, $jsonObj['partner_id'] ?? null, $jsonObj['total'] ?? null, $jsonObj['status'] ?? null, $jsonObj['cancel_data'] ?? null, $jsonObj['created_at'] ?? null, $jsonObj['updated_at'] ?? null) ?? null;
        return new Order($jsonObj['id'] ?? null, $jsonObj['customer_id'] ?? null, $jsonObj['total'] ?? null, $jsonObj['status'] ?? null, $jsonObj['cancel_data'] ?? null, $jsonObj['created_at'] ?? null, $jsonObj['updated_at'] ?? null) ?? null;
    }


    public static function validator($order)
    {
        $missingFields = array();
        if (!isset($order['id']))
            $missingFields[] = 'id';

        if (!isset($order['customer_id']))
            $missingFields[] = 'customer_id';

        if (!isset($order['total']))
            $missingFields[] = 'total';

        if (!isset($order['status']))
            $missingFields[] = 'status';

        if (!isset($order['cancel_data']))
            $missingFields[] = 'cancel_data';

        if (!isset($order['created_at']))
            $missingFields[] = 'created_at';

        if (isset($missingFields))
            die("Faltam os seguintes campos para concluir a inserção em 'Order': " . PHP_EOL . PHP_EOL . implode(PHP_EOL, $missingFields));
        else
            true;
    }
}
