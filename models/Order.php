<?php
namespace models;
class Order
{
    public $id;
    //Id que veio da plataforma (se veio)
    public $customer_id;
    public $last_id;
    public $total;
    public $status;
    //Não existe na tabela do README.md porém se faz necessário
    public $cancel_data;
    public $created_at;

    public function __construct($id, $customer_id, $last_id, $total, $status, $cancel_data = null, $created_at = null)
    {
        $this->id = $id;
        $this->customer_id = $customer_id;
        $this->last_id = $last_id;
        $this->total = $total;
        $this->status = $status;
        $this->cancel_data = $cancel_data;
        $this->created_at = $created_at;
    }
}

