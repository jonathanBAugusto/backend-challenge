<?php

namespace models;

class Customer
{
    public $id;
    public $name;
    public $cpf;
    public $email;
    public $created_at;
    public $updated_at;

    public function __construct($id, $name, $cpf, $email, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public static function fromJson($json)
    {
        $jsonObj = json_decode($json, true);
        return new Customer($jsonObj['id'] ?? null, $jsonObj['name'] ?? null, $jsonObj['cpf'] ?? null, $jsonObj['email'] ?? null, $jsonObj['created_at'] ?? null, $jsonObj['updated_at'] ?? null) ?? null;
    }

    public static function validator(Customer $customer)
    {
        $missingFields = array();
        if (!isset($customer->id))
            $missingFields[] = 'id';

        if (!isset($customer->name))
            $missingFields[] = 'name';

        if (!isset($customer->cpf))
            $missingFields[] = 'cpf';

        if (!isset($customer->email))
            $missingFields[] = 'email';

        if (!isset($customer->created_at))
            $missingFields[] = 'created_at';

        if (!isset($customer->updated_at))
            $missingFields[] = 'updated_at';

        if (isset($missingFields))
            die("Faltam os seguintes campos para concluir a inserção em 'Customer': " . PHP_EOL . PHP_EOL . implode(PHP_EOL, $missingFields));
        else
            true;
    }
}
