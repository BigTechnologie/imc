<?php

require "class/DBconnect.php";


function requete_insert()
{


    if (isset($_REQUEST['poids'], $_REQUEST['taille']) && !empty($_REQUEST['poids'])  && !empty($_REQUEST['taille'])) {
        gen_cookie_user_id();
        $pseudo = htmlentities($_REQUEST['nom']);
        $pseudo = $pseudo ? $pseudo : "inconnu";
        $poids = (int) htmlentities($_REQUEST['poids']);
        $taille = (float) htmlentities($_REQUEST['taille']) / 100;
        @$imc = round($poids / (pow($taille, 2)), 2);
        $cook = get_cookie_id();

        $req = DBconnect::connector()->prepare("INSERT INTO historique(pseudo,poids,taille,imc,create_at,cookie)  VALUES (?,?,?,?,now(),?)");
        $req->execute([ucfirst($pseudo), $poids, $taille, $imc, $cook]);
    }
}



function requete_select()
{
    if (get_cookie_id()) {

        $recup_cookie = get_cookie_id();

        $req = DBconnect::connector()->query("SELECT * FROM historique")->fetchAll();
        if ($req) {
            return  DBconnect::connector()->query("SELECT * FROM historique WHERE cookie =$recup_cookie")->fetchAll();
        }
    }
}



function gen_cookie_user_id()
{

    if (!@$_COOKIE["useridsm"]) {

        // $id = password_hash("ald", PASSWORD_BCRYPT);

        $id = rand(71586333, 5885666);
        $useid = setcookie("useridsm", $id, time() + 60 * 60 * 24 * 1000);
        return $useid;
    }
}

function get_cookie_id()
{
    if (@$_COOKIE["useridsm"]) {
        $get_user_cookie = (string)htmlentities($_COOKIE["useridsm"]);
        return $get_user_cookie;
    }
}

// function delete_historique_items($delete_key)
// {

//     $delete_id = htmlentities($delete_key);
//     $req = DBconnect::connector()->query("DELETE * FROM historique WHERE id= $delete_id");

//     return $req;
// }


// function delete_cookie()
// {

//     if (!get_cookie_id()) {

//         return DBconnect::connector()->query("DELETE * FROM historique WHERE cookie !=get_cookie_id() ");
//     }
// }
