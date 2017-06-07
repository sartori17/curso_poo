<?php

/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 05/06/2017
 * Time: 23:40
 */
namespace POO\Cliente;

interface EntidadeInterface
{
    public function getId();
    public function setId($id);

    public function getTable();
    public function setTable($table);
}