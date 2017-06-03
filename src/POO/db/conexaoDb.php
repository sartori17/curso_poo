<?php
/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 23/03/2017
 * Time: 15:27
 */

namespace \POO\db;

function conexaoDB () {
    try {

        $config = include "config.php";

        if (! isset($config['db'])) {
            throw new \InvalidArgumentException("Configuração não existe");
        }

        $host = (isset($config['db']['host'])) ? $config['db']['host'] : null;
        $dbname = (isset($config['db']['dbname'])) ? $config['db']['dbname'] : null;
        $user = (isset($config['db']['user'])) ? $config['db']['user'] : null;
        $password = (isset($config['db']['password'])) ? $config['db']['password'] : null;

        return new \PDO("mysql:host={$host};dbname={$dbname}", $user, $password);

    } catch (\PDOException $e) {

        echo $e->getMessage()."\n";
        echo $e->getTraceAsString()."\n";

    }
}