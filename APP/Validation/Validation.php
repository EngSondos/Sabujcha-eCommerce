<?php
namespace APP\Validation;
use APP\Model\Tables\Model;

new model;

class Validation  {
    private string  $inputName = "";
    private string $inputValue = "";
    public $errors=[];


    public function require(){
    if(empty($this->inputValue)){
    $this->errors[$this->inputName][__FUNCTION__]=  ucwords($this->inputName).' is Required ';
    }
    return $this;
    }
    public function string() : self
    {
        if(!is_string($this->inputValue)){
            $this->errors[$this->inputName][__FUNCTION__]=  ucwords($this->inputName).' is invalid ';
        }
        return $this;
    }
    public function max($max) :self
    {
        if($this->inputValue <$max){
            $this->errors[$this->inputName][__FUNCTION__]=  ucwords($this->inputName).' is Must greater than or equal {$max} Characters ';
        }
        return $this;
    }
    public function min($min) : self
    {
        if($this->inputValue >$min){
            $this->errors[$this->inputName][__FUNCTION__]=  ucwords($this->inputName).' is Must less than or equal  {$min} Characters';
        }
        return $this;
    }
    public function regex($pattren ,$message ="") : self
    {
        if(!preg_match($pattren , $this->inputValue)){
            $this->errors[$this->inputName][__FUNCTION__]=  ucwords($this->inputName) . $message ?? ' is invalid';
        }
        return $this;
        
    }
    public function confirm($value) :self
    {
        if($this->inputValue !== $value){ 
            $this->errors[$this->inputName][__FUNCTION__]=  ucwords($this->inputName) .' is Not Match with confirm';

        }
        return $this;

    }
    public function in_rang($values){
        if(!in_array($this->inputValue , $values)){
            
            $this->errors[$this->inputName][__FUNCTION__]=  ucwords($this->inputName) .' Must Be ' . implode($values);
        }
        return $this;
    }
  
public function unique($table,$column){
    $model = new Model;
 $query=$model->conn->prepare("SELECT * FROM " .$table." WHERE " . $column ." = ? ");
 $query->bind_param('s',$this->inputValue);
 $query->execute();
 $stmt= $query->get_result();
 if($stmt->num_rows ==1){
    $this->errors[$this->inputName][__FUNCTION__]=  $this->inputName .' is Aleardy exists' ;
 }   
 return $this;
}
public function exist($table,$column){
    $model = new Model;
    $query=$model->conn->prepare("SELECT * FROM " .$table." WHERE " . $column ." = ? ");
    $query->bind_param('s',$this->inputValue);
    $query->execute();
    $stmt= $query->get_result();
    if($stmt->num_rows ==0){
       $this->errors[$this->inputName][__FUNCTION__]=  $this->inputName .' is Not in our record please click  <a href ="register.php">here</a> to registration' ;
    }   
    return $this;
}

public function get_Errors() :array
{
    return $this->errors;
}
public function get_Error(string $error){
    if(isset($this->errors[$error])){
        // print_r($this->errors[$error]);


        foreach($this->errors[$error] as $e){
            return $e;
        }

    }
    return null;
}
public function alertMessage($error){
    if( $this->get_Error($error)){
        return '<div class="alert alert-danger ">'. $this->get_Error($error) ."</div>";

    }
       


}

function uniqueInUpdate($id,$table){
     
    $model= new Model;
    $query = "SELECT * FROM ".$table." WHERE id !=?";
    $stmt = $model->conn->prepare($query);
    $stmt->bind_param('i',$id);
    if(!$stmt){
        return false;
    }
    $stmt->execute();
    $stmt->get_result();
    if($stmt->num_rows()==1){
        $this->errors[$this->inputName][__FUNCTION__]=  $this->inputName .' is Aleardy exists' ;
        
    }
}
    /**
     * Set the value of inputValue
     *
     * @return  self
     */ 
    public function setInputValue($inputValue)
    {
        $this->inputValue = $inputValue;

        return $this;
    }

    /**
     * Set the value of inputName
     *
     * @return  self
     */ 
    public function setInputName($inputName)
    {
        $this->inputName = $inputName;

        return $this;
    }

    /**
     * Get the value of inputValue
     */ 
    public function getInputValue()
    {
        return $this->inputValue;
    }

    /**
     * Get the value of inputName
     */ 
    public function getInputName()
    {
        return $this->inputName;
    }
}
