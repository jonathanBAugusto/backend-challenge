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
}
