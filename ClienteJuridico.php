<?php


require_once 'Cliente.php';
require_once 'ClienteJuridicoInterface.php';

/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 03/04/2017
 * Time: 14:18
 */
class ClienteJuridico extends Cliente implements ClienteJuridicoInterface
{
    private $cnpj;
    private $tipo = 'Pessoa Juridica';

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



}