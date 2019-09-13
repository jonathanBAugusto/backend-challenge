<?php

namespace connections;

class TablesDML
{
    public static function products($conn)
    {
        $table = 'PRODUCTS';
        //Colunas que seriam adicionadas caso a Regra de negócio permitisse o auto increment no ID, adicionando assim o PARTNER_ID que armazenaria o ID original
        //id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //partner_id INTEGER,
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INTEGER NOT NULL PRIMARY KEY,
            sku VARCHAR(17) NOT NULL UNIQUE,
            name VARCHAR(60) NOT NULL UNIQUE,
            price float(9,2) NOT NULL,
            created_at DATETIME NOT NULL,
            updated_at DATETIME NOT NULL
            )";
        if ($conn->query($sql) !== TRUE) {
            die("Erro ao criar tabela {$table}: " . $conn->error);
        }
        TablesDML::triggerProducts($conn);
        return true;
    }

    public static function customers($conn)
    {
        //TODO CPF deve ser válido.
        $table = 'CUSTOMERS';
        //id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INTEGER NOT NULL PRIMARY KEY,
            name VARCHAR(60) NOT NULL,
            cpf VARCHAR(14) NOT NULL UNIQUE,
            email VARCHAR(50) NOT NULL UNIQUE,
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
        $table = 'ORDERS';
        //Colunas que seriam adicionadas caso a Regra de negócio permitisse o auto increment no ID, adicionando assim o PARTNER_ID que armazenaria o ID original
        // id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        // partner_id INTEGER NOT NULL,
        $sql = "CREATE TABLE IF NOT EXISTS {$table} (
            id INTEGER NOT NULL PRIMARY KEY,
            customer_id INTEGER NOT NULL,
            total float(9,2) NOT NULL,
            status VARCHAR(20) NOT NULL,
            cancel_data DATETIME NOT NULL,
            created_at DATETIME NOT NULL
            )";
        if ($conn->query($sql) !== TRUE) {
            die("Erro ao criar tabela {$table}");
        }
        TablesDML::triggerOrders($conn);
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
        TablesDML::triggerOrderItems($conn);
        return true;
    }

    static function triggerProducts($conn){
        $table = 'PRODUCTS';
        $trigger = 'products_tbi';
        $sql = "CREATE TRIGGER IF NOT EXISTS `{$trigger}` BEFORE INSERT ON `{$table}` FOR EACH ROW IF NEW.price <= 0 THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Impossivel adicionar o campo PRICE do produto com valor igual ou abaixo de zero.'; END IF;";
        if ($conn->query($sql) !== TRUE) {
            die("Erro ao criar trigger {$trigger}: " . $conn->error);
        }
        return true;
    }

    static function triggerOrders($conn){
        $table = 'ORDERS';
        $trigger = 'orders_tbi';
        $sql = "CREATE TRIGGER IF NOT EXISTS `{$trigger}` BEFORE INSERT ON `{$table}` FOR EACH ROW IF NEW.total <= 0 THEN SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Impossivel adicionar o campo TOTAL do pedido com valor igual ou abaixo de zero.'; END IF;";
        if ($conn->query($sql) !== TRUE) {
            return die("Erro ao criar trigger {$trigger}");;
        }
        return true;
    }
    
    static function triggerOrderItems($conn){
        $table = 'ORDERITEMS';
        $trigger = 'orderitems_tbi';
        $sql = "CREATE TRIGGER IF NOT EXISTS `{$trigger}`
        BEFORE INSERT ON `{$table}`
        FOR EACH ROW
        BEGIN
            IF NEW.amount <= 0 THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Impossivel adicionar o campo AMOUNT do pedido com valor igual ou abaixo de zero.'; 
            ELSEIF NEW.price_unit <= 0 THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Impossivel adicionar o campo PRICE_UNIT do pedido com valor igual ou abaixo de zero.'; 
            ELSEIF NEW.total <= 0 THEN
                SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Impossivel adicionar o campo TOTAL do pedido com valor igual ou abaixo de zero.'; 
            END IF;
        END
        ";
        if ($conn->query($sql) !== TRUE) {
            return die("Erro ao criar trigger {$trigger}");
        }
        return true;
    }
}
