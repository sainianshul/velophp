<?php 

namespace App\Core\Database;

use \PDO;

trait VeloGetQueryBuilder{

   private $select = ['*'];
   private $limit = '';
   private $offset = '';
   private $where = '';
   private $orderBy = '';




public function select(array $params){

  $q = '';

  foreach ($params as $param) {
  	
  	if($param == '*')
  	{
       $this->select = '*';
       return $this;
  	}
     $q .= $param . ',';


  }

 $this->select = rtrim($q,',');

 return $this;

}




   public function whereAnd(string $param1, string $operator, string $param2){

     if(!empty($this->where)){
          
          $this->where .= " AND ". $param1 . $operator ."'" . $param2."'";

     }else{
         
         $this->where =  $param1 . $operator ."'". $param2 ."'";

     }

     return $this;

   }
   

   public function whereOr(string $param1, string $operator, string $param2){

    if(!empty($this->where)){
          
          $this->where .= " OR ". $param1 . $operator ."'". $param2."'";

     }else{
         
         $this->where =  $param1 . $operator . $param2;

     }

     return $this;


   }
   

  public function orderBy(string $order){


   $this->orderBy = $order;

   return $this;   

  }



public function limit(int $limit){

$this->limit = (string)$limit;
return $this;

}


public function offset(int $offset){


$this->offset = (string)$offset;

return $this;


}

  


 public function get() {
    $query = "SELECT {$this->select} FROM {$this->table}";

    if(!empty($this->where)){
     $query .= " WHERE {$this->where}";
    }

    if (!empty($this->orderBy)) {
        $query .= " ORDER BY {$this->orderBy}";
    }

    if (!empty($this->limit)) {
        $query .= " LIMIT ";

        if (!empty($this->offset)) {
            $query .= $this->offset . ", "; // Add comma if offset is present
        }

        $query .= $this->limit;
    }

    $result = $this->getConnection()->query($query);

   return $result->fetchAll(PDO::FETCH_OBJ);

    //return $query;

}

}