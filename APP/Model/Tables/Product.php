<?php

namespace APP\Model\Tables;

use APP\Model\Curd\Curd;
use APP\Model\Tables\Model;

class Product extends Model implements Curd
{
    public $id, $name_en, $name_ar, $code, $quntity, $price, $status, $created_at , $image ,$details_en;
    const TABLE = 'products_detalis';
    function create()
    {
    }


    function update()
    {
    }
    function read()
    {
    }
    function delete()
    {
    }
    function GetProductById(){
        $query = "SELECT * FROM products_detalis WHERE id = ?";
        $stmt = $this->conn ->prepare($query);
        if(!$stmt){
            return false;
        }
        $stmt->bind_param('i',$this->id);
        $stmt->execute();
      return $stmt->get_result();
    }
    function getMostREcentProduct()
    {
        $query = "SELECT * FROM " . self::TABLE . " ORDER BY `created_at` DESC LIMIT 4";
        $stmt = $this->conn->query($query);


        return $stmt;
    }
    function getMostProductOrderd()
    {
        $query = "SELECT * FROM most_ordered_product ";
        $stmt =$this->conn->query($query);
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

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
