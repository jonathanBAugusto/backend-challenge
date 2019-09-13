<?php

namespace controllers;

use models\Customer;
use connections\Conn;

class CustomersController
{
    public static function get()
    {
        $conn = (new Conn())->conn();

        $sql = "SELECT * FROM CUSTOMERS";
        $result = $conn->query($sql);
        $conn->close();
        if (isset($result) && $result->num_rows > 0) {
            $listCustomers = null;
            while ($customer = $result->fetch_assoc()) {
                $listCustomers[] = new Customer($customer["id"], $customer["name"], $customer["cpf"], $customer["email"], $customer["created_at"], $customer["updated_at"]);
            }
            return $listCustomers;
        } else {
            return null;
        }
    }
    public static function getByID($id)
    {
        if (!isset($id))
            return;

        $conn = (new Conn())->conn();

        $sql = "SELECT * FROM CUSTOMERS WHERE ID = {$id}";
        $result = $conn->query($sql);
        $conn->close();
        if ($result->num_rows > 0) {
            $customerObj = null;
            while ($customer = $result->fetch_assoc()) {
                $customerObj = new Customer($customer["id"], $customer["name"], $customer["cpf"], $customer["email"], $customer["created_at"], $customer["updated_at"]);
            }
            return $customerObj;
        } else {
            return null;
        }
    }
    public static function post(Customer $customer)
    {
        
        $conn = (new Conn())->conn();
        if (!isset($customer) || Customer::validator($customer) != true)
            return null;
        $sql = "INSERT INTO CUSTOMERS 
        (
            id,
            name,
            cpf,
            email,
            created_at,
            updated_at)
        VALUES
        (
            {$customer->id},
            '{$customer->name}',
            '{$customer->cpf}',
            '{$customer->email}',
            '{$customer->created_at}',
            '{$customer->updated_at}'
        )";
        $result = $conn->query($sql);
        $error = $conn->error;
        $conn->close();
        if ($result === TRUE) {
            return $result;
        } else {
            return "Error: " . PHP_EOL . $error;
        }
    }
}
