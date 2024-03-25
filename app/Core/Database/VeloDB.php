<?php 

namespace App\Core\Database;

class VeloDB{

   private static $connection = null;


    
  public static function getConnection(){

     $host = $_ENV['DB_HOST'];
     $username = $_ENV['DB_USERNAME'];
     $password = $_ENV['DB_PASSWORD'];
     $database = $_ENV['DB_DATABASE'];  
 
     

 try{
    if(!self::$connection){

     
      self::$connection =  new \PDO("mysql:host={$host};dbname={$database}",$username,$password);

    }

     return self::$connection;

   
   }catch(PDOException $e){

         echo "Problem ";
         echo $e->getMessage();

       }

  }




}