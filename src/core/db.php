<?php

class Database{
     private $host="localhost";
     private $user="root";
     private $pass="root";
     private $db="location";
     protected $conn;

     private function connect(){

        $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db,$this->user,$this->pass);
        return $this->conn;
     }

     public function insert($sql){
         $db = new Database();
         $db->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $db->connect()->exec($sql);
     }

     public function select($sql){
        $db = new Database();
        $db->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $db->connect()->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        if (count($result) > 0){
           return $result;
        } else{
            return false;
        }

     }

     public function selectIndexed($sql){
      $db = new Database();
      $db->connect()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $db->connect()->prepare($sql);
      $stmt->execute();

      $stmt->setFetchMode(PDO::FETCH_NUM);
      $result = $stmt->fetchAll();
      if (count($result) > 0){
         return $result;
      } else{
          return false;
      }

   }
     

}
    
?>


