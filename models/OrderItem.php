<?php
namespace models;
class OrderItem
{
    public $id;
    public $order_id;
    public $product_id;
    public $amount;
    public $price_unit;
    public $total;

    public function __construct($id, $order_id, $product_id, $amount, $price_unit, $total)
    {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->amount = $amount;
        $this->price_unit = $price_unit;
        $this->total = $total;
    }

}

