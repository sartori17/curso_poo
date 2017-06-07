<?php

/**
 * Created by PhpStorm.
 * User: felipe
 * Date: 18/03/2017
 * Time: 16:08
 */

namespace POO\db;

class ServiceDb
{

    private $db;
    private $entity;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function persist (Cliente $entity) {
        $this->entity = $entity;
    }

    public function flush() {
        $fields = array(
            "idcliente" => $this->entity->getId(),
                "nome" => $this->entity->getNome(),
                "registro" => $this->entity->getNumeroIndetificacao(),
                "email" => $this->entity->getEmail(),
                "endereco" => $this->entity->getEndereco(),
                "cidade" => $this->entity->getCidade(),
                "tipo" => $this->entity->getTipo(),
                "grauimportancia" => $this->entity->getGrauImportancia());

        $this -> inserir($fields);
    }

    public function find($field, $value)
    {

        $query = "SELECT * FROM {$this->entity->getTable()} WHERE {$field} = :{$field}";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":".$field, $value);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function findAll($field, $value)
    {

        $query = "SELECT * FROM {$this->entity->getTable()} WHERE {$field} like :{$field}";

        $stmt = $this->db->prepare($query);
        $stmt->bindValue(":".$field, '%'.$value.'%');
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function listar($ordem = null)
    {
        if($ordem) {
            $query = "SELECT * FROM {$this->entity->getTable()} ORDER BY {$ordem}";
        } else {
            $query = "SELECT * FROM {$this->entity->getTable()}";
        }

        $stmt = $this->db->query($query);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function inserir($fields = null)
    {
        if (is_array($fields)) {
            $table_fields = implode(", ", array_keys($fields));
            $table_fields_values = ":".implode(", :", array_keys($fields));
        } else {
            return false;
        }

        $query = "INSERT INTO {$this->entity->getTable()} ({$table_fields}) VALUES ({$table_fields_values})";

        $stmt = $this->db->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(':'.$key, $value);
        }

        if($stmt->execute()) {
            return true;
        }
    }

    public function alterar($fields = null)
    {
        if (is_array($fields)) {
            $table_fields = implode(", ", array_map(function($key){ return "$key=?"; }, array_keys($fields)));
        } else {
            return false;
        }

        $query = "UPDATE {$this->entity->getTable()} SET {$table_fields} WHERE id=?;";

        $stmt = $this->db->prepare($query);

        $x = 1;
        foreach ($fields as $key => $value) {
            $stmt->bindValue($x++, $value);
        }

        $stmt->bindValue($x, $this->entity->getId());
        if($stmt->execute()) {
            return true;
        }
        //echo var_dump($stmt->errorInfo());
    }

    public function deletar($id)
    {
        $query = "delete from {$this->entity->getTable()} where id=:id";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':id', $id);

        if($stmt->execute()) {
            return true;
        }
    }

}