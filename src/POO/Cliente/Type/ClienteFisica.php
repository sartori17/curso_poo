<?php

/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 03/04/2017
 * Time: 14:19
 */

namespace POO\Cliente\Type;

use POO\Cliente\Cliente;

class ClienteFisica extends Cliente
{
    private $cpf;
    private $tipo = 'Pessoa Fisica';

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




}