<?php

/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 03/04/2017
 * Time: 14:19
 */

namespace POO\Cliente\Type;

use POO\Cliente\Cliente;
use POO\db\ConexaoDB;
use POO\Cliente\EntidadeInterface;

class ClienteFisica extends Cliente implements EntidadeInterface
{
    private $cpf;
    private $tipo = 'Pessoa Fisica';
    private static $db;
    private $table = "cliente";

    public function __construct (\PDO $conn) {
        $this->db = $conn;
    }

    /**
     * @return mixed
     */
    public function getNumeroIndetificacao()
    {
        return $this->cpf;
    }

    /**
     * @param mixed $cpf
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param string $table
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

}