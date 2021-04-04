
<?php
require "Connection.php";

class DBconnect
{



    public static function connector()
    {
        $dbConn =  new Connection();
        return $dbConn->connect();
    }
}
