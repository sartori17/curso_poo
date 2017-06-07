<?php


namespace POO\Cliente\Type;

use POO\Cliente\EntidadeInterface;
use POO\Cliente\Cliente;
use POO\Cliente\ClienteJuridicoInterface;
use POO\db\ConexaoDB;
/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 03/04/2017
 * Time: 14:18
 */
class ClienteJuridico extends Cliente implements ClienteJuridicoInterface, EntidadeInterface
{
    private $cnpj;
    private $tipo = 'Pessoa Juridica';
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
        return $this->cnpj;
    }

    /**
     * @param mixed $cnpj
     */
    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
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
     * @param mixed $endereco
     */
    public function setEndereco($endereco)
    {
        $this->enderecoEspecifico ();
        return $this;
    }

    public function enderecoEspecifico () {
        $this->endereco = "Avenida School of Net, 156";
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