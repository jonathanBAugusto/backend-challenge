<?php

namespace controllers;

use models\Order;
use controllers\OrderItemsController;

class OrdersController
{
    public static function get($id = null)
    {
        $conn = (new Conn())->conn();

        $sql = "SELECT * FROM ORDERS";
        if (isset($id)) {
            $sql .= " WHERE id = {$id}";
        }
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
            $listOrders = null;
            while ($order = $result->fetch_assoc()) {
                $buyer = CustomerController::getByID($order['customer_id']);
                $listItems = $this->getItems($order["id"]);
                $listOrders[] = [
                    "id" => $order["id"],
                    "created_at" => $order["created_at"],
                    "cancel_data" => $order["cancel_data"],
                    "status" => $order["status"],
                    "total" => $order["total"],
                    "buyer" => $buyer,
                    "items" => $listItems
                ];
            }
            return $listOrders;
        } else {
            return null;
        }
    }

    public static function post($orderJson)
    {
        $order = json_decode($orderJson, true);

        $conn = (new Conn())->conn();
        if (!isset($order))
            return null;
        $sql = "INSERT INTO ORDERS
        (
            customer_id,
            last_id,
            total,
            status,
            created_at,
            cancel_data,
        )
        INTO
        (
            {$order['buyer']['id']},
            {$order['id']},
            {$order['total']},
            '{$order['status']},'
            '{$order['created_at']}',
            '{$order['cancel_data']}',
        )";
        $result = $conn->query($sql);
        $conn->close();
        if ($result !== TRUE) {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
        OrderItemsController::postMult($order['items'], $result);
    }
    public static function put($id, $status)
    {
        $conn = (new Conn())->conn();
        if (!isset($order))
            return null;
        $sql = "UPDATE ORDERS SET
            status = 'CANCEL'
        WHERE
            id = {$id}";
        $result = $conn->query($sql);
        $conn->close();
        if ($result === TRUE) {
            return true;
        } else {
            return "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    static function getItems($order_id)
    {
        $itemsObj = OrderItemsController::get($order_id);
        $listItems[] = null;
        foreach ($itemsObj as $itemObj) {
            $product = ProductController::get($itemObj["product_id"]);
            $listItems[] = [
                "product" => [
                    "id" => $product["id"],
                    "sku" => $product["sku"],
                    "title" => $product["name"],
                ],
                "amount" => $itemObj['amount'],
                "price_unit" => $itemObj['price_unit'],
                "total" => $itemObj['total'],
            ];
        }
    }
}
