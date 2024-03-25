<?php 

namespace App\Core\Database;

use \App\Core\Database\VeloDB;
use \PDO;


class VeloModel{

 use VeloGetQueryBuilder;
    protected  $table = '';
    protected $connection = null;


    public function getConnection(){

       if(!$this->connection){
         $this->connection = VeloDB::getConnection();
       }

         return $this->connection;

    }


    public function all(){
        
        $result =  $this->getConnection()->query("SELECT * FROM $this->table");
        $result =  $result->fetchAll(PDO::FETCH_OBJ);
        return $result ?: [];
    }

    public function findId($id){
        $st =  $this->getConnection()->prepare("SELECT * FROM $this->table WHERE id = :id LIMIT 1");
        $st->execute(['id' => $id]);
        $result =  $st->fetch(PDO::FETCH_OBJ);
        return $result ?: false;
    }

    public function insert($data){
        $columns = implode(',', array_keys($data));
        $values = implode(',', array_fill(0, count($data), '?'));

        $st =  $this->getConnection()->prepare("INSERT INTO $this->table ($columns) VALUES ($values)");
        $st->execute(array_values($data));
        return $connection->lastInsertId();
    }

    public function update(array $conditions, array $data) {
        // Prepare SET clause for update query
        $setClause = '';
        foreach ($data as $key => $value) {
            $setClause .= "$key = ?, ";
        }
        $setClause = rtrim($setClause, ', ');

        // Prepare WHERE clause for update query
        $whereClause = '';
        foreach ($conditions as $key => $value) {
            $whereClause .= "$key = ? AND ";
        }
        $whereClause = rtrim($whereClause, ' AND ');

        // Combine SET and WHERE clauses
        $sql = "UPDATE $this->table SET $setClause WHERE $whereClause";

        // Prepare and execute the update query
        $st =  $this->getConnection()->prepare($sql);
        $st->execute(array_merge(array_values($data), array_values($conditions)));

        return $st->rowCount();
    }

    public function delete(array $conditions) {
        // Prepare WHERE clause for delete query
        $whereClause = '';
        foreach ($conditions as $key => $value) {
            $whereClause .= "$key = ? AND ";
        }
        $whereClause = rtrim($whereClause, ' AND ');

        // Construct delete query
        $sql = "DELETE FROM $this->table WHERE $whereClause";

        // Prepare and execute the delete query
        $st =  $this->getConnection()->prepare($sql);
        $st->execute(array_values($conditions));

        return $st->rowCount();
    }


    }
