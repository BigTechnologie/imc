<?php

// require "class/DBconnect.php";
//var_dump($_SERVER["REQUEST_METHOD"]);
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_REQUEST['delete_item'] !== "") {
    $delete_id = (int)htmlentities($_REQUEST['delete_item']);
    $req = DBconnect::connector()->prepare("DELETE FROM historique WHERE `id`=$delete_id")->execute();
} 


//echo " <p>$req</p>";
