<?php

namespace Core;

abstract class Model
{
    protected $pdo;
    protected $tableName = null;

    public function __construct()
    {
        $this->pdo = $this->make();
        $this->checkTable();
    }

    protected function make()
    {
        try {
            return new \PDO('mysql:host=localhost;dbname=mvc_application','root','123456789');

        } catch (\PDOException $e){
            throw $e;
        }
    }

    public function selectAll(){
        if (is_null($this->tableName)){
            throw new \Exception("Table Name Not Null");
        }

        $stmt = $this->pdo->prepare("SELECT * FROM {$this->tableName}");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_OBJ);
    }

    protected function checkTable(){
        $stmt = $this->pdo->prepare("SHOW TABLES LIKE '{$this->tableName}'");
        $stmt->execute();
        if ($stmt->fetch() == false){
            throw new \PDOException("{$this->tableName} Table Does Not Exist");
        }
    }

}