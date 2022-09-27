<?php
namespace APP\Model\Tables;
use APP\Model\Curd\Curd;
use APP\Model\Tables\Model;
Class Order extends Model implements Curd {
    private $id,$name_en,$name_ar,$code,$quntity,$price,$status,$created_at;
    const TABLE ='products';
    function create(){
     
    }
    
    
    function update(){
       
    }
    function read(){

    }
    function delete()
    {
        
    }
    function getMostPOrdered(){
        $query = "SELECT * FROM ".self::TABLE ." ORDER BY `created_at` DESC LIMIT 4";
        $stmt=$this->conn->query($query);
  

        return $stmt;
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
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of name_ar
     */ 
    public function getName_ar()
    {
        return $this->name_ar;
    }

    /**
     * Set the value of name_ar
     *
     * @return  self
     */ 
    public function setName_ar($name_ar)
    {
        $this->name_ar = $name_ar;

        return $this;
    }

    /**
     * Get the value of code
     */ 
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of code
     *
     * @return  self
     */ 

    /**
     * Get the value of quntity
     */ 
    public function getQuntity()
    {
        return $this->quntity;
    }

    /**
     * Set the value of quntity
     *
     * @return  self
     */ 
    public function setQuntity($quntity)
    {
        $this->quntity = $quntity;

        return $this;
    }

    /**
     * Get the value of price
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @return  self
     */ 
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of name_en
     */ 
    public function getName_en()
    {
        return $this->name_en;
    }

    /**
     * Set the value of name_en
     *
     * @return  self
     */ 
    public function setName_en($name_en)
    {
        $this->name_en = $name_en;

        return $this;
    }
}
    ?>