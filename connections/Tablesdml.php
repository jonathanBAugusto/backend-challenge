<?php

namespace connections;

class TablesDML
{

    public static function products($conn)
    {
        //TODO Todos os atributos são obrigatórios
        //TODO ID, SKU e Nome não podem se repetir
        //TODO Preço é monetário e deve ser maior que zero
        $table = 'PRODUCTS';
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
            sku VARCHAR(17) NOT NULL,
            name VARCHAR(60) NOT NULL,
            price float(9,2) NOT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME
            )";
        if ($conn->query($sql) !== TRUE) {
            die("Erro ao criar tabela {$table}: " . $conn->error);
        }
        return true;
    }

    public static function customers($conn)
    {
        //TODO Todos os atributos são obrigatórios.
        //TODO ID, CPF e e-mail não podem se repetir.
        //TODO CPF deve ser válido.
        $table = 'CUSTOMERS';
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            cpf VARCHAR(14) NOT NULL,
            email VARCHAR(50) NOT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL
            )";
        if ($conn->query($sql) !== TRUE) {
            die("Erro ao criar tabela {$table}");
        }
        return true;
    }

    public static function orders($conn)
    {
        //TODO Todos os atributos são obrigatórios
        //TODO ID não podem se repetir
        //TODO Todos os valores numéricos devem ser maior que zero
        //TODO Total é monetário e deve ser maior que zero
        $table = 'ORDERS';
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
            customer_id INTEGER NOT NULL,
            last_id INTEGER NOT NULL,
            total float(9,2) NOT NULL,
            status VARCHAR(20) NOT NULL,
            cancel_data DATETIME NOT NULL,
            created_at DATETIME NOT NULL
            )";
        if ($conn->query($sql) !== TRUE) {
            die("Erro ao criar tabela {$table}");
        }
        return true;
    }

    public static function orderItems($conn)
    {
        $table = 'ORDERITEMS';
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
            order_id INTEGER NOT NULL,
            product_id INTEGER NOT NULL,
            amount INTEGER NOT NULL,
            price_unit float(9,2) NOT NULL,
            total float(9,2) NOT NULL
            )";
        if ($conn->query($sql) !== TRUE) {
            die("Erro ao criar tabela {$table}");
        }
        return true;
    }
}
