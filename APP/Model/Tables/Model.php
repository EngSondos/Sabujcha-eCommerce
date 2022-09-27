<?php
namespace App\Model\Tables;
use APP\Model\Connection\Connection;

class Model extends Connection{
   public const TABLE='';
   function all($column=[' * '],$foundby=[]){
      $select = implode("," ,$column);
      $query="SELECT ".$select . " FROM ".static::TABLE;
      if(!empty($foundby)){
         $query .= " WHERE ";
         foreach ($foundby as $index => $filter){
            if($index != 0){
               $query .=" AND ";
       }
       $query .= "{$filter[0]} {$filter[1]} {$filter[2]} ";
       }
         
      }
      return $this->conn->query($query);

   }
   function find($id){
      $query = "SELECT * FROM ". static::TABLE ." WHERE id = ?";
      $stmt = $this->conn->prepare($query);
      if(!$stmt){
         return false;
      }
      $stmt->bind_param("i" , $id);
      $stmt->execute();
      return $stmt->get_result();

   }
}