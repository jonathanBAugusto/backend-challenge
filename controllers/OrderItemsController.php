<?php

namespace controllers;

use models\OrderItem;

class OrderItemsController
{
    public static function get($order_id = null)
    {
        $conn = (new Conn())->conn();

        $sql = "SELECT * FROM ORDERITEMS";
        if (isset($id)) {
            $sql .= " WHERE order_id = {$order_id}";
        }
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
            $listOrderItems = null;
            while ($item = $result->fetch_assoc()) {
                $listOrderItems[] = new OrderItem($item["id"], $item["order_id"], $item["product_id"], $item["amount"], $item["price_unit"], $item["total"]);
            }
            return $listOrderItems;
        } else {
            return null;
        }
    }
    public static function postMult($itemsJson, $order_id)
    {
        $items = json_decode($itemsJson, true);
        $sqlToReplace = "INSERT INTO ORDERITEMS (order_id, produto_id, amount, price_unit, total)
            VALUE (%order_id%, %produto_id%, %amount%, %price_unit%, %total%);";
        $sql = "";
        foreach ($items as $item) {
            $sqlAux = str_replace('%order_id%', $order_id, $sqlToReplace);
            $sqlAux = str_replace('%produto_id%', $item['product']['id'], $sqlAux);
            $sqlAux = str_replace('%amount%', $item['amount'], $sqlAux);
            $sqlAux = str_replace('%price_unit%', $item['price_unit'], $sqlAux);
            $sqlAux = str_replace('%total%', $item['total'], $sqlAux);
            $sql .= rtrim($sqlAux, ';');
        }
        $conn = (new Conn())->conn();
        $result = $conn->multi_query($sql);
        $conn->close();
        if ($result === TRUE) {
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
