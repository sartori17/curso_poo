<?php

/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 27/03/2017
 * Time: 22:04
 */
class Cliente
{

    private $id;
    private $nome;
    private $cpf;
    private $email;
    private $cidade;

    public function __construct ($id, $nome, $cpf, $email, $cidade) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->email = $email;
        $this->cidade = $cidade;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @return mixed
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getCidade()
    {
        return $this->cidade;
    }


}