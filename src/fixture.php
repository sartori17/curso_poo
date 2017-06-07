<?php
/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 05/06/2017
 * Time: 22:23
 */

echo "### Iniciando Fixture ###<br>";

$config = include "POO/db/config.php";

if (!isset($config['db'])) {
    throw new \InvalidArgumentException("Configuração não existe");
}

$host = (isset($config['db']['host'])) ? $config['db']['host'] : null;
$dbname = (isset($config['db']['dbname'])) ? $config['db']['dbname'] : null;
$user = (isset($config['db']['user'])) ? $config['db']['user'] : null;
$password = (isset($config['db']['password'])) ? $config['db']['password'] : null;

$conn = new \PDO("mysql:host={$host};dbname={$dbname}", $user, $password);

$query = "SET NAMES utf8;";
echo "<br>".$query."<br>";
$conn->query($query);

$query = "DROP TABLE IF EXISTS `cliente`;";

$conn->query($query);
echo "<br>".$query."<br>";

$query = "CREATE TABLE `cliente` (
  `idcliente` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `cidade` varchar(45) DEFAULT NULL,
  `grauimportancia` int(11) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `tipo` char(1) DEFAULT NULL,
  `registro` varchar(14) DEFAULT NULL,
  PRIMARY KEY (`idcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
 ";

$conn->query($query);
echo "<br>".$query."<br>";

$query = "INSERT INTO `cliente` VALUES (1,'Felipe','fe@fe.com','santos',5,'rua daqui longe dali, 156','F','15248157263'),
                                        (2,'Luciana','lu@fe.com','praia grande',4,'rua de la perto daqui, 678','F','25036296502'),
                                        (3,'leandro','le@fe.com','santos',5,'rua daqui longe dali, 156','J','12524105039658'),
                                        (4,'ste','ste@fe.com','praia grande',4,'rua de la perto daqui, 678','F','26535841710'),
                                        (5,'Leticia','le@fe.com','santos',5,'rua daqui longe dali, 156','J','25968525471548'),
                                        (6,'Fabiano','fa@fe.com','praia grande',4,'rua de la perto daqui, 678','J','25361524854758'),
                                        (7,'Anderson',NULL,'xxx',1,NULL,'F','152469382541');";

$conn->query($query);
echo "<br>".$query."<br>";

echo "<br>### Finalizando Fixture ###";

