<?php

class Database{
    

    private $host = "localhost";/* ENCAPSULATION*/
    private $db_name = 'project1';
    private $username='root';
    private $password='';
    private $connection = null;



    /*function to connect to database*/

    public function connect(){
        try{

            $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,
            $this->username,$this->password);
        
        
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
        return $this->connection;
    }



}

?>