<?php
// require "connection.php";

if (!empty($_REQUEST['poids']) && !empty($_REQUEST['taille'])) {
    if (isset($_REQUEST['poids'], $_REQUEST['taille']) && preg_match('/^[0-9]/', $_REQUEST['poids']) && preg_match('/^[0-9]/', $_REQUEST['taille'])) {

        require "dataDB.php";
        //insert l'historique dans la base de données
        requete_insert();

        //récupérer la clé du cookie lié aux users

        $cook = htmlentities($_COOKIE['useridsm']);

        $pseudo = htmlentities($_REQUEST['nom']) ? htmlentities($_REQUEST['nom']) : "Inconnu";
        @$poids = (int)htmlentities($_REQUEST['poids']);
        @$taille = (float)htmlentities($_REQUEST['taille']) / 100;

        @$imc = round($poids / (pow($taille, 2)), 2);
        // @$imc  = round($imc * 100, 2);

        @$iMC = 'IMC';



        if ($imc < 16.50) {

            echo "$imc ,";
            echo "$poids ,";
            echo " $taille ,";
            echo $statusDescript = "Dénutrition Ou Famine";

            //  $couleur = "#ff1a1a";
        } elseif ($imc >= 16.50 &&  $imc <= 18.50) {

            echo "$imc,";
            echo "$poids,";
            echo "$taille,";
            echo $statusDescript = "Maigreur";
            $couleur = "#ff6600";
        } elseif ($imc >= 18.50 &&  $imc <= 25) {

            echo "$imc,";
            echo "$poids,";
            echo "$taille,";
            echo $statusDescript = "Corpulence Normale";
            // $couleur = " #33cc33";
        } elseif ($imc >= 25 &&  $imc <= 30) {

            echo "$imc,";
            echo "$poids,";
            echo "$taille,";
            echo $statusDescript = "Surpoids";
            // $couleur = "#990099";
        } elseif ($imc >= 30 &&  $imc <= 40) {

            echo "$imc,";
            echo "$poids,";
            echo "$taille,";
            echo $statusDescript = "Obésité";
            //  $couleur = "#993300";
        } else {

            echo "$imc,";
            echo "$poids,";
            echo "$taille,";
            echo $statusDescript = "Obésité Massive";
            // $couleur = "#cc0000";
        }



        // $req = $conn->prepare("INSERT INTO historique(pseudo,poids,taille,imc,create_at)  VALUES (?,?,?,?,now())");
        // $req->execute([ucfirst($pseudo), $poids, $taille, $imc]);
    } else {
        echo "<h4 style='color: #cc0000;text-align:center'>Veuillez entrez des Nombres !</h4>";
    }
} else {

    echo  "<h4 style='color: #cc0000;text-align:center'>Vous  n'avez rempli tous les champs !</h4>";
}
