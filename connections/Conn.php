<?php

namespace connections;

use connections\TableDML;

class Conn
{
    public $server = 'localhost';
    public $user = 'root';
    public $pass = '';
    public $database = 'LITTLESHOP';

    public function __construct()
    {
        if (createBase($this->database))
            if (!createTables())
                return null;
            else
                return null;
    }

    function conn($msgerro = null)
    {
        $conn = new mysqli($this->server, $this->user, $this->pass);
        //verifica se conseguiu a conexão com os parâmetros definidos
        if (mysqli_connect_errno()) {
            exit(isset($msgerro) ? $msgerro : 'Falha na conexão: ' . mysqli_connect_error());
        }
        return $conn;
    }

    /***
     * Método para criar a base de dados (é chato ter que ficar criando sempre que se hospeda em um lugar novo...)
     */
    function createBase($database)
    {
        $return = false;

        $conn = $this->conn("Falha na conexão ao criar base de dados: ");

        //Query para criar (caso já não exista) a base de dados
        $sql = "CREATE DATABASE IF NOT EXISTS '{$database}' DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci";

        //Condição para retornar se a query foi executada com sucesso :D
        if ($conn->query($sql) === TRUE) {
            $return = true;
        } else {
            echo 'Error: ' . $conn->error;
        }

        //Fechando conexão u.u 
        $conn->close();

        //retornando o resultado bool do processo
        return $return;
    }
    //Aqui são executadas todas DML das tabelas...
    function createTables()
    {
        $msgerro = "Falha na conexão quando criando tabelas: ";

        $return = 0;

        $return += TableDML::products($this->conn($msgerro)) ? 0 : 1;
        $return += TableDML::customers($this->conn($msgerro)) ? 0 : 1;
        $return += TableDML::orders($this->conn($msgerro)) ? 0 : 1;
        $return += TableDML::orderItems($this->conn($msgerro)) ? 0 : 1;

        return $return == 0;
    }
}
