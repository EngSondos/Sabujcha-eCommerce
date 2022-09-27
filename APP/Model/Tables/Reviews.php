<?php
namespace APP\Model\Tables;

use APP\Model\Curd\Curd;
use APP\Model\Tables\Model;
use APP\Model\Tables\Product;


Class Reviews extends Model implements Curd {
    public $comment ="",$rate ,$created_at ,$product_id ,$user_id;
    const TABLE ='reviews';
    function create(){
        $product = new Product;
        $query="INSERT INTO ". self::TABLE ." (user_id,product_id,comment ,rate) VALUES( ?,?,?,?)";
        $stmt =$this->conn->prepare($query);
        $stmt->bind_param("iisi",$_SESSION['user']->id, $this->product_id,$this->comment,$this->rate); 
        return $stmt->execute();
    }
   function viewreviews(){
    $query= "SELECT 
    `reviews`.* 
    , CONCAT(`users`.`first_name`, ' ', `users`.`last_name`)
     AS `full_name` From `reviews` LEFT JOIN `users` ON `users`.`id`=`reviews`.`user_id` WHERE `reviews`.`product_id`= ?";
    $stmt = $this->conn->prepare($query);
    if(!$stmt){
    return false;
    }
    $stmt->bind_param('i',$this->product_id);
    $stmt->execute();
    return $stmt->get_result();
    }
    
    function update(){
       
    }
    function read(){

    }
    function delete()
    {
        
    }

    /**
     * Get the value of comment
     */ 
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set the value of comment
     *
     * @return  self
     */ 
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get the value of rate
     */ 
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @return  self
     */ 
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get the value of created_at
     */ 
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Set the value of created_at
     *
     * @return  self
     */ 
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get the value of product_id
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */ 
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of user_id
     */ 
    public function getUser_id()
    {
        return $this->user_id;
    }

    /**
     * Set the value of user_id
     *
     * @return  self
     */ 
    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }
    }
    ?>