<?php
namespace APP\Model\Connection;

class Connection{
    private $hostName='localhost';
    private $db_password='';
    private $db_UserName='root';
    private $db_Name ='e-commerce';
    public \mysqli $conn ;
    function __construct()
    {
         $this->conn = new \mysqli($this->hostName,$this->db_UserName,$this->db_password ,$this->db_Name);
        
    }
    function __destruct()
    {
        $this->conn->close();
    }

}