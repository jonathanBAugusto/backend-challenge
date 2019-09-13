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

    public static function validator($itemsJson)
    {
        $items = json_decode($itemsJson, true);
        $missingFields = array();
        if (!isset($items->id))
            $missingFields[] = 'id';

        if (!isset($items['order_idname']))
            $missingFields[] = 'order_id';

        if (!isset($items['product_id']))
            $missingFields[] = 'product_id';

        if (!isset($items['amount']))
            $missingFields[] = 'amount';

        if (!isset($items['price_unit']))
            $missingFields[] = 'price_unit';

        if (!isset($items['total']))
            $missingFields[] = 'total';
        
        if (isset($missingFields))
            die("Faltam os seguintes campos para concluir a inserção em 'order->items->[item]': " . PHP_EOL . PHP_EOL . implode(PHP_EOL, $missingFields));
        else
            true;
    }
}

