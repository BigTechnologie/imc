<?php

class Connection
{

    protected $conn;


    function __construct()
    {
        try {


            return $this->conn = new PDO('mysql:host=localhost;dbname=imc;charset=UTF8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            //return $this->conn = new PDO('mysql:host=10.42.42.129;dbname=meteoplata_dev;charset=UTF8', 'meteoplata_dev', 'Ibrahime2017@', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            // return $this->conn = new PDO('mysql:host=monpoidsimc.sql.free.fr;dbname=monpoidsimc', 'monpoidsimc', 'Ibrahime2017@', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {

            echo " Problem with database connection " . $e->getMessage();
        }
    }


    public  function connect()
    {

        return $this->conn;
    }
}
